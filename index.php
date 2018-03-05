<?php
include 'header.php';
if ($type == "NotLogin"){
	$btnHome = "<a href='signup.php' class='btnHome'>ลงทะเบียนฟรี</a>";
}else{
	$btnHome = "คุณสามารถค้นหางานกิจกรรมในเรื่องที่คุณชอบที่กล่องค้นหาด้านล่าง";
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
	  	<h1>ค้นหางานกิจกรรมในเรื่องที่คุณชอบ</h1>
		<?echo $btnHome; ?>
	</div>
</div>

<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
   <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
        <?
        $result = mysqli_query($con, "SELECT * FROM `EventOrganizers` ORDER BY `DateStart` ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            $status = 1;
            $EventName = $row['EventName'];
            $Eventpic = $row['Picture'];
            $EventStatus = $row['EventStatus'];
            $Location = $row['Location'];
            $DateStart = DateThai($row['DateStart']);
            $CapacityNow = $row['CapacityNow'];
            $MaximumCapacity = $row['MaximumCapacity'];
            $ShortURL = $row['ShortURL'];
            $ShortURL = $actual_link = "eventview/".$ShortURL;
            echo "
<div class='eventCard'>
    <div class='eventTopic'>
        <p><a href='$ShortURL'>$EventName</a></p>
    </div>
    <div class='col-lg-6'>
        <a href='$ShortURL'><img src='img/event/$Eventpic' alt='' width='100%'></a>
    </div>
    <div class='col-lg-6'>
        <p id='eventInfo'><span class='glyphicon glyphicon-pushpin'></span> $Location</p>
        <p id='eventInfo'><span class='glyphicon glyphicon-calendar'></span> $DateStart</p>
        <p id='eventInfo'><span class='glyphicon glyphicon-user'></span> $CapacityNow / $MaximumCapacity คน</p>
        <br>
        <a class='btnlogin'href='#event-showtimes'>เข้าร่วม</a>
    </div>
</div>

            ";
        }
        if ($status != 1) {
            echo "
            <p id='notfound'>ไม่มีกิจกรรม</p>
            <p id='notfound'><a href='#'>สร้างกิจกรรมใหม่</a></p>";
        } else {
        }
        ?>


    </div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
</body>
</html>
