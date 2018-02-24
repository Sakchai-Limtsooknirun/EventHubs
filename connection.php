<?php
//$con= mysqli_connect("localhost","admin","jay23513","mydatabase") or die("Error: " . mysqli_error($con));
$mysql_server = "csku.science";
$mysql_user = "spppaper_pjmt";
$mysql_password = "0fFBvKgv";
$mysql_db = "spppaper_pjmt";
$con = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
if ($con->connect_errno) {
	printf("Connection failed: %s \n", $con->connect_error);
	exit();
}
$con->set_charset("utf8");