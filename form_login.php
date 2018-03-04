<?php
include 'header.php';
$error = "";
if (isset($_SESSION["Username"])) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    exit;
} else {

}
if (isset($_GET['st'])) {
    if ($_GET['st'] == "1") {
        $error = "<p class='errorlogin'>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</p>";
    } else if ($_GET['st'] == "2") {
        $error = "<h4>สมัครสมาชิกเรียบร้อย</h4>";
    } else if ($_GET['st'] == "3") {
        $error = "<h4>กรุณาเข้าสู่ระบบก่อน</h4>";
    } else {
        $error = "";
    }
}
$go = $_GET['go'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="row">
    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 loginbg">
      <form name="frmlogin"  method="post" action="login.php">
        <p> </p>
        <h2>เข้าสู่ระบบ</h2>
        <?echo $error; ?>
        <input type="hidden"   id="go" required name="go" value="<?echo $go;?>">
          <input type="text"   id="Username" required name="Username" placeholder="ชื่อผู้ใช้">
        </p>
          <input type="password"   id="Password"required name="Password" placeholder="รหัสผ่าน">
        </p>
        <p>
          <a href="#" id="resetpassword">ลืมรหัสผ่าน</a>
          <p>
          <button type="submit" class="btnlogin">เข้าสู่ระบบ</button>
          <hr>
          <br>
        </p>
      </form>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">
    </div>
  </div>
</body>
</html>
