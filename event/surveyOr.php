
<?
$path = basename(realpath(__DIR__ . '/..'));
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else if ($type == "Organizer") {
    if (!empty($_GET)) {

        $EventID   = $_GET['id'];
        $st   = $_GET['st'];
        $sql = "UPDATE `EventOrganizers` SET `SurveyStatus`='$st' WHERE `ID` = '$EventID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script type='text/javascript'>";
            echo "window.location = 'event/survey.php?eid=$EventID'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "window.location = 'index.php'; ";
            echo "</script>";}
    }
}
?>