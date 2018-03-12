
<?
include 'header.php';
$usernameID = ownerID($username);
$token = $_GET['token'];
$date    = date("Y-m-d H:i:s");
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
    $getEventPic = getOneValue("SELECT `Picture` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    $getShortURL = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
    store_log($username,"ยกเลิกบัตร ".$token);
    $sql_update    = "UPDATE `EventHandler` SET `CardStatus`='3',`CancelTime`='$date' WHERE `CardToken` = '$token'";
    $result_update = mysqli_query($con, $sql_update);
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'ticket.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'ticket.php?st=4'; ";
        echo "</script>";}
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
                <h4>กำลังยกเลิก</h4>
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





