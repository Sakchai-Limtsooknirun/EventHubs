<?php
session_start();
include 'connection.php';
 if (isset($_SESSION["Username"])){
    if (isset($_SESSION['adminEdit']) == isset($_POST['adminEdit'])) {
        $statusPic = getOneValue("SELECT `Picture` AS 'get' FROM `user` WHERE ID ='{$_POST['adminEdit']}' ");
        if ($_FILES['AeditPic']['error'] == "0") {
             $file_name     = $_FILES['AeditPic']['name'];
        }else{
            if($statusPic == ""){
            $file_name     = "Default.png";
            }else {
                $file_name =  $statusPic; 
            }
         }
        
        $firstname = mysql_real_escape_string(trim($_POST['adminEditfirstname']));
        $lastname = mysql_real_escape_string(trim($_POST['adminEditlastname']));
        $sex = mysql_real_escape_string(trim($_POST['adminEditsex']));
        $phone = mysql_real_escape_string(trim($_POST['adminEditphone']));
        $lvuser=mysql_real_escape_string(trim($_POST['adminEdittype']));
        $email = mysql_real_escape_string(trim($_POST['adminEditemail']));
        $modified_date = $_POST['adminEditdob'];
        $date = date("Y-m-d H:i:s");
        unset($_SESSION['frmAction']);
        $meSQL = "UPDATE user ";
        $meSQL .= "SET Firstname='{$firstname}', ";
        $meSQL .= "Lastname='{$lastname}', ";
        $meSQL .= "role='{$lvuser}', ";
        $meSQL .= "sex='{$sex}', ";
        $meSQL .= "telephone='{$phone}', ";
        $meSQL .= "email='{$email}', ";
        $meSQL .= "dob='{$modified_date}', ";
        $meSQL .= "Picture='{$file_name}' ";
        $meSQL .= "WHERE ID ='{$_POST['adminEdit']}' ";
        
        if (isset($_FILES['AeditPic'])) {
            echo "have image";
            $errors    = array();
            $file_name = $_FILES['AeditPic']['name'];
            $file_size = $_FILES['AeditPic']['size'];
            $file_tmp  = $_FILES['AeditPic']['tmp_name'];
            $file_type = $_FILES['AeditPic']['type'];
            $file_ext  = strtolower(end(explode('.', $_FILES['AeditPic']['name'])));
        
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
                print_r($errors);
            }
        } else {
            echo "dfdf";
        }
        $userData = mysqli_query($con,$meSQL);
            if ($userData == TRUE) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'userManage.php'; ";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "window.location = 'userManage.php'; ";
                echo "</script>";
            }
            mysql_close();
            } 
        else {
            echo "<script type='text/javascript'>";
            echo "window.location = 'adminEdit.php'; ";
            echo "</script>";
            }
         } 
    else {
            echo "<script type='text/javascript'>";
            echo "window.location = 'login.php'; ";
            echo "</script>";
            }

mysqli_close($con);
?>
        