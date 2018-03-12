<?

$path = basename(realpath(__DIR__ . '/.'));
include 'header.php';
echo "<base href='/$path/'>";
$token = $_GET['id'];
$bgNumber = "img/bg/".rand(1,11).".png";
$getEventID = getOneValue("SELECT EventTicket.EventID AS 'get' FROM `EventHandler` INNER join EventTicket on EventHandler.TicketID = EventTicket.TicketID WHERE `CardToken` = '$token'");
$getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");
$getEventPic = getOneValue("SELECT `Picture` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");
$getEventLocation = getOneValue("SELECT `Location` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");
$getEventDate = DateThai(getOneValue("SELECT `DateStart` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'"));
$getTicketStatus = getOneValue("SELECT `CardStatus` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
$actual_link = dirname(dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"))."/s/".$token."/";
$showSccusee = "";

if (empty($token)){
	echo "No";
}else if ($getEventID == ""){
	echo "No";
}else if ($getTicketStatus < 2 && $getTicketStatus != 3){
	echo "No";
}else{
	if ($getTicketStatus == "4"){
		$showSccusee = "<h2 style='background-color:red;color:white;'>เข้าร่วมงานแล้ว</h2>";
	}
?>





<html>
	<body>
		<div class="ticketShowNow"></div>
		<div class="row">
			<div class="col-xs-1 col-lg-2">
			</div>
			<div class="col-xs-10 col-lg-8 contain webboard">
				<div class="row">
					<div class="col-lg-6">
						<h1>บัตรเข้างาน</h1>
						<h3><? echo $getEventName;?></h3>
						<? echo$showSccusee;?>
						<div class="row">
							<div class="col-lg-5 subTicket">
								<p class="fas fa-location-arrow" style="font-size: 3em;"></p>
								<p></p>
								<p><? echo$getEventLocation;?></p>
							</div>
							<div class="col-lg-5 subTicket">
								<p class="fas fa-calendar-alt" style="font-size: 3em;"></p>
								<p></p>
								<p><? echo$getEventDate;?></p>
							</div>
						</div>
						<div>
							<h4><b>วิธีใช้บัตรเข้างาน</b></h4>
							<ol>
								<li>ปริ้นบัตรเข้างานหรือบันทึกเป็นรูปภาพไว้ในโทรศัพท์</li>
								<li>ยื่นให้เจ้าหน้าที่ (Staff) ที่ประตูทางเข้า</li>
								<li>เจ้าหน้าที่จะทำการแสกน QR Code เพื่อระบุตัวตน</li>
								<li>สามารถเข้าร่วมงานได้</li>
								<small>ในกรณีที่ต้องการออกแล้วเข้าใหม่ ให้พก QR Code ติดตัวเสมอ</small>
							</ol>
						</div>
					</div>
					<div class="col-lg-6">
						<img src="http://chart.googleapis.com/chart?chs=500x400&cht=qr&chl=<? echo$actual_link;?>" style="width: 100%;height: auto;">
					</div>
				</div>

				<button onClick="window.print()" class="btnlogin" style="position: absolute;top:20;right: 20;">Print this page</button>

 				<p style="font-size: 1em;color:#e5e5e5;text-align: center;"><? echo$token;?></p>
 				<p class="logoFooter">EventHubs</p>
			</div>
			<div class="col-xs-1 col-lg-2">
			</div>
		</div>
	</body>
</html>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>


body{
  background-size: cover;
  background:url("<?php echo $bgNumber; ?>") repeat center center fixed;
}
.logoFooter{
	font-size: 2em;
	text-align: center;
	color:var(--main-color-dark);
	margin-bottom: -30px;
}
.subTicket{
	/*margin-top: 40px;*/
	font-size: 1em;
	color:#6b6b6b;
	text-align: center;
	padding:10px 20px;
	margin:10px;
	background-color: #efefef;



}
.subTicket p{
	vertical-align: middle;
}
</style>


<?
}
?>