<?php
session_start();
include 'connection.php';
 if (isset($_SESSION["Username"])){
    if (isset($_SESSION['adminEdit']) == isset($_POST['adminEdit'])) {
        
        $firstname = mysql_real_escape_string(trim($_POST['adminEditfirstname']));
        $lastname = mysql_real_escape_string(trim($_POST['adminEditlastname']));
        $sex = mysql_real_escape_string(trim($_POST['adminEditsex']));
        $phone = mysql_real_escape_string(trim($_POST['adminEditphone']));
        //$email = mysql_real_escape_string(trim($_POST['Editemail']));
        $modified_date = $_POST['adminEditdob'];
        $date = date("Y-m-d ");
        unset($_SESSION['frmAction']);
        $meSQL = "UPDATE user ";
        $meSQL .= "SET Firstname='{$firstname}', ";
        $meSQL .= "Lastname='{$lastname}', ";
        $meSQL .= "sex='{$sex}', ";
        $meSQL .= "telephone='{$phone}', ";
        //$meSQL .= "email='{$email}', ";
        $meSQL .= "dob='{$modified_date}' ";
        $meSQL .= "WHERE ID ='{$_POST['adminEdit']}' ";
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
        