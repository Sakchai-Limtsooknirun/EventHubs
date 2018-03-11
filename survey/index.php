
<?
$path    = basename(realpath(__DIR__ . '/..'));
$eventid = $_GET['id'];
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
$surveyStatus = getOneValue("SELECT `SurveyStatus` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
}else if (empty($eventid)){
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    exit;
}else if ($surveyStatus == "1"){
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    exit;
}else{ //--------------------- ------------------------
    $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getEventID = getOneValue("SELECT `ID` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getEventIDCheck = getOneValue("SELECT COUNT(`OwnerID`) AS 'get' FROM `EventSurvey` WHERE `EventID` = '$getEventID' AND `OwnerID` = '$usernameID'");
    $getShortURL = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $status = 0;
    if ($getEventIDCheck == "0"){
        $checkJoin = getOneValue("SELECT COUNT(`CardID`) AS 'get' FROM `EventHandler` INNER JOIN EventTicket ON EventHandler.TicketID = EventTicket.TicketID WHERE EventTicket.EventID = '$getEventID' AND `OwnerID` = '$usernameID'");
        if ($checkJoin > 0 ){
            $status = 2;
        }else{
            $status = 1;
        }
    }else{
        $status = 1;
    }
}
if ($status == "1"){
?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
      <h2>แบบสำรวจความพึงพอใจ</h2>
      <center><h3><? echo$getEventName;?></h3>
      <br>
      <h4>คุณได้ทำแบบสำรวรความพึงพอใจไปแล้วหรือคุณไม่ได้เข้าร่วมกิจกรรม</h4>
      <p><a href='eventview/<?echo$getShortURL;?>' >คลิกที่นี่ </a>เพื่อกลับเข้าสู่หน้ากิจกรรม</p></center>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>


<? //------------------------------------------
}else if ($status == "2"){
?>
<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
      <h2>แบบสำรวจความพึงพอใจ</h2>
      <center><h3><? echo$getEventName;?></h3></center>
      <br>

<div class="slidecontainer">
    <div class="surveyEach">
        <div class="row">
            <div class="col-lg-3">
                <h4>คะแนนด้านสถานที่จัดงาน</h4>
                <small>ความพร้อม ความสะอาด</small>
            </div>
            <div class="col-lg-8">
                <input type="range" min="0" max="10" value="0" class="sliderSurvey" onchange="showValue(this,'locationScore');">
            </div>
            <div class="col-lg-1">
                <p id="locationScore"></p>
            </div>
        </div>
    </div>
    <div class="surveyEach">
        <div class="row">
            <div class="col-lg-3">
                <h4>คะแนนด้านการเดินทาง</h4>
                <small>เดินทางสะดวก</small>
            </div>
            <div class="col-lg-8">
                <input type="range" min="0" max="10" value="0" class="sliderSurvey" onchange="showValue(this,'moveScore');">
            </div>
            <div class="col-lg-1">
                <p id="moveScore"></p>
            </div>
        </div>
    </div>
    <div class="surveyEach">
        <div class="row">
            <div class="col-lg-3">
                <h4>คะแนนด้านการดูแล</h4>
                <small>Staff การดูแลเอาใจใส่</small>
            </div>
            <div class="col-lg-8">
                <input type="range" min="0" max="10" value="0" class="sliderSurvey" onchange="showValue(this,'staffScore');">
            </div>
            <div class="col-lg-1">
                <p id="staffScore"></p>
            </div>
        </div>
    </div>
    <div class="surveyEach">
        <div class="row">
            <div class="col-lg-3">
                <h4>คะแนนด้านอุปกรณ์สื่อ</h4>
                <small>อุปกร์ณสื่อต่างๆ</small>
            </div>
            <div class="col-lg-8">
                <input type="range" min="0" max="10" value="0" class="sliderSurvey" onchange="showValue(this,'itScore');">
            </div>
            <div class="col-lg-1">
                <p id="itScore"></p>
            </div>
        </div>
    </div>
    <div class="surveyEach">
        <div class="row">
            <div class="col-lg-3">
                <h4>คะแนนด้านการจัดการ</h4>
                <small>การจัดคิว การจัดการอื่นๆ</small>
            </div>
            <div class="col-lg-8">
                <input type="range" min="0" max="10" value="0" class="sliderSurvey" onchange="showValue(this,'manageScore');">
            </div>
            <div class="col-lg-1">
                <p id="manageScore"></p>
            </div>
        </div>
    </div>
    <div class="surveyEach">
        <div class="row">
            <div class="col-lg-3">
                <h4>คะแนนด้านความปลอดภัย</h4>
                <small>เจ้าหน้าที่รักษาความปลอดภัย การดูแลทรัพย์สิน</small>
            </div>
            <div class="col-lg-8">
                <input type="range" min="0" max="10" value="0" class="sliderSurvey" onchange="showValue(this,'sucScore');">
            </div>
            <div class="col-lg-1">
                <p id="sucScore"></p>
            </div>
        </div>
    </div>
</div>
<h3 id="allSum"></h3>
<form action="survey/surveyed.php" method="post">
    <input type="hidden" name="id" value="<? echo$getEventID?>">
    <input type="hidden" id="avgScore" name="avgScore">
    <p>คำแนะนำเพิ่มเติม</p>
    <textarea name="recCom" class="form-control" rows="5"></textarea>
    <br>
    <p></p>
    <button type="submit" class="btnlogin">ส่ง</button>
</form>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>
<script>
var count = 0;
var sum = 0;
var avg = 0;
function showValue(id,s){
    var show = document.getElementById(s);
    var allSum = document.getElementById("allSum");
    var avgScore = document.getElementById("avgScore");
    show.innerHTML = id.value+"/10";
    show.text = id.value;
    count++;
    sum+=parseInt(id.value);
    avg = sum/count;
    avg = parseFloat(avg).toFixed(2);
    avgScore.value = avg;
    allSum.innerHTML = "คะแนนเฉลี่ยรวม : "+avg+" / 10";
}
</script>
<?
}
?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
</head>




