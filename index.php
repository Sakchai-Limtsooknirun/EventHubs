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
        <figure>
            <img src="https://images.unsplash.com/photo-1515603403036-f3d35f75ca52?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=49ee68b793d9c0f1f0bc123ffad345e6&auto=format&fit=crop&w=2250&q=80" style="object-fit: cover;filter: brightness(40%);">
            <div class="textHome">
                <h1>ค้นหางานกิจกรรมในเรื่องที่คุณชอบ</h1>
                <?echo $btnHome; ?>
            </div>
        </figure>
    </figure>
</div>
<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1">
</div>
   <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row searchBar">
    	<form action="search.php" method="get">
        	<div class="row">
        		<div class="col-lg-8">
        			<input class="form-control transparent-input" type="text" placeholder="ค้นหากิจกรรม" aria-label="ค้นหากิจกรรม" name="keyword" required>
        		</div>
        		<div class="col-lg-3">
					<div class="form-group">
					  	<select class="form-control transparent-input" id="type" name="type">
					    	<option value="all">ค้นหาจากทุกหมวดหมู่</option>
					   <?
						    $result_search = mysqli_query($con, "SELECT * FROM `EventType`");
						    while ($row = mysqli_fetch_assoc($result_search)) {
						        $TypeID = $row['TypeID'];
						        $TypeName = $row['TypeName'];
						        echo "<option value='$TypeID'>$TypeName</option>";
						    }

					   ?>
					  	</select>
					</div>
        		</div>
        		<div class="col-lg-1"><input type="submit" class="btn btn-info" value="ค้นหา"></div>
        	</div>
        </form>
    </div>
    <div class="row eventIndex">
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

    <div class='col-lg-6 box eventIndexShow'>
        <h4>$EventName</h4>
        <h6 id='eventIndexShowDate'><p style='font-size:15px' class='fas fa-calendar-alt'></p> $DateStart</h6>
        <a href='$ShortURL'><img src='img/event/$Eventpic' id='eventIndexPic' alt='' width='100%'></a>
        <h6><p style='font-size:12px' class='fas fa-location-arrow'></p> $Location</h6>
    </div>

            ";
        }

?>
</div>


    </div>
<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1">
</div>

</body>
</html>
