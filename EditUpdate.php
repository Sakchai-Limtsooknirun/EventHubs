<?php
session_start();
include 'connection.php';
 if (isset($_SESSION["Username"])){
    if (isset($_SESSION['frmAction']) == isset($_POST['frmAction'])) {
        
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
        $meSQL .= "dob='{$modified_date}' ";
        $meSQL .= "WHERE Username ='{$_SESSION['Username']}' ";
        $userData = mysqli_query($con,$meSQL);
            if ($userData == TRUE) {
                echo "<script type='text/javascript'>";
                echo "window.location = 'index.php'; ";
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
            
?>
        

 