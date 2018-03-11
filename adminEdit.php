<?php
include 'header.php';

if ($_SESSION["Username"] == $username){
    $_SESSION['adminEdit'] = md5('brabra' . rand(1, 9999));
    $id = $_GET["IDedit"];
    $_POST['idb']=$id ;
    $meSQL = "SELECT * FROM user WHERE ID='{$id}' ";
    $userData = mysqli_query($con,$meSQL);
    if ($userData == TRUE) {
        $meResult = $userData->fetch_assoc();
        print_r($meResult);

?>
<html>
<head>
<meta charset="UTF-8">
<title>แก้ไขข้อมูล <?php echo $meResult['Username']; ?></title>
</head>
<body>


<div class="row">
    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-8 col-lg-8 loginbg">
    <form name="adminEditForm" action="adminEditUpdate.php" method="POST" enctype="multipart/form-data">
<h4>จัดการข้อมูลส่วนตัว</h4>

<img  class="img-thumbnail" src="img/user/<?echo $meResult['Picture']; ?>" alt="" width='100%' required >
<br>
<br>
<div class="form-group">
        <label>แก้ไขรูปโปรไฟล์</label>
        <input type="file" name="AeditPic" accept="image/*">
    </div>
<div class="form-group">
    <tr>
        <td class="form-control"><label>ID</label></td>
        <td><input style="color:#260d31" type="text" name="adminEditID" value="<?php echo $meResult['ID']; ?>" size="40" readonly="readonly" disabled="disabled" required/></td>
    </tr>
</div>

<div class="form-group">
<tr>
        <td class="form-control"><label>ระดับสมาชิก</label></td>
    <td>
        <input style="color:#260d31" type="radio" name="adminEdittype" value="A" required
        <?php
        if ($meResult['role'] == 'A') {
        echo 'checked';}?>
        /> Admin  | 
        <input style="color:#260d31" type="radio" name="adminEdittype" value="M" required
        <?php
        if ($meResult['role'] == 'M') {
             echo 'checked';}?>/> Member |
        <input style="color:#260d31" type="radio" name="adminEdittype" value="O" required
        <?php
        if ($meResult['role'] == 'O') {
             echo 'checked';}?>/> Organizer
    </tr>
</div> 

<div class="form-group">
    <tr>
        <td class="form-control"><label>Username</label></td>
        <td><input style="color:#260d31" type="text" name="adminEditusername" value="<?php echo $meResult['Username']; ?>" readonly="readonly" disabled="disabled" size="40" required/></td>
    </tr>
</div>

<div class="form-group">
    <abbr style="color:red;">* </abbr>
    <tr>
        <td class="form-control"><label>Firstname</label></td>
        <td><input style="color:#260d31" type="text" name="adminEditfirstname" value="<?php echo $meResult['Firstname']; ?>" size="40" /></td>
    </tr>
</div>

<div class="form-group">
    <abbr style="color:red;">* </abbr>
    <tr>
        <td class="form-control"><label>Lastname</label></td>
        <td><input style="color:#260d31" type="text" name="adminEditlastname" value="<?php echo $meResult['Lastname']; ?>" size="40" /></td>
    </tr>
</div>

<div class="form-group"><abbr style="color:red;">* </abbr>
    <tr>
        <td class="form-control"><label>Sex</label></td>
    <td>
        <input style="color:#260d31" type="radio" name="adminEditsex" value="m" required
        <?php
        if ($meResult['sex'] == 'm') {
        echo 'checked';
        }
        ?>
        /> ชาย  | 
        <input style="color:#260d31" type="radio" name="adminEditsex" value="f" required
        <?php
        if ($meResult['sex'] == 'f') {
            echo 'checked';
    }
    
?>
/> หญิง
</td>
</tr>
</div>

<div class="form-group">
    <tr><abbr style="color:red;">* </abbr>
        <td class="form-control"><label>Telephone</label></td>
        <td><input style="color:#260d31" minlength="9" data-format="+66 dd ddd-dddd" class="input-medium bfh-phone" type="text" name="adminEditphone" value="<?php echo $meResult['telephone']; ?>" size="40"/></td>
</tr>
</div>

<div class="form-group">
    <tr>
        <td class="form-control"><label>E-mail</label></td>
        <td><input style="color:#260d31" type="email" name="adminEditemail" value="<?php echo $meResult['email']; ?>" size="40"/></td>
    </tr>
</div>

<div class="form-group"><abbr style="color:red;">* </abbr>
            <label>วันเกิด (วัน/เดือน/ปี ค.ศ.)</label></td><td></td>
            <input type="date" class="form-control" name="adminEditdob" value = <?php echo $meResult['dob']; ?> >
        </div>

<div class="form-group">
    <tr>
        <td style="text-align: right;width: 200px; font-weight: bold">วันที่สร้าง </td><td><?php echo DateThai($meResult['ts']); ?></td>
    </tr>
</div>


<tr>
    <td>&nbsp;</td>
    <td><input class="btnlogin" type="submit" name="submit" value="บันทึกข้อมูล" /></td>
</tr>

<input type="hidden" name="adminEdit" value="<?php echo $_GET["IDedit"] ;  ?>" />
</form>
<div class="col-xs-1 col-sm-1 col-md-2 col-lg-2"></div>          
  </div>
    </body>
    </html>
    
    <?php
    }
    
}else{
    echo "<script type='text/javascript'>";
    echo "window.location = 'signup.php'; ";
    echo "</script>";
}