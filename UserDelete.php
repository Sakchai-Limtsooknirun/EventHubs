<?php
session_start();
include 'connection.php';

if ((isset($_SESSION["Username"]) && isset($_GET['IDedit']))){
    $query = "DELETE FROM user
            WHERE ID ='{$_GET['IDedit']}' ";
    $data = mysqli_query($con,$query);
    
}if ($data == TRUE) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'Edit.php'; ";
    echo "</script>";
}
mysql_close();





?>