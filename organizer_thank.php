
<?
include 'header.php';
$usernameID = ownerID($username);
echo $usernameID;
?>
<head>
    <meta charset="UTF-8">
    <title>Eventhubs | สมัครเป็นผู้จัด</title>
    <link rel="stylesheet" href="css/style.css">
<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard" style="margin-bottom: 80px;">
      <?
if (empty($_POST)) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'organizer.php?st=1'; ";
    echo "</script>";
    exit;

} else {
  $nameOr = $_POST['nameOr'];
  $telOr = $_POST['telOr'];
  $timeOr = $_POST['timeOr'];
  $emailOr = $_POST['emailOr'];
  $sizeOr = $_POST['sizeOr'];
  $typeOr = $_POST['typeOr'];
  $addicOR = $_POST['addicOR'];
  $dateCreate    = date("Y-m-d H:i:s");
  $sql    = "INSERT INTO `OrganizerRegister`(`RegisID`, `OrName`, `OrTel`, `OrTelTime`, `OrEmail`, `OrSize`, `OrType`, `OrAddcit`, `OrCreate`, `OwnerID`,`OrStatus`) VALUES ('','$nameOr','$telOr','$timeOr','$emailOr','$sizeOr','$typeOr','$addicOR','$dateCreate','$usernameID','')";
  $result = mysqli_query($con, $sql);

  if ($result) {

  } else {
      echo "<script type='text/javascript'>";
      echo "window.location = 'organizer.php?st=2'; ";
      echo "</script>";}

?>
<h2>สมัครเป็นผู้จัด</h2>
<center><h3>ขอบคุณที่สมัคร จะมีเจ้าหน้าติดต่อไปตามข้อมูลที่ท่านให้</h3></center>
</div>

<?

}

?>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>
<script type="text/javascript">

$(document).ready(function(){
  $('#save').prop('disabled',true);
$('#visto').click(function(){

  if($(this).is(':checked'))
  {
    $('#save').prop('disabled',false);

  }
  else
  {
    $('#save').prop('disabled',true);
  }
});

});
</script>
</head>




