
<?
$path    = basename(realpath(__DIR__ . '/..'));
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
}else if ($type == "Organizer"){ //--------------------- Organizer ------------------------
?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
        <?
        $result = mysqli_query($con, "SELECT * FROM `EventOrganizers` WHERE `EventOwnerID` = '$usernameID'");
        while ($row = mysqli_fetch_assoc($result)) {
            $status = 1;
            $EventName = $row['EventName'];
            $EventStatus = $row['EventStatus'];
            $Location = $row['Location'];
            $DateStart = DateThai($row['DateStart']);
            $CapacityNow = $row['CapacityNow'];
            $MaximumCapacity = $row['MaximumCapacity'];
            $Picture = $row['Picture'];
            $ShortURL = $row['ShortURL'];
            $ShortURL = $actual_link = "http://$_SERVER[HTTP_HOST]/".$path."/eventview/".$ShortURL;
            echo "
<div class='eventCard'>
    <div class='eventTopic'>
        <p>$EventName</p>
        <p id='eventStatus'>สถาณะ : $EventStatus</p>
    </div>
    <div class='col-lg-4'>
        <img src='img/event/$Picture' alt='' width='100%'>
    </div>
    <div class='col-lg-8'>
        <p id='eventInfo'><span class='glyphicon glyphicon-pushpin'></span> $Location</p>
        <p id='eventInfo'><span class='glyphicon glyphicon-calendar'></span> $DateStart</p>
        <p id='eventInfo'><span class='glyphicon glyphicon-link'></span> <a href='$ShortURL' target='_blank'>$ShortURL</a></p>
        <p id='eventInfo'><span class='glyphicon glyphicon-user'></span> $CapacityNow / $MaximumCapacity คน</p>
        <br>
        <a class='btnlogin'href='#event-showtimes'>จัดการ</a>
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


<? //------------------------------------------
}
else {

?>
<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
            <p>Error</p>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
</body>
		<?
}

?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
</head>




