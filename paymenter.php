
<?
include 'header.php';
$usernameID = ownerID($username);
$method     = $_POST['method'];
$card       = $_POST['card'];
$token      = $_POST['token'];
$date       = date("Y-m-d H:i:s");

if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else {
    $usernameID = ownerID($username);
    if ($method == 0) {
        if (isset($_FILES['eventPic'])) {
            $errors    = array();
            $file_name = $_FILES['eventPic']['name'];
            $file_size = $_FILES['eventPic']['size'];
            $file_tmp  = $_FILES['eventPic']['tmp_name'];
            $file_type = $_FILES['eventPic']['type'];
            $file_ext  = strtolower(end(explode('.', $_FILES['eventPic']['name'])));

            $expensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "img/payment/" . $file_name);
                echo "Success";
            } else {
                print_r($errors);
            }
            $evi = $file_name;
        } else {
        }
    } else {
        $evi = $card;
    }
    $sql    = "UPDATE `EventHandler` SET `CardStatus`='1',`PaymentTime`='$date',`PaymentMethod`='$method',`PaymentEvidence`='$evi' WHERE `CardToken` = '$token'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location = 'ticket.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'ticket.php?error'; ";
        echo "</script>";
    }
}
?>


<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
</head>





