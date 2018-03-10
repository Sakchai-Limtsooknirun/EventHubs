<?php
session_start();
include 'connection.php';
$username = null ;
$type = checkType($username);
$header_menu = "";
if (empty($_SESSION["Username"])) {
    $header_menu .= "
	  	<li><a href='form_login.php'>เข้าสู่ระบบ</a></li>
		<li><a href='signup.php'>ลงทะเบียนฟรี</a></li>";
} else {
	$username    = $_SESSION["Username"];
	$type     = checkType($username);
	if ($type == "Organizer"){
		$header_menu .= "
		<li class='btnFill'><a href='event/create.php'><span class='glyphicon glyphicon-plus'></span> สร้างกิจกรรมใหม่</a></li>
		<li><a href='event'><span class='glyphicon glyphicon-list'></span> จัดการกิจกรรม</a></li>
		";
	}

	else if ($type == "Admin"){
		$header_menu .= "
		<li class='btnFill'><a href='event/create.php'><span class='glyphicon glyphicon-plus'></span> สร้างกิจกรรมใหม่</a></li>
		<li><a href='event'><span class='glyphicon glyphicon-list'></span> จัดการกิจกรรม</a></li>
		<li><a href='ManageUser.php'>การจัดการสมาชิก</a></li>
		<li><a href='showLog.php'>จัดการlog</a></li>
		";
	}
	else if ($type == "User"){
		$header_menu .= "
		<li><a href='ticket.php'><span class='glyphicon glyphicon-list'></span> กิจกรรมที่เข้าร่วม</a></li>
		";
	}
    $header_menu .= "
		<li><a href='Profile.php'><span class='glyphicon glyphicon-user'></span> $username ($type)</a></li>
		<li><a href='logout.php'>ออกจากระบบ</a></li>";

}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link href="css/bootstrap-form-helpers.min.css" rel="stylesheet">
<script src="js/bootstrap-formhelpers.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

<style type="text/css">



:root {
  --main-bg-color: #98C8C8;
  --main-color-dark: #669393;
  --main-color-light: #83B4B4;
  --font-gray: #646D79;
}
body{
	background-color: var(--main-bg-color);
	color : white;
	font-family: 'Prompt', sans-serif;
}
.header{
	background-color: white;
	color : white;
	padding: 20px;
	margin:0px auto;
    top:0;
    left:0;
    right:0;
}
.header_logo{
	font-size: 2.3em;
	display: inline;
	padding-left: 20px;
}
.header_logo a{
	color:var(--main-color-dark);
	text-decoration: none;
}
.header_menu{
	display: inline;
	right: 10px;
	float: right;
    text-align: right;
    width: auto;
    padding-top: 15px;
}
.header_menu a{
	color: var(--font-gray);
	text-decoration: none;
	padding: 0px 15px;
	transition: 0.25s;
}
.header_menu a:hover{
	color: var(--main-color-dark);
	border-bottom: 2px solid var(--main-color-dark);
}
.header_menu p{
	display: inline;
	color: #646D79;
	text-decoration: none;
	padding: 0px 15px;
	transition: 0.25s;
}
.header_menu li{
    display:inline-block;
}
.show-menu {
    text-decoration: none;
    color:var(--main-color-dark);
    text-align: center;
    display: none;
}
@media screen and (max-width : 760px){
    .header_menu ul {
        position: static;
        display: none;
    }
    .header_menu li {
        margin-bottom: 1px;
    }
    .header_menu ul li, li a {
        width: 100%;
    }
    .show-menu {
        display:block;
    }
}
input[type=checkbox]{
    display: none;
}
input[type=checkbox]:checked ~ #menu{
    display: block;
    background-color: #fff;
    padding:20px;
    line-height: 3;
}
</style>
<div class='header'>
	<div class='header_logo'><a href="index.php">EventHubs</a></div>
	<div class='header_menu'>
		<label for="show-menu" class="show-menu"><span class="glyphicon glyphicon-menu-hamburger"></span></label>
    	<input type="checkbox" id="show-menu" role="button">
		<ul id="menu">
		<?echo $header_menu; ?>
		</ul>
	</div>
</div>