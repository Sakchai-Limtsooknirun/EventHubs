<?php
session_start();
include 'connection.php';
store_log($_SESSION['Username'],'ล็อคเอ้าสำเร็จ');     //log
session_destroy();
header("Location: index.php ");
?>