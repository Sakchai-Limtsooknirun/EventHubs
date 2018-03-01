<?
$path    = basename(__DIR__);
$wbID = $_GET["id"];
echo "<base href='/$path/'>";
include 'header.php';
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else {
    $getEventID = getOneValue("SELECT `eventID` AS 'get' FROM `Webboard` WHERE `wbID` = '$wbID'");
    if ($getEventID == "") {
        ?>

<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
		<center><h2>ไม่พบหน้าเว็บบอร์ดของงานอบรมดังกล่าวหรือไม่เปิดให้ใช้งาน</h2></center>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
</body>

		<?
    } else {
        $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");
        $getEventShort = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$getEventID'");
        $getwbTitle = getOneValue("SELECT `wbTitle` AS 'get' FROM `Webboard` WHERE `wbID` = '$wbID'");
        $getwbDesc = getOneValue("SELECT `wbDesc` AS 'get' FROM `Webboard` WHERE `wbID` = '$wbID'");
        $owner = getOneValue("SELECT `ownerID` AS 'get' FROM `Webboard` WHERE `wbID` = '$wbID'");
        $date = getOneValue("SELECT `timeCreated` AS 'get' FROM `Webboard` WHERE `wbID` = '$wbID'");
        ?>

<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
		<a href="#waiting"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?echo $getEventName; ?></a> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <a href="webboard/<?echo $getEventShort; ?>">กระดานสนทนา</a> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?echo $getwbTitle;?>
        <div class="Topicshow">
            <h1><?echo $getwbTitle;?></h1>
            <h3><?echo $getwbDesc;?></h3>
            <?echo$owner; ?> | <?echo$date; ?>
        </div>
		<div class="wb">
		<?
        $result = mysqli_query($con, "SELECT * FROM `Webboard` WHERE `wbType` = '1' AND `wbTitle` = '$wbID' ORDER BY wbID DESC");
        while ($row = mysqli_fetch_assoc($result)) {
     		$status = 1;
     		$wbID = $row['wbID'];
            $title = $row['wbDesc'];
            $cat = $row['wbCat'];
            $owner = $row['ownerID'];
            $date = $row['timeCreated'];
            echo "
            <div class='wbTopic'>
				<h4>$title</h4>
				<h6>โดย $owner เมื่อ $date</h6></div>
			";
        }
        if ($status != 1) {
            echo "<p id='notfound'>ยังไม่มีใครตอบกระทู้</p>";
        } else {
        }
        ?>
    	</div>
<form class="form-horizontal inputwebboard" action="webboard_posted.php" method="post">
<div class="form-group">
    <label  class="col-sm-2 control-label">แสดงความคิิดเห็น</label>
    <div class="col-sm-9">
        <input type="hidden" name="eventid" value="<? echo$getEventID;?>">
        <input type="hidden" name="type" value="1">
        <input type="hidden" name="title" value="<? echo$_GET['id'];?>">
        <input type="hidden" name="owner" value="<? echo$username;?>">
      <textarea class="form-control" rows="5" name="desc" required></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btnlogin">ตอบ</button>
    </div>
  </div>
</form>
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
