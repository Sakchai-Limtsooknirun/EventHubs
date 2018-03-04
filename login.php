<?php
session_start();
include 'connection.php';
if (isset($_REQUEST['Username'])) {
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
            if ($_POST['go'] != ""){
                $url = "eventview/".$_POST['go'];
            }else{
                $url = "index.php";
            }
            echo "<script type='text/javascript'>";
            echo "window.location = '$url'; ";
            echo "</script>";
            exit;

        } else {
            echo "<script type='text/javascript'>";
            echo "window.location = 'form_login.php?st=1'; ";
            echo "</script>";
            exit;

        }
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'form_login.php?st=1'; ";
        echo "</script>";
        exit;
    }
}
