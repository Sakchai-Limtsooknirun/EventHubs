<script src="jquery-3.3.1.min.js" charset="utf-8"></script>
<?php
session_start();
include 'connection.php';

 if (isset($_SESSION["Username"])){
    if (isset($_SESSION['frmAction']) == isset($_POST['frmAction'])) {
        $statusPic = getOneValue("SELECT `Picture` AS 'get' FROM `user` WHERE `Username` = '{$_SESSION['Username']}'");
        
        if ($_FILES['editPic']['error'] == "0") {
             $file_name     = $_FILES['editPic']['name'];
        }else{
            if($statusPic == ""){
            $file_name     = "Default.png";
            }else {
                $file_name =  $statusPic; 
            }
         }

        $firstname = mysql_real_escape_string(trim($_POST['Editfirstname']));
        $lastname = mysql_real_escape_string(trim($_POST['Editlastname']));
        $sex = mysql_real_escape_string(trim($_POST['Editsex']));
        $phone = mysql_real_escape_string(trim($_POST['Editphone']));
        //$email = mysql_real_escape_string(trim($_POST['Editemail']));
        $modified_date = $_POST['Editdob'];
        $date = date("Y-m-d H:i:s");
        unset($_SESSION['frmAction']);
        $meSQL = "UPDATE user ";
        $meSQL .= "SET Firstname='{$firstname}', ";
        $meSQL .= "Lastname='{$lastname}', ";
        $meSQL .= "sex='{$sex}', ";
        $meSQL .= "telephone='{$phone}', ";
        //$meSQL .= "email='{$email}', ";
        $meSQL .= "dob='{$modified_date}',";

        // if((!is_uploaded_file(['editPic']['name']))) {
        //     $meSQL .= "Picture='{$statusPic}' ";
        // }else{
            $meSQL .= "Picture='{$file_name}' ";
        //}
        
        $meSQL .= "WHERE Username ='{$_SESSION['Username']}' ";
        
       
        if (isset($_FILES['editPic'])) {
            echo "have image";
            $errors    = array();
            $file_name = $_FILES['editPic']['name'];
            $file_size = $_FILES['editPic']['size'];
            $file_tmp  = $_FILES['editPic']['tmp_name'];
            $file_type = $_FILES['editPic']['type'];
            $file_ext  = strtolower(end(explode('.', $_FILES['editPic']['name'])));
        
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
               echo "window.location = 'Edit.php'; ";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "window.location = 'Edit.php'; ";
                echo "</script>";
            }
            mysql_close();
            } 
        else {
            echo "<script type='text/javascript'>";
            echo "window.location = 'Edit.php'; ";
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
        

 