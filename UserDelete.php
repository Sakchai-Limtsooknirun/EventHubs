<?php
session_start();
include 'connection.php';

if ((isset($_SESSION["Username"]) && isset($_GET['IDedit']))){
    $query = "DELETE FROM user
            WHERE ID ='{$_GET['IDedit']}' ";
    $data = mysqli_query($con,$query);
    $DLusername = getOneValue("SELECT Username AS 'get' FROM user WHERE ID ='{$_GET['IDedit']}' ");
    store_log($_SESSION['Username'],"ทำการลบ Username .'$DLusername'");
}if ($data == TRUE) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'ManageUser.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'adminEdit.php'; ";
    echo "</script>";
}
mysql_close();





?>