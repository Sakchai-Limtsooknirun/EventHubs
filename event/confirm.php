<?php
include '../connection.php';
echo $_GET['userID']."<br>";
echo $_GET['TicketID']."<br>";
echo $_GET['EventID']."<br>";

$UserID =$_GET['userID'];
$TicketID =$_GET['TicketID'];
$EventID =$_GET['EventID'];


$Token = $_GET['Token'];


$result0 = mysqli_query($con, "SELECT * FROM `EventOrganizers`  WHERE ID = $EventID ");
$row0 = mysqli_fetch_assoc($result0);
$EventName  = $row0['EventName'];
$url = $row0['ShortURL'];


$result3 = mysqli_query($con, "SELECT * FROM `user`  WHERE ID = $UserID ");
$row3 = mysqli_fetch_assoc($result3);
$email = $row3['email'];
$name = $row3['Firstname'];
echo "<br>".$email ."      EMAIL<br>";
echo $name ."   NAME<br>";
echo $EventName ."  EVENT NAME<br>";
echo $url."   URL<br>";
echo "http://localhost/projectMidterm/eventview/".$url;

sendEmail($email,$name,$EventName,'c',$url);


$sql = "UPDATE EventHandler SET CardStatus=2 WHERE OwnerID=$UserID AND TicketID=$TicketID AND CardToken='$Token'";
mysqli_query($con, $sql);
// header("Location: memberediter.php?yy=$zz&eid=$EventID");








 ?>
