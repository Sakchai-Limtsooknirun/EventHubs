<?php
include('phpqrcode/qrlib.php');
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



function sendEmail($email,$name,$eventName,$type,$url,$token){



    $strMessage = "";
		$strMessage .= "สวัสดีครับ คุณ ".$name."<br>";

  require_once('../PHPMailer_v5.0.2/class.phpmailer.php');

  $mail = new PHPMailer();
  $mail-> CharSet = 'UTF-8';
  $mail->IsHTML(true);
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;
  $mail->Username = "eventhubth@gmail.com";
  $mail->Password = "csku1234";
  $mail->From = "eventhubth@gmail.com";

  $mail->FromName = "EventHubs";
  if($type == 'c'){
  $mail->Subject = "EventHubs - ยืนยันการเข้าร่วมกิจกรรมของคุณ :".$name;
  $strMessage .= " ได้มีการยืนยันจากทางเจ้าของกิจกรรม ".$eventName." ให้คุณมีสิทธในการเข้าร่วมกิจกรรม<br>แล้วพบกันในงานภายในวันเวลาที่กำหนด<br>";
	$actual_link = "http://localhost:8888/projectMidterm/enter.php?id=".$token;
	$strMessage .= "<a href='".$actual_link."'>ตั๋วเข้างาน</a><br>'";


  }else if($type == 'ca'){
    $mail->Subject = "EventHubs - ขออภัยในความไม่สดวก คุณ:".$name;
    $strMessage .= " ได้มีการขอเข้าร่วมกิจกรรม ".$eventName." แต่ทางเจ้าของกิจกรรม เกิดเหุตบกพร่องบางประการ จึงสามารถไห้บริการคุณได้ <br>ขออภัยมา ณ ที่นี้<br>";
  }else if($type == 'surveyOn'){
    $mail->Subject = "EventHubs - ขอบคุณที่เข้าร่วมกิจกรรม ".$eventName." รบกวนทำแบบสอบถาม";
    $strMessage .= " ขอขอบคุณที่เข้าร่วมกิจกรรม ".$eventName." ทางเราขอรบกวนให้ทำแบบสอบถามเพื่อนำไปปรับปรุงในครั้งต่อไป <br>";
  }



  else{
    $mail->Subject = "EventHubs - กิจกรรม".$eventName."มีการแก้ไข";
    $strMessage .= "กิจกรรม".$eventName." มีการแก้ไขรายละเอียดภายในงาน กรุณาตรวจสอบกิจกรรมอีกครั้ง";




  }
  if ($type == 'surveyOn'){
    $strMessage .= "<a href='".$url."'>คลิกที่นี่เพื่อเข้าร่วมทำแบบประเมิน</a><p>";
  }
  else{
    $strMessage .= "<a href='http://localhost/projectMidterm/eventview/".$url."'>กิจกรรมที่คุณสมัคร</a>'";
  }

	$strMessage .= "<br>=================================<br>";
	$strMessage .= "EventHubs.com<br><br>";
	$strMessage .= 'Admin Anaphat';
  $mail->Body = $strMessage;
  $mail->AddAddress($email, $name); // to Address
  // $mail->AddAttachment("thaicreate/myfile.zip");
  // $mail->AddAttachment("thaicreate/myfile2.zip");
  //$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
  //$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
  $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
  $mail->Send();
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

	function gen_QRpic($strmasg,$strFNAME){
	 $tempDir = "img/qrcode/";
	 $codeContents = $strmasg;   //inputtext
	 //$fileName = uniqid('QR', true) . '.png';  //filenameUniqid
	 $fileName = $strFNAME.'.png' ;  //filename
	 $pngAbsoluteFilePath = $tempDir.$fileName;
	 //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
	 if (!file_exists($pngAbsoluteFilePath)) {
	        QRcode::png($codeContents, $pngAbsoluteFilePath);
	        //echo '<img src="'.$tempDir.$fileName.'" />';
	        return 'File generated!';

	    } else {
	        return 'File already generated! We can use this cached file to speed up site on common codes!';
	    }
	  }

function systemLog($text){
  $ipaddress = $_SERVER['REMOTE_ADDR'];
  $date = date("Y-m-d H:i:s");
  $filename = date("Ymd");
  $filename = "logs/".$filename."_logs.txt";
  if (file_exists($filename)) {
      $objFopen = fopen($filename, 'a');
  } else {
      $objFopen = fopen($filename, 'w');
  }
  fwrite($objFopen, " > ".$date." | IP : ".get_client_ip()." | ".$text."\r\n");
  if($objFopen){
    return 1;
  }
  else{
    return 0;
  }
  fclose($objFopen);
}

