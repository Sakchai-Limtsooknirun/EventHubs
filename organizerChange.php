
<?
include 'header.php';
$usernameID = ownerID($username);
echo $usernameID;
?>
<head>
    <meta charset="UTF-8">
    <title>Eventhubs | สมัครเป็นผู้จัด</title>
    <link rel="stylesheet" href="css/style.css">
<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard" style="margin-bottom: 80px;">
      <?
if ($type != 'Admin') {
    echo "<script type='text/javascript'>";
    echo "window.location = 'organizer.php?st=3'; ";
    echo "</script>";
    exit;
} else {
    $id     = $_GET['id'];
    // echo $id;
    $sql    = "UPDATE `OrganizerRegister` SET `OrStatus`=`OrStatus`+1 WHERE `RegisID` = '$id'";
    var_dump($sql);
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'organizerAdmin.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'organizer.php?st=2'; ";
        echo "</script>";}

    ?>
<h2>กำลังเปลี่ยนสถานะ</h2>
<center><h3>กำลังเปลี่ยนสถานะ</h3></center>
</div>

<?

}

?>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>
</head>




