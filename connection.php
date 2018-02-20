<?php
//$con= mysqli_connect("localhost","admin","jay23513","mydatabase") or die("Error: " . mysqli_error($con));
$mysql_server = "sql12.freesqldatabase.com";
$mysql_user = "sql12221791";
$mysql_password = "kttagxITs8";
$mysql_db = "sql12221791";
$con = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
if ($con->connect_errno) {
	printf("Connection failed: %s \n", $con->connect_error);
	exit();
}
$con->set_charset("utf8");