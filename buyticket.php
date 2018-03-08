<?php
include 'header.php';
$ticketid = $_GET["ticketid"];
$token   = $_GET["token"];
$date    = date("Y-m-d H:i:s");
$usernameID   = ownerID($username);

if (empty($_GET)) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
} else {

    $sql    = "INSERT INTO `EventHandler` VALUES ('','0','$ticketid','$date','$token','$usernameID')";
    $result = mysqli_query($con, $sql);
    $sql_update    = "UPDATE `EventTicket` SET `TicketNow`=TicketNow+1 WHERE `TicketID` = '$ticketid'";
    $result_update = mysqli_query($con, $sql_update);
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'ticket.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'index.php'; ";
        echo "</script>";}
}
