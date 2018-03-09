<?php
include 'header.php';

if(isset($_GET['userid'])&&isset($_GET['token'])){
    echo $idf=$_GET['userid'];
    echo $token=$_GET['token'];
    if(isset($_POST['newPW']) && isset($_POST['tryPW'])){
        $sql = "SELECT * from user where ID = '{$_GET['userid']}'";
        $ck = mysqli_query($con,$sql);
        if ($ck->num_rows == 1) {
            $row = mysqli_fetch_array($ck);
            if($row['token']==$_GET['token']){
                if($_POST['newPW']==$_POST['tryPW']){
                    echo "=แล้วพร้อมเข้ารหัส";
                    $password_ec = password_hash($_POST['newPW'], PASSWORD_BCRYPT);
                    $meSQL = "UPDATE user ";
                    $meSQL .= "SET Password='{$password_ec}' ";
                    $meSQL .= "WHERE ID ='{$_GET['userid']}' ";
                    $userData = mysqli_query($con,$meSQL);
                    if ($userData==true){
                        echo "<h4 align = 'center' >Change Password success<h4>";
                     }   
                }else{
                    echo "<h4 align = 'center' >Try-Password ผิด<h4>";
                }
        }else{echo "<h4 align = 'center' >Tokenไม่ตรงกัน<h4>";}
    }else{echo "<h4 align = 'center' >ID NOT FOUND<h4>";}
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <form name="repw"  method="POST">
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>New Password</label>
            <input type="password" class="form-control" name="newPW" minlength="4" required style="color:#260d31;">
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>Try-Password</label>
            <input type="password" class="form-control" name="tryPW" minlength="4" required>
        </div>
        <center>
        <button  onclick="'resetPW.php?userid=".$idf."&token=".$token."'" style="color:#260d31" type="submit" class="btnlogin">Change password</button>
        <center>
    </form>

</head>
<body>
    
</body>
</html>