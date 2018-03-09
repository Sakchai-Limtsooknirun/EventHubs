<?php
//require_once('class/class.upload.php') ;
include 'connection.php';
$username   = $_POST["username"];
$password   = $_POST["password"];
$cfpassword = $_POST["cfpassword"];
$name       = $_POST["name"];
$lastname   = $_POST["lastname"];
$email      = $_POST["email"];
$dob        = $_POST["dob"];
$tel        = $_POST["tel"];
$sex        = $_POST["sex"];
if ($_FILES['userPic']['error'] == "0") {
    $file_name = $_FILES['userPic']['name'];
} else {
    $file_name = "Default.png";
}

// print_r($_POST);
// print_r($_FILES);
// echo $file_name ;
$password_ec = password_hash($_POST["password"], PASSWORD_BCRYPT);
$date        = date("Y-m-d H:i:s");
$token       = bin2hex(openssl_random_pseudo_bytes(16));
// if(!file_exists($_FILES['userPic']['name']) || !is_uploaded_file(['userPic']['name'])) {
//     $sql = "INSERT INTO `user` VALUES ('','$username','$password_ec','$name','$lastname','M','$date','$email','$dob','$tel','$sex','Default.png')";
// }else{
$sql = "INSERT INTO `user` VALUES ('','$username','$password_ec','$name','$lastname','M','$date','$email','$dob','$tel','$sex','$file_name','$token')";
//}

// echo $sql;

$mysql_get_users = mysqli_query($con, "select* from user where Username = '$username'");
$get_rows        = mysqli_affected_rows($con);

// echo $get_rows;
if (isset($_FILES['userPic'])) {
    echo "have image";
    $errors    = array();
    $file_name = $_FILES['userPic']['name'];
    $file_size = $_FILES['userPic']['size'];
    $file_tmp  = $_FILES['userPic']['tmp_name'];
    $file_type = $_FILES['userPic']['type'];
    $file_ext  = strtolower(end(explode('.', $_FILES['userPic']['name'])));

    $expensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "img/user/" . $file_name);
        echo "Success";
    } else {
        // print_r($errors);
    }
} else {
    // echo "dfdf";
}

if ($get_rows >= 1) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'signup.php?error=1'; ";
    echo "</script>";
} else {
    if ($cfpassword != $password) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'signup.php?error=2'; ";
        echo "</script>";
    } else {
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script type='text/javascript'>";
            echo "window.location = 'form_login.php?st=2'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "window.location = 'signup.php?error=3'; ";
            echo "</script>";}
    }
}
mysqli_close($con);
