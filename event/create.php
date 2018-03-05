
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
}else if ($type == "Organizer" || $type == "Admin" ){ //--------------------- Organizer ------------------------
?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
<h2>สร้างกิจกรรมใหม่</h2>
<div class="TypeShow row">
<?
       $result = mysqli_query($con, "SELECT * FROM `EventType` WHERE 1");
        while ($row = mysqli_fetch_assoc($result)) {
            $typeid = $row['TypeID'];
            $typepic = $row['TypePic'];
            $typename = $row['TypeName'];
            echo "
    <div class='TypeEach'>
      <a href='event/create.php?type=$typeid'><div class='col-md-3'>
        <div class='thumbnail'>
          <img src='img/type/$typepic' style='min-height:300px;height:300px;object-fit: cover;'>
          <div class='caption'>
            <h3><center>$typename</center></h3>
          </div>
        </div>
      </div></a>
    </div>

            ";
        }
?>
</div>
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
            <p>คุณไม่มีสิทธิเข้าหน้านี้</p>
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




