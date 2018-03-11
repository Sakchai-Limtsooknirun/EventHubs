<?php
include 'header.php';
if(isset($_POST['txtEmail'])){
$token = bin2hex(openssl_random_pseudo_bytes(16));
$sql = "SELECT * from user where email = '{$_POST['txtEmail']}'";
$ck_email = mysqli_query($con,$sql);

if ($ck_email->num_rows == 1) {
  $row = mysqli_fetch_array($ck_email);
  $idf = $row['ID'];
  $uEmail= $_POST['txtEmail'];
  $name1 = $row['Firstname'];
  $lastname1 = $row['Lastname'];
  $meSQL = "UPDATE user  ";
  $meSQL .= "SET token = '{$token}' ";
  $meSQL .= "WHERE email = '{$uEmail}' ";
  $setToken = mysqli_query($con,$meSQL);
  
			// $strSubject = "Your Account information username and password.";
			$strHeader = "Content-type: text/html; charset=windows-874\n"; 
			$strHeader .= "From: webmaster@EventHub.com\nReply-To: webmaster@EventHub.com";
			$strMessage = "";
			$strMessage .= "Welcome : ".$row["Firstname"]."<br>";
      $strMessage .= "You Username is: ".$row["Username"]."<br>";
      $strMessage .=  "Please, click link below for reset your password. enjoy it.<br><br>";
      $strMessage .= "<a href='http://localhost/Project1/resetPW.php?userid=".$idf."&token=".$token."'>Click here</a>"."<br> If not work Plase Click!>> 'http://localhost/Project1/resetPW.php?userid=".$idf."&token=".$token."'<br>";
			$strMessage .= "=================================<br>";
      $strMessage .= "EventHubs.com<br><br>";
      $strMessage .= 'Admin Sakchai.';
      
  require_once('./PHPMailer_v5.0.2/class.phpmailer.php');
  $mail = new PHPMailer();
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
  $mail->FromName = "WebMaster";  // set from Name
  $mail->Subject = "EventHubs - reset you Password";
  $mail->Body = $strMessage;
  $mail->AddAddress($uEmail, $name1." ".$lastname1); // to Address
  // $mail->AddAttachment("thaicreate/myfile.zip");
  // $mail->AddAttachment("thaicreate/myfile2.zip");
  //$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
  //$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
  $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
  $mail->Send();
  echo "<h4 align = 'center' >Reset password will send to Your Email .<h4>";
  
}else{
  echo "NOT FOUND EMAIL";
}
}
?>

<html>
<head>
</head>
<body>
  <center>
<form name="form1" method="POST" action="lostPW.php">
  Forgot your password? (Input Email)<br><br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> Email</td>
        <td><input style="color:#260d31" name="txtEmail" type="email" id="txtEmail">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input style="color:#260d31" type="submit" name="btnSubmit" value="Reset Password">
</form>
<center>
</body>
</html>
  