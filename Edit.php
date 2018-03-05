<?php
include 'header.php';

if ($_SESSION["Username"] == $username){
    $_SESSION['frmAction'] = md5('brabra' . rand(1, 9999));
    //echo "OK";
    $meSQL = "SELECT * FROM user WHERE Username='{$_SESSION["Username"]}' ";
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
    <form name="EditForm" action="EditUpdate.php" method="POST">
<h4>จัดการข้อมูลส่วนตัว</h4>

<div class="form-group">
    <tr>
        <td class="form-control"><label>ID</label></td>
        <td><input style="color:#260d31" type="text" name="EditID" value="<?php echo $meResult['ID']; ?>" size="40" readonly="readonly" disabled="disabled" required/></td>
    </tr>
</div>

<div class="form-group">
    <tr>
        <td class="form-control"><label>ระดับสมาชิก</label></td>
        <td><input style="color:#260d31" type="text" name="Editusername" value="<?php 
        if($meResult['role']=='A'){
            echo 'Admin' ;
        }
        elseif($meResult['role']=='M'){
            echo 'Member';
        }else{
            echo $meResult['role'];
        }
        ?>" size="40" readonly="readonly" disabled="disabled" required/></td>
    </tr>
</div> 

<div class="form-group">
    <tr>
        <td class="form-control"><label>Username</label></td>
        <td><input style="color:#260d31" type="text" name="Editusername" value="<?php echo $meResult['Username']; ?>" size="40" readonly="readonly" disabled="disabled" required/></td>
    </tr>
</div>

<div class="form-group">
    <abbr style="color:red;">* </abbr>
    <tr>
        <td class="form-control"><label>Firstname</label></td>
        <td><input style="color:#260d31" type="text" name="Editfirstname" value="<?php echo $meResult['Firstname']; ?>" size="40" required/></td>
    </tr>
</div>

<div class="form-group">
    <abbr style="color:red;">* </abbr>
    <tr>
        <td class="form-control"><label>Lastname</label></td>
        <td><input style="color:#260d31" type="text" name="Editlastname" value="<?php echo $meResult['Lastname']; ?>" size="40" required/></td>
    </tr>
</div>

<div class="form-group"><abbr style="color:red;">* </abbr>
    <tr>
        <td class="form-control"><label>Sex</label></td>
    <td>
        <input style="color:#260d31" type="radio" name="Editsex" value="m" required
        <?php
        if ($meResult['sex'] == 'm') {
        echo 'checked';
        }
        ?>
        /> ชาย  | 
        <input style="color:#260d31" type="radio" name="Editsex" value="f" required
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
        <td><input style="color:#260d31" minlength="9" data-format="+66 dd ddd-dddd" class="input-medium bfh-phone" type="text" name="Editphone" value="<?php echo $meResult['telephone']; ?>" size="40" required/></td>
</tr>
</div>

<div class="form-group">
    <tr>
        <td class="form-control"><label>E-mail</label></td>
        <td><input style="color:#260d31" type="text" name="Editemail" value="<?php echo $meResult['email']; ?>" size="40" readonly="readonly" disabled="disabled" required/></td>
    </tr>
</div>

<div class="form-group"><abbr style="color:red;">* </abbr>
            <label>วันเกิด (วัน/เดือน/ปี ค.ศ.)</label></td><td></td>
            <input type="date" class="form-control" name="Editdob" value = <?php echo $meResult['dob']; ?> required>
        </div>

<div class="form-group">
    <tr>
        <td style="text-align: right;width: 200px; font-weight: bold">วันที่สร้าง </td><td><?php echo $meResult['ts']; ?></td>
    </tr>
</div>


<tr>
    <td>&nbsp;</td>
    <td><input class="btnlogin" type="submit" name="submit" value="บันทึกข้อมูล" /></td>
</tr>

<input type="hidden" name="frmAction" value="<?php echo $_SESSION['frmAction']; ?>" />
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

