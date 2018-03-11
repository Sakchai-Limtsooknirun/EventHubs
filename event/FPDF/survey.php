
<?
$path = basename(realpath(__DIR__ . '/..'));
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else if ($type == "Organizer") {
    //--------------------- Organizer ------------------------
    ?>


<body>

    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
    </div>



    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard " >
        <?
    if (!empty($_GET)) {

        $EventID   = $_GET['eid'];
        $surveyStatus = getOneValue("SELECT `SurveyStatus` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
        if ($surveyStatus == 0){
          $link = "<button class='btnlogin'><a href='event/surveyOr.php?id=$EventID&st=1'>ปิดแบบสอบถาม</a></button>";
        }else{
          $link = "<button class='btnlogin'><a href='event/surveyOr.php?id=$EventID&st=0'>เปิดแบบสอบถาม (ส่งแจ้งเตือน)</a></button>";
        }
        echo "<h2>แบบสำรวจความพึงพอใจ <small>$EventName</small></h2>
        <center>$link</center><br>
        <table class = ' table table-hover table-borderd' style='width:100%;color:black;'>
        <tr>
              <th style='text-align:center;width:80px;'>ลำดับ</th>
              <th>ชื่อจริง-นามสกุล</th>
              <th>วันเวลาที่ประเมิน</th>
              <th>คะแนนประเมิน</th>
              <th>คำแนะนำอื่นๆ</th>
         </tr>
                ";
        $count = 1;
        $result = mysqli_query($con, "SELECT * FROM `EventSurvey` WHERE `EventID` = '$EventID' ORDER BY `SurveyID` DESC");
        $avgScoreAllAum = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $status      = 1;
            $SurveyID    = $row['SurveyID'];
            $OwnerID    = $row['OwnerID'];
            $firstName = getOneValue("SELECT `Firstname` AS 'get' FROM `user` WHERE `ID` = '$OwnerID'");
            $lastName = getOneValue("SELECT `Lastname` AS 'get' FROM `user` WHERE `ID` = '$OwnerID'");
            $dateSurvey    = DateThai($row['SurveyTime']);
            $avgScore    = $row['SurveyPoint'];
            $recCom    = $row['SurveyRecom'];

            echo "          <tr>
            <td style='text-align:center;'>$count</td>
            <td>$firstName $lastName</td>
            <td>$dateSurvey</td>
            <td>$avgScore</td>
            <td>$recCom</td>
          </tr>";
            $count ++;
            $avgScoreAllAum += $avgScore;

        }
        $avgScoreAllAum = $avgScoreAllAum/($count-1);
          echo "<tr>
            <td style='text-align:center;'></td>
            <td></td>
            <td style='text-align:right;'>คะแนนเฉลี่ยรวม :</td>
            <td>$avgScoreAllAum</td>
            <td></td>
          </tr></table>";
        if ($status != 1){
          echo "<h4><center>ไม่มีคนประเมิน</center></h4>";
        }else{
        }
    } else {

        echo "<center><h1>คุณไม่มีสิทธิเข้าหน้านี้</h1></center>";

        ?>
          </div>
            <?
    }
    ?>
        </div>
        <hr>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">

    </div>
</body>


<?//------------------------------------------
} else {

    ?>
<body>
  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
  </div>
  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
            <p>คุณไม่มีสิทธิเข้าหน้านี้</p>
  </div>
  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
  </div>
</body>
    <?
}

?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
