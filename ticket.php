
<?
include 'header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
}else {
    $getCountZero = getOneValue("SELECT COUNT(*) AS 'get' FROM `EventHandler` WHERE `CardStatus` = '0' AND `OwnerID` = '$usernameID'");
    $getCountOne = getOneValue("SELECT COUNT(*) AS 'get' FROM `EventHandler` WHERE `CardStatus` = '1' AND `OwnerID` = '$usernameID'");
    $getCountTwo = getOneValue("SELECT COUNT(*) AS 'get' FROM `EventHandler` WHERE `CardStatus` = '2' AND `OwnerID` = '$usernameID'");
?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
<div class="row">
    <div class="col-lg-4">
        <h2 style="background-color: #fff6ea;">ยังไม่ได้จ่ายเงิน</h2>
        <h3><center><? echo $getCountZero;?></center></h3>
    </div>
    <div class="col-lg-4">
        <h2 style="background-color: #f1ffef;">จ่ายเงินแล้ว</h2>
        <h3><center><? echo $getCountOne;?></center></h3>
    </div>
        <div class="col-lg-4">
        <h2 style="background-color: #effeff;">คอนเฟริมแล้ว</h2>
        <h3><center><? echo $getCountTwo;?></center></h3>
    </div>
</div>
<hr>
        <?
        $result = mysqli_query($con, "SELECT * FROM `EventHandler` INNER join EventTicket on EventHandler.TicketID = EventTicket.TicketID WHERE `OwnerID` = '$usernameID' ORDER BY `CardID` DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            $status = 1;
            $btnPayment = "";
            $btnTicket = "";
            $CardID = $row['CardID'];
            $CardStatus = $row['CardStatus'];
            $CardToken = $row['CardToken'];
            $CardSBuyTime = DateThai($row['CardSBuyTime']);
            $EventID = $row['EventID'];
            $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
            $getEventPic = getOneValue("SELECT `Picture` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
            $getEventLocation = getOneValue("SELECT `Location` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
            $getEventDate = DateThai(getOneValue("SELECT `DateStart` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'"));
            $getShortURL = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
            $TicketName = $row['TicketName'];
            $TicketPrice = $row['TicketPrice'];
            $MaximumCapacity = $row['MaximumCapacity'];
            $ShortURL = $actual_link = "eventview/".$getShortURL;
            if ($CardStatus == 0){
                $colorBar = "#fff6ea";
                $statusText = "ยังไม่ได้จ่ายเงิน";
                $btnPayment = "<a class='btnlogin'href='payment.php?token=$CardToken' style='background-color:red;'>จ่ายเงิน</a>";
            }else if ($CardStatus == 1){
                $colorBar = "#f1ffef";
                $statusText = "จ่ายเงินแล้ว";
            }
            else if ($CardStatus == 2){
                $colorBar = "#effeff";
                $statusText = "คอนเฟริมแล้ว";
                $btnTicket = "<a class='btnlogin'href='showmeyourticket/$CardToken' style='background-color:#67c100;'>ปริ้นบัตรเข้างาน</a>";
            }
            else if ($CardStatus == 3){
                $colorBar = "#ffe2e2";
                $statusText = "ยกเลิก";
            }
            else if ($CardStatus == 4){
                $colorBar = "#f1ffef";
                $statusText = "เข้าร่วมเรียบร้อย";
            }


            echo "
<div class='eventCard'>
    <div class='eventTopic' style='background-color: $colorBar;'>
        <p>[$statusText] $TicketName : $getEventName</p>
    </div>
    <div class='col-lg-4'>
        <a href='$ShortURL' target='_blank'><img src='img/event/$getEventPic' alt='' width='100%'></a>
    </div>
    <div class='col-lg-8'>
        <p id='eventInfo'><p style='font-size:15px' class='fas fa-location-arrow'></p> สถานที่ : $getEventLocation</p>
        <p id='eventInfo'><p style='font-size:15px' class='fas fa-calendar-alt'></p> วันที่จัดกิจกรรม : $getEventDate</p>
        <p id='eventInfo'><p style='font-size:15px' class='far fa-calendar-check'></p> วันที่ซื้อบัตร : $CardSBuyTime</p>
        <br>
        <h6 style='color:var(--font-gray);opacity:0.4;'>Token : $CardToken</h6>
        <br>
        $btnPayment <a class='btnlogin'href='ticket_show.php?token=$CardToken'>ดูรายละเอียด</a> $btnTicket 
    </div>
</div>

            ";
        }
        if ($status != 1) {
            echo "
            <p id='notfound'>ไม่มีกิจกรรมที่สมัคร</p>
            <p id='notfound'><a href='index.php'>ค้นหากิจกรรม</a></p>";
        } else {
        }
        ?>


    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>


<? //------------------------------------------
}

?>


<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
</head>





