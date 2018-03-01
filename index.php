<?php
include 'header.php';
if ($type == "NotLogin"){
	$btnHome = "<a href='signup.php' class='btnHome'>ลงทะเบียนฟรี</a>";
}else{
	$btnHome = "คุณสามารถค้นหางานอบรมในเรื่องที่คุณชอบที่กล่องค้นหาด้านล่าง";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HOME</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="imageHome">
	<div class="textHome">
	  	<h1>ค้นหางานอบรมในเรื่องที่คุณชอบ</h1>
		<?echo $btnHome; ?>
	</div>

</div>
</body>
</html>
