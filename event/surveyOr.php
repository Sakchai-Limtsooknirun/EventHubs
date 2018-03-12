
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
        $resultEmail = mysqli_query($con, "SELECT DISTINCT `OwnerID` FROM `EventHandler` INNER JOIN EventTicket on EventHandler.TicketID = EventTicket.TicketID  WHERE EventTicket.EventID = '$EventID' AND `CardStatus` = '2'");
        $avgScoreAllAum = 0;
        if ($st == "0"){
          while ($row = mysqli_fetch_assoc($resultEmail)) {
            $ownerID = $row['OwnerID'];
            $getEmail = getOneValue("SELECT `email` AS 'get' FROM `user` WHERE `ID` = '$ownerID'");
            $getShortUrl = getOneValue("SELECT `ShortURL` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
            $getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ID` = '$EventID'");
            $getName = getOneValue("SELECT `Firstname` AS 'get' FROM `user` WHERE `ID` = '$ownerID'");
            $actual_link = dirname(dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"))."/survey/".$getShortUrl."/";

            sendEmail($getEmail,$getName,$getEventName,'surveyOn',$actual_link);

          }
        }

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