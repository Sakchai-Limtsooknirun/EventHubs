<?
$path    = basename(__DIR__);
$eventid = $_GET["eventid"];
echo "<base href='/$path/'>";
include 'header.php';
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else {
    $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    if ($getEventName == "") {
        ?>

<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
		<center><h2>ไม่พบหน้าเว็บบอร์ดของกิจกรรมดังกล่าวหรือไม่เปิดให้ใช้งาน</h2></center>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
</body>

		<?
    } else {
        $getEventID = getOneValue("SELECT `ID` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
        $getEventShort = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");
        $urlEvent = "eventview/".$getEventShort;
        ?>

<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
		<a href="<? echo $urlEvent; ?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?echo $getEventName; ?></a> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กระดานสนทนา
		<h2><?echo $getEventName; ?></h2>
		<div class="wb">
		<?
        $result = mysqli_query($con, "SELECT * FROM `Webboard` WHERE `eventID` = '$getEventID' AND `wbType` = '0' ORDER BY wbID DESC");
        while ($row = mysqli_fetch_assoc($result)) {
     		$status = 1;
     		$wbID = $row['wbID'];
            $title = $row['wbTitle'];
            $cat = $row['wbCat'];
            $owner = $row['ownerID'];
            $date = $row['timeCreated'];
            echo "
            <div class='wbTopic'>
				<a href='webboard/$getEventShort/$wbID'><h4>$title</h4></a>
				<h6>หมวดหมู่ : $cat โดย $owner เมื่อ $date</h6></div>
			";
        }
        if ($status != 1) {
            echo "<p id='notfound'>ไม่พบหัวข้อสนทนา</p>";
        } else {
        }
        ?>
    	</div>
		<center><a href="webboard_post.php?event=<?echo $getEventID; ?>"><button class='btnlogin'>สร้างกระทู้สนทนาใหม่</button></a></center>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
</body>


		<?
    }
}

?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | กระดานสนทนา <?echo $getEventName; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
