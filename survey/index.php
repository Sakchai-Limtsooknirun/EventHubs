
<?
$path    = basename(realpath(__DIR__ . '/..'));
$eventid = $_GET['id'];
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
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
}else{ //--------------------- ------------------------
?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
      <h2>แบบสำรวจความพึงพอใจ</h2>
      <center><p>BNK48 Concert</p></center>
        <? print_r($_GET);
        ?>
<div class="slidecontainer">
  <p>Custom range slider:</p>
  <input type="range" min="0" max="10" value="0" class="sliderSurvey">
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




