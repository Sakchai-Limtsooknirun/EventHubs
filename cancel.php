
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
    systemLog("$username พยายามยกเลิกกิจกรรมโดยไม่ใช้ Token");
    echo "<script type='text/javascript'>";
    echo "window.location = 'ticket.php?st=2'; ";
    echo "</script>";
    exit;
}else if ($usernameID != $ownerID){
    systemLog("$username พยายามยกเลิกกิจกรรมของผู้อื่น token : $token");
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

?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
        <h2>แจ้งยกเลิก</h2>

        <div class="row">
            <div class="col-lg-7">
                <a href='eventview/<?echo $getShortURL;?>' target='_blank'><img src="img/event/<?echo $getEventPic; ?>" alt="" width='100%'></a>
            </div>
            <div class="col-lg-5 well">
                <h4>คุณแน่ใจหรือไม่ว่าจะยกเลิกกิจกรรม</h4>
                <small>หากคุณยกเลิกในขณะที่จ่ายเงินแล้ว ทางบริษัทจะไม่คืนเงินในทุกกรณี</small>
                <br>
                <br>
                <a href="canceler.php?token=<?echo$token;?>"><button class="btn-danger">ยืนยันการยกเลิก</button></a>
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





