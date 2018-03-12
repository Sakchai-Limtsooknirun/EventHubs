<?php


include 'header.php';

if (isset($_SESSION["Username"])) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    exit;
} else {

}
if(isset($_GET['error'])){
    if ($_GET['error'] == "1") {
        $error = "<p class='errorlogin'>ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่</p>";
    } else if ($_GET['error'] == "2") {
        $error = "<p class='errorlogin'>รหัสผ่านกับยืนยันรหัสผ่านไม่ถูกต้อง</p>";
    } else if ($_GET['error'] == "3") {
        $error = "<p class='errorlogin'>พบข้อผิดพลาดในการสมัครสมาชิก</p>";
    }
}else {
    $error = null;
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Signup</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="row">
    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 loginbg">
      <form name="frmsignup"  method="POST" action="registersave.php" enctype="multipart/form-data">
        <p> </p>
        <h2>สมัครสมาชิก</h2>
        <?echo $error; ?>
        
</script>
    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>รูปโปรไฟล์</label>
        <input type="file" name="userPic" accept="image/*" >
    </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>อีเมล์</label>
            <input type="email" class="form-control" name="email" required style="color:#260d31;">
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>ชื่อผู้ใช้</label>
            <input type="text" class="form-control" name="username" minlength="4" required>
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>รหัสผ่าน</label>
            <input type="password" class="form-control" name="password" minlength="4" required>
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>ยืนยันรหัสผ่าน</label>
            <input type="password" class="form-control" name="cfpassword"  minlength="4" required>
        </div>
        <hr>
        <small>กรุณาใช้ชื่อและนามสกุลจริงตามบัตรประชาชน</small>
        <p></p>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>ชื่อ</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>นามสกุล</label>
            <input type="text" class="form-control" name="lastname" required>
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>เบอร์โทรศัพท์</label>
            <input type="text" class="input-medium bfh-phone" name="tel" minlength="9" data-format="+66 dd ddd-dddd" required>
            <small>เราจะทำการติดต่อคุณผ่านเบอร์นี้ </small>
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>วันเกิด (เดือน/วัน/ปีค.ศ.)</label>
            <input type="date" class="form-control" name="dob" required>
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>เพศ : </label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="m" checked>ชาย</label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="f">หญิง</label>
        </div>
        <hr>
        
        <div align = "center"class="form-group">
            <abbr style="color:red;">* </abbr><label></label>
            <label class="checkbox-inline">
                <input  type="checkbox" required >ยอมรับ <a href="Policyinfo.php">ข้อตกลงการใช้บริการ </a>
            </label>

        </div>
        
        <p>
            
        <button type="submit" class="btnlogin">สมัครสมาชิก</button><hr>
        <br>
        </p>
      </form>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">
    </div>
  </div>
</body>
</html>
