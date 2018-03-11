

<?php
function sendEmail($email,$message,$header,$name,$eventName,$type){





  $strMessage = "";
 


  
require_once('../PHPMailer_v5.0.2/class.phpmailer.php');

$mail = new PHPMailer();
$mail-> CharSet = 'UTF-8';
$mail->IsHTML(true);
$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "jaytaku23513@gmail.com"; // GMAIL username
$mail->Password = "jay0860789213"; // GMAIL password
$mail->From = "admin@EventHubs.com"; // "name@yourdomain.com";
//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
$mail->FromName = "EventHub";  
if($type == 'c'){
$mail->Subject = "EventHubs - ยืนยันการเข้าร่วมกิจกรรมของคุณ :".$name;
$strMessage .= "ได้มีการยืนยันจากทางเจ้าของกิจกรรม ".$eventName." ให้คุณมีสิทธในการเข้าร่วมกิจกรรม<br>แล้วพบกันในงานภายในวันเวลาที่กำหนด<br>";
}
else{
  $mail->Subject = "EventHubs - กิจกรรม".$eventName."มีการแก้ไข";
  $strMessage .= $message."กิจกรรม".$eventName." มีการแก้ไขรายละเอียดภายในงาน กรุณาตรวจสอบกิจกรรมอีกครั้ง";
  

}
echo $strMessage;
$mail->Body = $strMessage;
$mail->AddAddress($email, $name); // to Address
// $mail->AddAttachment("thaicreate/myfile.zip");
// $mail->AddAttachment("thaicreate/myfile2.zip");
//$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
//$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
$mail->Send();
}

sendEmail('anaphat.i@ku.th','','Header','NAME','eventname','c');
sendEmail('anaphat.i@ku.th','','Header','name','eventname','e');








?>