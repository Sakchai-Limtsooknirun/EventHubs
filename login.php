<?php
session_start();
if (isset($_REQUEST['Username'])) {
    //connection
    include "connection.php";
    //รับค่า user & password
    $Username = $_REQUEST['Username'];
    $Password = $_REQUEST['Password'];
    //query

    $sql = "SELECT * FROM user Where Username='" . $Username . "'";
    //น่าจะ error password เพราะเปนค่า hash อยู่ = หาค่าไม่เจอ ลบ and Password='".$Password."' ----หาวิธีแก้ก่อน
    $sqlVerify = mysqli_query($con, "SELECT Password FROM user Where Username='" . $Username . "'");
    if ($sqlVerify->num_rows == 1) {
        // output data of each row
        while ($row1 = $sqlVerify->fetch_assoc()) {
            $verify = password_verify($Password, $row1['Password']);
        }
        $result = mysqli_query($con, $sql);

        if ($verify == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['UserID'] = $row['ID'];
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['user']   = $row['Firstname'] . " " . $row['Lastname'];
            $_SESSION['role']   = $row['role'];

            echo "<script type='text/javascript'>";
            echo "alert('Login to Member Succesfuly');";
            echo "window.location = 'index.php'; ";
            echo "</script>";
            // header( "location: http://www.ireallyhost.com" );
            exit;

        } else {
            echo "<script>";
            echo "alert(\" user หรือ  password ไม่ถูกต้อง\");";
            echo "window.history.back()";
            echo "</script>";

        }
    } else {
        Header("Location: form_login.php"); //user & password incorrect back to login again
    }
}
