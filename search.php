<?php
include 'header.php';
$keyword = $_GET['keyword'];
$type = $_GET['type'];
$sqlSearch = "SELECT * FROM `EventType`";
if (isset($keyword) && $type == "all"){
    $sqlSearch = "SELECT * FROM `EventOrganizers` WHERE `EventName` LIKE '%$keyword%'";

}else{
    $sqlSearch = "SELECT * FROM `EventOrganizers` WHERE `EventName` LIKE '%$keyword%' AND `Type` = '$type'";
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
<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1">
</div>
   <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row searchBar">
    	<form action="search.php" method="get">
        	<div class="row">
        		<div class="col-lg-8">
        			<input class="form-control transparent-input" type="text" placeholder="ค้นหากิจกรรม" aria-label="ค้นหากิจกรรม" name="keyword" required value="<? echo$keyword;?>">
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

        $result = mysqli_query($con, $sqlSearch);
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
        if ($status != "1"){
            echo "<br><h4 style='color:white;text-align:center;'>ไม่พบกิจกรรม</h4>";
        }

?>
</div>


    </div>
<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1">
</div>

</body>
</html>
