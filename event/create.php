
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
        <?
        if(empty($_GET)){
        echo "<div class='TypeShow row'>";
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
        echo "</div>";
        }
        else{
            $typeselect = $_GET['type'];
            $getTypeName = getOneValue("SELECT `TypeName` AS 'get' FROM `EventType` WHERE `TypeID` = '$typeselect'");
            ?>

<h3>สร้าง<?echo $getTypeName;?>ใหม่</h3>
<div class="eventCreate">
    <form name="frmlogin"  method="post" action="event/createevent.php" enctype="multipart/form-data">
    <p> </p>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>ชื่อกิจกรรม</label>
        <input type="text" class="form-control" name="eventName" required>
        <input type="hidden" class="form-control" name="eventType" value="<? echo$typeselect;?>">
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>รายละเอียดกิจกรรม</label>
        <textarea name="eventDesc"></textarea>
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>สถานที่จัดกิจกรรม</label>
        <input type="text" class="form-control" name="eventLocation" required>
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>รูแหน้าปกกิจกรรม</label>
        <input type="file" name="eventPic" accept="image/*">
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>วันที่จัดกิจกรรม (เดือน/วัน/ปีค.ศ.)</label>
        <input type="date" class="form-control" name="eventDate" required>
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>รูปแบบงาน : </label>
        <label class="radio-inline">
            <input type="radio" name="eventRole" value="M" checked>เปิดขายบัตร</label>
        <label class="radio-inline">
            <input type="radio" name="eventRole" value="F">ฟรี</label>
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>จำนวนผู้เข้าร่วม</label>
        <input type="number" class="form-control" min="0" name="eventCapi" required>
    </div>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>URL</label>
        <input type="text" class="form-control" name="eventURL" required>
        <small>ex. the-last-concert ใช้สำหรับเป็น URL ภาษาอังกฤษและขีดเท่านั้น</small>
    </div>
    <hr>
    <div class="form-group">
        <label>โทนสีเว็บ</label>
        <input type="text" class="form-control" name="eventColor">
    </div>
    <div class="form-group">
        <label>สถานที่จัดงาน ละติจูด (Lat)</label>
        <input type="text" class="form-control" name="eventMapLat">
    </div>
    <div class="form-group">
        <label>สถานที่จัดงาน ลองติจูด (Lng)</label>
        <input type="text" class="form-control" name="eventMapLng">
    </div>
    <div class="form-group">
        <label>ชื่อผู้จัดงาน</label>
        <input type="text" class="form-control" name="eventOrgName">
    </div>
    <div class="form-group">
        <label>เบอร์ติดต่อผู้จัด</label>
        <input type="text" class="form-control" name="eventCtTell">
    </div>
    <div class="form-group">
        <label>E-mail ติดต่อผู้จัด</label>
        <input type="email" class="form-control" name="eventCtEmail">
    </div>
    <div class="form-group">
        <label>Facebook กิจกรรม</label>
        <input type="text" class="form-control" name="eventFacebook">
    </div>
    <p>
    <button type="submit" class="btnlogin">สร้าง</button>
    <br>
    </p>
    </form>
</div>


            <?
        }
        ?>

        </div>
        <hr>
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
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>




