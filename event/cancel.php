<?php
include '../connection.php';
echo "CALCEL<br>";
echo $_GET['userID']."<br>";
echo $_GET['TicketID']."<br>";
echo $_GET['EventID']."<br>";


$UserID =$_GET['userID'];
$TicketID =$_GET['TicketID'];
$EventID =$_GET['EventID'];
$Token = $_GET['Token'];


$sql = "DELETE FROM EventHandler WHERE OwnerID=$UserID AND TicketID=$TicketID AND CardToken='$Token'  ";
mysqli_query($con, $sql);
header("Location: memberediter.php?yy=$zz&eid=$EventID");



 ?>
