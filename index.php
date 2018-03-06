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
<!-- <div class="imageHome">
	<div class="textHome">
	  	<h1>ค้นหางานกิจกรรมในเรื่องที่คุณชอบ</h1>
		<?echo $btnHome; ?>
	</div>
</div> -->
<div id="captioned-gallery">
    <figure class="slider">
        <figure>
            <img src="https://images.unsplash.com/photo-1515603403036-f3d35f75ca52?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=49ee68b793d9c0f1f0bc123ffad345e6&auto=format&fit=crop&w=2250&q=80" style="object-fit: cover;filter: brightness(40%);">
            <div class="textHome">
                <h1>ค้นหางานกิจกรรมในเรื่องที่คุณชอบ</h1>
                <?echo $btnHome; ?>
            </div>
        </figure>
        <figure>
            <img src="https://images.unsplash.com/photo-1504680177321-2e6a879aac86?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a8111c411923b7c9dbfc11d87f5d9c48&auto=format&fit=crop&w=1050&q=80" style="object-fit: cover;filter: brightness(40%);">
            <div class="textHome">
                <h1>ปาร์ตี้มันอยู่ในสายเลือด</h1>
                <h6>ซื้อบัตรคอนเสริทของวงที่คุณชื่นชอบ</h6>
            </div>
        </figure>
        <figure>
            <img src="https://images.unsplash.com/photo-1520110120835-c96534a4c984?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a7daa05f48dd9065422a82fda6a6fa71&auto=format&fit=crop&w=1047&q=80" style="object-fit: cover;filter: brightness(40%);">
            <div class="textHome">
                <h1>อยากเพิ่มความรู่ใส่ตัว ?</h1>
                <h6>งานสัมนา งานประชุม งานอบรมเราก็มีนะ</h6>
            </div>
        </figure>
        <figure>
            <img src="https://images.unsplash.com/photo-1456613820599-bfe244172af5?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ef20eb657eb4d15d1a5154a0246a015e&auto=format&fit=crop&w=1053&q=80" style="object-fit: cover;filter: brightness(40%);">
            <div class="textHome">
                <h1>อยากออกกำลังกาย ?</h1>
                <h6>ค้นหากิจกรรมทางกีฬา งานแข่ง</h6>
            </div>
        </figure>

    </figure>
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
