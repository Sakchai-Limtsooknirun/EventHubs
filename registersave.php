<?php
include 'connection.php';
$username     = $_POST["username"];
$password     = $_POST["password"];
$cfpassword     = $_POST["cfpassword"];
$name     = $_POST["name"];
$lastname     = $_POST["lastname"];
$email     = $_POST["email"];
$dob     = $_POST["dob"];
$tel     = $_POST["tel"];
$sex     = $_POST["sex"];

print_r($_POST);
$password_ec = password_hash($_POST["password"], PASSWORD_BCRYPT);
$date = date("Y-m-d H:i:s");

//เพิ่มเข้าไปในฐานข้อมูล
$sql = "INSERT INTO `user` VALUES ('','$username','$password_ec','$name','$lastname','M','$date','$email','$dob','$tel','$sex')";
echo $sql;

$mysql_get_users = mysqli_query($con, "select* from user where Username = '$username'");
$get_rows        = mysqli_affected_rows($con);

echo $get_rows;

if ($get_rows >= 1) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'signup.php?error=1'; ";
    echo "</script>";
} else {
    if ($cfpassword != $password){
        echo "<script type='text/javascript'>";
        echo "window.location = 'signup.php?error=2'; ";
        echo "</script>";
    }else{
        $result = mysqli_query($con, $sql);
        if($result){
        echo "<script type='text/javascript'>";
        echo "window.location = 'form_login.php?st=2'; ";
        echo "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'signup.php?error=3'; ";
            echo "</script>";        }
    }
}
