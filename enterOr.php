<?

$path = basename(realpath(__DIR__ . '/.'));
include 'header.php';
echo "<base href='/$path/'>";
$token = $_GET['id'];
$bgNumber = "img/bg/".rand(1,11).".png";
$getEventID = getOneValue("SELECT EventTicket.EventID AS 'get' FROM `EventHandler` INNER join EventTicket on EventHandler.TicketID = EventTicket.TicketID WHERE `CardToken` = '$token'");
$getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");

$getTicketStatus = getOneValue("SELECT `CardStatus` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
$actual_link = dirname(dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"))."/s/".$token."/";
$showSccusee = "";

if (empty($token)){
	echo "No1";
}else if ($getEventID == ""){
	echo "No2";
}else if ($getTicketStatus < 2 && $getTicketStatus != 3){
	echo "No3";
}else if ($type != "Organizer"){
	echo "No4";
}else{
	if ($getTicketStatus == "4"){
		$showSccusee = "<h2 style='background-color:red;color:white;'>เข้าร่วมงานแล้ว</h2>";
	}else{
		$sql = "UPDATE `EventHandler` SET `CardStatus`='4' WHERE `CardToken` = '$token'";
	    $result = mysqli_query($con, $sql);
	    if ($result) {
	            echo "<script type='text/javascript'>";
	            echo "window.alert('ยืนยันการเข้าร่วมงาน'); ";
	            echo "</script>";
	    } else {
	            echo "<script type='text/javascript'>";
	            echo "window.location = 'index.php'; ";
	            echo "</script>";
	    }
	}

    $getOwnerID = getOneValue("SELECT `OwnerID` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
    $getFirst = getOneValue("SELECT `Firstname` AS 'get' FROM `user` WHERE `ID` = '$getOwnerID'");
    $getLast = getOneValue("SELECT `Lastname` AS 'get' FROM `user` WHERE `ID` = '$getOwnerID'");

?>





<html>
	<body>
		<div class="ticketShowNow"></div>
		<div class="row">
			<div class="col-xs-1 col-lg-2">
			</div>
			<div class="col-xs-10 col-lg-8 contain webboard">
				<h2>ยืนยันการเข้าร่วมงาน</h2>
			<center><h3><? echo$getEventName;?></h3>
				<? echo$showSccusee;?>
				<h3>คุณ <? echo $getFirst." ".$getLast;?></h3></center>
 				<p style="font-size: 1em;color:#e5e5e5;text-align: center;"><? echo$token;?></p>
			</div>
			<div class="col-xs-1 col-lg-2">
			</div>
		</div>
	</body>
</html>
<link rel="stylesheet" type="text/css" href="css/style.css">

<?
}
?>