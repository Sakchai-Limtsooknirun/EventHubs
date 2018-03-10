
<?
include 'header.php';
$usernameID = ownerID($username);
$token = $_GET['token'];
$ownerID = getOneValue("SELECT `OwnerID` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");

if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
}else if(empty($token)){
    echo "<script type='text/javascript'>";
    echo "window.location = 'ticket.php?st=2'; ";
    echo "</script>";
    exit;
}else if ($usernameID != $ownerID){
    echo "<script type='text/javascript'>";
    echo "window.location = 'ticket.php?st=3'; ";
    echo "</script>";
    exit;
}else{
    $getTicketID = getOneValue("SELECT `TicketID` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
    $EventID = getOneValue("SELECT `EventID` AS 'get' FROM `EventTicket` WHERE `TicketID` = '$getTicketID'");
    $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    $getEventPic = getOneValue("SELECT `Picture` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    $getBuyTime = DateThai(getOneValue("SELECT `CardSBuyTime` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'"));
    $getCancelTime = DateThai(getOneValue("SELECT `CancelTime` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'"));
    $getPaymentTime = DateThai(getOneValue("SELECT `PaymentTime` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'"));
    $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    $getEventLocation = getOneValue("SELECT `Location` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    $getEventDate = DateThai(getOneValue("SELECT `DateStart` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'"));
    $getShortURL = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    $CardStatus = getOneValue("SELECT `CardStatus` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
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
    }
    else if ($CardStatus == 3){
        $colorBar = "#ffe2e2";
        $statusText = "ยกเลิก";
    }
    else if ($CardStatus == 4){
        $colorBar = "#f1ffef";
        $statusText = "เข้าร่วมเรียบร้อย";
    }
?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
        <h2><? echo$getEventName; ?></h2>

        <div class="row">
            <div class="col-lg-7">
                <a href='eventview/<?echo $getShortURL;?>' target='_blank'><img src="img/event/<?echo $getEventPic; ?>" alt="" width='100%'></a>
            </div>
            <div class="col-lg-5 well">
                <h1 style="text-align: center;"><? echo$statusText; ?></h1>
                <hr>
                <h4>รายละเอียดการซื้อบัตร</h4>
                <p id='eventInfo'><p style='font-size:15px' class='fas fa-location-arrow'></p> สถานที่ : <? echo$getEventLocation; ?></p>
                <p id='eventInfo'><p style='font-size:15px' class='fas fa-calendar-alt'></p> วันที่จัดกิจกรรม : <? echo$getEventDate; ?></p>
                <p id='eventInfo'><p style='font-size:15px' class='far fa-calendar-check'></p> วันที่ซื้อบัตร : <? echo$getBuyTime; ?></p>
                <?
                if ($CardStatus == 1 || $CardStatus == 2){
                    echo "<p id='eventInfo'><p style='font-size:15px' class='far fa-calendar-check'></p> วันที่ชำระเงิน : $getPaymentTime</p><p>* รอทีมงานตรวจสอบการชำระเงินภายใน 24 ชั่วโมง</p>";
                }else if ($CardStatus == 3){
                    echo "<p id='eventInfo'><p style='font-size:15px' class='far fa-calendar-check'></p> วันที่ยกเลิก : $getCancelTime</p>";
                }

                if ($CardStatus < 2){
                    echo "<br><a href='cancel.php?token=$token'><h6>แจ้งยกเลิก</h6></a>";
                }

                ?>
            </div>
        </div>
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





