<?php
include 'header.php';
if((isset($_POST['oPW']) && isset($_POST['newPW']) && isset($_POST['tryPW'])&& isset($_SESSION['Username']))){
    if(isset($_SESSION['Username'])){
        $sql = "SELECT * FROM user Where Username='" . $_SESSION['Username'] . "'";
        $sqlVerify = mysqli_query($con, "SELECT Password FROM user Where Username='" . $_SESSION['Username'] . "'");
        if($_POST['newPW']==$_POST['tryPW']){
            if ($sqlVerify->num_rows == 1) {
                while ($row1 = $sqlVerify->fetch_assoc()) {
                    $verify = password_verify($_POST['oPW'], $row1['Password']);
                }
                if($verify==1){
                    $password_ec = password_hash($_POST['newPW'], PASSWORD_BCRYPT);
                    $meSQL = "UPDATE user ";
                    $meSQL .= "SET Password='{$password_ec}' ";
                    $meSQL .= "WHERE Username ='{$_SESSION['Username']}' ";
                    $userData = mysqli_query($con,$meSQL);
                    if ($userData==true){
                        echo "<h4 align = 'center' >Change Password success<h4>";
                     }   
                 }else{
                    echo "<h4 align = 'center' >Password ผิด<h4>";
                 }
                    
        }   
    }else{
        echo "<h4 align = 'center' >Try-Password ผิด<h4>";
     }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <form name="repw"  method="POST" action="resetPW.php">

    <div class="form-group">
        <abbr style="color:red;">* </abbr><label>Old Password</label>
        <input class="form-control" type="password" name="oPW" minlength="4" style="color:#260d31" >
    </div>
    <a>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------</a>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>New Password</label>
            <input type="password" class="form-control" name="newPW" minlength="4" required style="color:#260d31;">
        </div>
        <div class="form-group">
            <abbr style="color:red;">* </abbr><label>Try-Password</label>
            <input type="password" class="form-control" name="tryPW" minlength="4" required>
        </div>
        <button type="submit" class="btnlogin">สมัครสมาชิก</button>
    </form>

</head>
<body>
    
</body>
</html>