<?php
include 'connection.php';
$eventid = $_POST["eventid"];
$owner   = $_POST["owner"];
$cat     = $_POST["cat"];
$title   = $_POST["title"];
$type    = $_POST["type"];
$desc    = $_POST["desc"];
$date    = date("Y-m-d H:i:s");
// print_r($_POST);
if (empty($_POST)) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
} else {
	if($type==1){
		$cat = "-";
	}
    $sql    = "INSERT INTO `Webboard` VALUES ('','$eventid','$owner','$date','$type','$title','$cat','$desc')";
    $result = mysqli_query($con, $sql);
    $getEventShort = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$eventid'");
    $url = "webboard/".$getEventShort;
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location = '$url'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = '$url'; ";
        echo "</script>";}
}
