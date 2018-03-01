<?
$path    = basename(__DIR__);
$eventid = $_GET["event"];
echo "<base href='/$path/'>";
include 'header.php';
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else {
    $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$eventid'");
    if ($getEventName == "") {
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
    	$getEventShort = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$eventid'");
        ?>

<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
		<a href="#waiting"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?echo $getEventName; ?></a> <a href="webboard/<?echo $getEventShort; ?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> กระดานสนทนา</a> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> สร้างกระทู้สนทนาใหม่
		<h2><?echo $getEventName; ?></h2>
<form class="form-horizontal inputwebboard" action="webboard_posted.php" method="post">
  <div class="form-group">
    <label  class="col-sm-2 control-label">หัวข้อสนทนา</label>
    <div class="col-sm-9">
    	<input type="hidden" name="eventid" value="<? echo$eventid;?>">
    	<input type="hidden" name="type" value="0">
    	<input type="hidden" name="owner" value="<? echo$username;?>">
      <input type="text" class="form-control" name="title" placeholder="หัวข้อ" required>
    </div>
  </div>
<div class="form-group">
    <label  class="col-sm-2 control-label">ประเภทสนทนา</label>
    <div class="col-sm-9">
	<select class="form-control" name="cat">
	  <option value="สนทนาทั่วไป">สนทนาทั่วไป</option>
	  <option value="สอบถามปัญหาทั่วไป">สอบถามปัญหาทั่วไป</option>
	  <option value="สอบถามปัญหาเกี่ยวกับการชำระเงิน">สอบถามปัญหาเกี่ยวกับการชำระเงิน</option>
	  <option value="สอบถามเรื่องการเปลี่ยนแปลงข้อมูล">สอบถามเรื่องการเปลี่ยนแปลงข้อมูล</option>
	  <option value="สอบถามเกี่ยวกับสถานที่จัดงาน การเดินทาง">สอบถามเกี่ยวกับสถานที่จัดงาน การเดินทาง</option>
	  <option value="อื่นๆ">อื่นๆ</option>
	</select>
    </div>
  </div>
<div class="form-group">
    <label  class="col-sm-2 control-label">เนื้อหา</label>
    <div class="col-sm-9">
      <textarea class="form-control" rows="5" name="desc" required></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btnlogin">สร้าง</button>
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
    <title>Eventhubs | สร้างกระทู้สนทนา <?echo $getEventName; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
