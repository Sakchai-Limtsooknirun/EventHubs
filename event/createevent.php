<?php
session_start();
include '../connection.php';
$eventName     = $_POST["eventName"];
$eventDesc     = trim($_POST["eventDesc"]);
$eventDesc     = preg_replace("/\r\n|\r/", "<br />", $eventDesc);
$eventDesc     = nl2br($eventDesc);
$eventType     = $_POST["eventType"];
$eventLocation = $_POST["eventLocation"];
$eventPic      = $_POST["eventPic"];
$eventDate     = $_POST["eventDate"];
$eventRole     = $_POST["eventRole"];
$eventCapi     = $_POST["eventCapi"];
$eventURL      = $_POST["eventURL"];
$eventColor    = $_POST["eventColor"];
$eventMapLat   = $_POST["eventMapLat"];
$eventMapLng   = $_POST["eventMapLng"];
$eventOrgName  = $_POST["eventOrgName"];
$eventCtTell   = $_POST["eventCtTell"];
$eventCtEmail  = $_POST["eventCtEmail"];
$eventFacebook = $_POST["eventFacebook"];
$dateCreate    = date("Y-m-d H:i:s");
$username      = $_SESSION["Username"];
$type          = checkType($username);
$file_name     = $_FILES['eventPic']['name'];
$getOwnerID    = getOneValue("SELECT `ID` AS 'get' FROM `user` WHERE `Username` = '$username'");
//เพิ่มเข้าไปในฐานข้อมูล
$sql = "INSERT INTO `EventOrganizers` VALUES ('','$eventRole','','$eventName','$eventType','$eventDesc','$file_name','','$eventDate','','$eventLocation','$eventCapi','0','','','','$getOwnerID','$eventURL','0','$eventColor','$eventMapLat','$eventMapLng','$eventOrgName','$eventCtTell','$eventCtEmail','$eventFacebook')";

echo $sql;
if (isset($_FILES['eventPic'])) {
    echo "have image";
    $errors    = array();
    $file_name = $_FILES['eventPic']['name'];
    $file_size = $_FILES['eventPic']['size'];
    $file_tmp  = $_FILES['eventPic']['tmp_name'];
    $file_type = $_FILES['eventPic']['type'];
    $file_ext  = strtolower(end(explode('.', $_FILES['eventPic']['name'])));

    $expensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "../img/event/" . $file_name);
        echo "Success";
    } else {
        print_r($errors);
    }
} else {
    echo "dfdf";
}
$result = mysqli_query($con, $sql);
if ($result) {
    echo "<script type='text/javascript'>";
    echo "window.location = '/'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'create.php?st=1'; ";
    echo "</script>";
}

mysqli_close($con);
