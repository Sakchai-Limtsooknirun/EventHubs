
<?
$path    = basename(realpath(__DIR__ . '/..'));
$eventid = $_POST['id'];
$avg = $_POST['avgScore'];
$reccom = $_POST['recCom'];
echo "<base href='/$path/'>";
include '../header.php';
$date    = date("Y-m-d H:i:s");
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
}else{
    $sql = "INSERT INTO `EventSurvey`(`SurveyID`, `EventID`, `OwnerID`, `SurveyTime`, `SurveyPoint`, `SurveyRecom`) VALUES ('','$eventid','$usernameID','$date','$avg','$reccom')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'survey/thank.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'index.php'; ";
        echo "</script>";}
}
?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
</head>




