<?php

var_dump($_POST['TT']);
// var_dump ($_POST['PP']);





include '../connection.php';
$result;
$row;


if ($_FILES['picture1']['error'] == "0") {
 $file_name     = $_FILES['picture1']['name'];
 echo $file_name."   FILE NAME";

}

if (isset($_POST['id'])) {
    $ID = $_POST['id'];
    $result = mysqli_query($con, "SELECT * FROM EventOrganizers WHERE ID = $ID");
    $row = mysqli_fetch_assoc($result);

    echo $row['EventName'];
}else{
  $ID = 0;
}

 $file_name     = $_FILES['picture1']['name'];


if (isset($_FILES['picture1'])) {
            echo "have image";
            $errors    = array();
            $file_name = $_FILES['picture1']['name'];
            $file_size = $_FILES['picture1']['size'];
            $file_tmp  = $_FILES['picture1']['tmp_name'];
            $file_type = $_FILES['picture1']['type'];
            $file_ext  = strtolower(end(explode('.', $_FILES['picture1']['name'])));

            $expensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "../img/event/" . $file_name);
                  $sql = "UPDATE EventOrganizers SET Picture='$file_name' WHERE ID=$ID";
                  mysqli_query($con, $sql);
                echo "Success";
            } else {
                print_r($errors);
            }
        } else {
            echo "dfdf";
        }


////////////////////////////////

if (isset($_POST['name'])) {
    $EventName = $_POST['name'];
}

if (isset($_POST['status'])) {
    $EventStatus = $_POST['status'];
}

$Location = $_POST['location'];
$DateStart = $_POST['dates'];
$TimeStart = $_POST['times'];
$Detail = $_POST['detail'];
echo $Detail."   DETAIL";
$DateStart = $DateStart." ".$TimeStart;
$DateEnd = $_POST['datee'];
$TimeEnd = $_POST['timee'];
$Type = $row['Type'];
$DateEnd = $DateEnd." ".$TimeEnd;
$CapacityNow = $row['CapacityNow'];
$MaximumCapacity = $_POST['capmax'];
if (($MaximumCapacity+0) < ($CapacityNow+0)) {
    $MaximumCapacity = $row['MaximumCapacity'];
}
else{
    $MaximumCapacity = $_POST['capmax'];
}
// if (isset($_FILES['image']['name'])) {
//   $Picture = $_FILES['image']['name'];
//   if($Picture != ''){
//   $sql = "UPDATE EventOrganizers SET Picture='$Picture' WHERE ID=$ID";
//   mysqli_query($con, $sql);
// }









$ShortURL = $_POST['url'];
$Precondition = $_POST['precondition'];
if (isset($_POST['price'])) {
    $Price = $_POST['price'];
}
else{

  $Price = 0;
}
$Color = $_POST['color'];
$EventOrgName = $_POST['ownname'];
$EventContactTell = $_POST['tell'];
$EventContactEmail = $_POST['email'];
$EventFacebook = $_POST['facebook'];

// echo "<br>$EventName";
// echo "<br>$EventStatus";
// echo "<br>$ID";
// echo "<br>$Location";
echo "<br>$DateStart";
echo "<br>$DateEnd";
// echo "<br>$CapacityNow"."    THIS IS CAP NOW";
// echo "<br>$MaximumCapacity" . "THIS IS CAP MAX";
// echo "<br>$Picture";
// echo "<br>$ShortURL";
// echo "<br>$Precondition";
// echo "<br>$Price"." THIS PRICE";
// echo "<br>$Color";
// echo "<br>$EventOrgName";
// echo "<br>$EventContactTell";
// echo "<br>$EventContactEmail";
// echo "<br>$EventFacebook ";
// echo "<br>$Picture"."  IMAGEEEE";

$sql = "UPDATE EventOrganizers SET EventName='$EventName',Detail='$Detail',PreCondition = '$Precondition',DateStart='$DateStart',DateEnd='$DateEnd',location='$Location',ColorTone='$Color',EventOrganizersName='$EventOrgName',EventContactTell='$EventContactTell',EventContactEmail='$EventContactEmail',EventFacebook='$EventFacebook', MaximumCapacity=$MaximumCapacity,Price=$Price WHERE ID=$ID";
mysqli_query($con, $sql);
header("Location: index.php?yy=$zz");




mysqli_close($con);
 ?>
