<?php
include 'header.php';
session_destroy();
header("Location: form_login.php ");
?>