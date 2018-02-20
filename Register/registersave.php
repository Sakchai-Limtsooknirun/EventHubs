<?php
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
	//สร้างตัวแปรเก็บค่าที่รับมาจากฟอร์ม
	$member_name = $_REQUEST["member_name"];
	$member_lname = $_REQUEST["member_lname"];
    $username = $_REQUEST["username"];
    
    $password = password_hash($_REQUEST["password"],PASSWORD_BCRYPT);
    
	
	//เพิ่มเข้าไปในฐานข้อมูล
	 $sql = "INSERT INTO user(Username, Password,Firstname,Lastname,role)
	 		 VALUES('$username', '$password','$member_name', '$member_lname','M')";
 
	 
	if(isset($username)){
        $mysql_get_users = mysqli_query($con,"select* from user where Username = '$username'");
        $get_rows = mysqli_affected_rows($con);
        
        if($get_rows >=1){
            echo "user exists";
            $result = false ;
            die();
            }
            
            else{
            echo "user do not exists";
            $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
            }
            
    }

	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('Register Succesfuly');";
	echo "window.location = '../Login/form_login.php'; ";
    echo "</script>";
    
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error back to register again');";
	echo "</script>";
    }
?>