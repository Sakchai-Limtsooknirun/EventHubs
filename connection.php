<?php
//$con= mysqli_connect("localhost","admin","jay23513","mydatabase") or die("Error: " . mysqli_error($con));
$mysql_server = "csku.science";
$mysql_user = "spppaper_pjmt";
$mysql_password = "0fFBvKgv";
$mysql_db = "spppaper_pjmt";
$con = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
if ($con->connect_errno) {
	printf("Connection failed: %s \n", $con->connect_error);
	exit();
}
$con->set_charset("utf8");
date_default_timezone_set("Asia/Bangkok");

function t()
{
    echo "pass";
}

function getOneValue($string)
{
    global $con;
    $data = $con->query($string)->fetch_assoc();
    $get  = $data['get'];
    // mysql_close();
    return $get;
}

function checkType($user)
{
    $type = getOneValue("SELECT `role` AS 'get' FROM `user` WHERE `Username` = '$user'");
    if ($type == "A") {
        return "Admin";
    } else if ($type == "M") {
        return "User";
    } else if ($type == "O") {
        return "Organizer";
    } else {
        return "NotLogin";
    }
}
function ownerID($user)
{
    $id = getOneValue("SELECT `ID` AS 'get' FROM `user` WHERE `Username` = '$user'");
    return $id;
}

function DateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute";
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


function CheckStatus($Status){
  if($Status == 0){
    return "รอการชำระเงิน";
  }
  else if($Status == 1){
    return "ชำระเงินเรียบร้อย";
  }
  else if($Status == 2){
    return "ยืนยันเรียบร้อย";
  }
  else if($Status == 3){
    return "ยกเลิก";
  }
else{
    return "เข้าร่วมงานเรียบร้อย";
  }
}

function store_log($userN,$acti){
    global $con ;
    $ip = get_client_ip();
    $act    = "username : ".$userN." $acti";
    $user   = $userN;
    $date   = date("Y-m-d H:i:s");
    $s = "INSERT INTO Log VALUES ('','$date','$ip','$user','$act')";
    $resultx = mysqli_query($con, $s);

    if($resultx==true){
        return true ;

    }else{
        return false;
    }
    }
