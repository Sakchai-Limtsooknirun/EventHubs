
<?
$path    = basename(realpath(__DIR__ . '/..'));
$eventid = $_GET["id"];
if ($eventid == "") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'notfound'; ";
    echo "</script>";
    exit;
}
echo "<base href='/$path/'>";
include '../header.php';
$usernameID   = ownerID($username);
$getEventName = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
if ($getEventName == "") {
    ?>

<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
        <center><h2>ไม่พบกิจกรรม โปรดตรวจสอบ URL ใหม่</h2>
            <p>หรือ <a href="index.php">ค้นหา</a> กิจกรรม</p></center>

    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>

        <?
} else {
    $getEventPic = getOneValue("SELECT `Picture` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getOwner    = getOneValue("SELECT `Username` AS 'get' FROM `user` WHERE `ID` = (SELECT `EventOwnerID` FROM `EventOrganizers` WHERE `ShortURL` = '$eventid')");
    $getOwnerPic = getOneValue("SELECT `Picture` AS 'get' FROM `user` WHERE `Username` = '$getOwner'");
    $getLocation = getOneValue("SELECT `Location` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getDate     = DateThai(getOneValue("SELECT `DateStart` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'"));
    $getColor    = getOneValue("SELECT `ColorTone` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    if ($getColor != "") {
        echo "<body style='background-color:$getColor'>";
    }
    $getMapLat = getOneValue("SELECT `MapLat` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getMapLng = getOneValue("SELECT `MapLng` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getDetail = getOneValue("SELECT `Detail` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getEventOrName = getOneValue("SELECT `EventOrganizersName` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getEventOrTel = getOneValue("SELECT `EventContactTell` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getEventOrEmail = getOneValue("SELECT `EventContactEmail` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    $getEventOrFB = getOneValue("SELECT `EventFacebook` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    ?>

<body>
    <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    <?

    $getVDO = getOneValue("SELECT `TeaserVDO` AS 'get' FROM `EventOrganizers` WHERE `ShortURL` = '$eventid'");
    if ($getVDO != ""){
        $classVDOShow = "containVDO";
        $vdoURL = "https://www.youtube.com/embed/$getVDO?controls=0&showinfo=0&rel=0&autoplay=1&loop=1";
        echo "
<div class='video-background'>
    <div class='video-foreground'>
      <iframe src='$vdoURL' frameborder='0' allowfullscreen></iframe>
    </div>
</div>
<div class='detailArrowShow' id='buttonToDetail'>รายละเอียด<br><p class='fas fa-angle-double-down'></p></div>
        ";
    }else{
        $classVDOShow = "";
    }

    ?>

        <div class="contain noBorder <? echo$classVDOShow;?>" id="eventDetail">
            <img src="img/event/<?echo $getEventPic; ?>" alt="" width='100%'>
            <center>
                <h2><?echo $getEventName ?></h2>
                <h6>จัดงานโดย <?echo $getEventOrName ?></h6>
            </center>
            <hr>
            <div class="row">
                <div class="col-lg-8">
                   <p id='eventInfo'><p style='font-size:15px' class='fas fa-location-arrow'></p> <?echo $getLocation ?></p>
                   <p id='eventInfo'><p style='font-size:12px' class='fas fa-calendar-alt'></p> <?echo $getDate ?></p>
                </div>
                <div class="col-lg-4">
                    <?
    if ($type != "NotLogin") {
        if ($getColor != "") {
            echo "<button class='btnBuy' id='buttonToBuy' style='background-color:$getColor'>ซื้อบัตร</button>";
        } else {
            echo "<button class='btnBuy' id='buttonToBuy' >ซื้อบัตร</button>";
        }
    } else {
        echo "<button class='btnBuy' style='font-size:1.5em; padding:10px 50px;'><a href='form_login.php?go=$eventid'>เข้าสู่ระบบก่อนซื้อบัตร</a></button>";
    }
    ?>
                </div>
            </div>
        </div>
        <div class="contain noBorder">
            <div id="map"></div>
            <br>
        </div>
        <div class="contain noBorder eventDesc">
            <b>รายละเอียด <?echo $getEventName ?></b>
            <p><?echo $getDetail; ?></p>
        </div>
        <div class="contain noBorder eventDesc" id="eventBuyTicket">
            <h3>ซื้อบัตร <?echo $getEventName ?></h3>
            <p>ยังไม่เสร็จ</p>
        </div>
        <div class="contain noBorder eventDesc eventLast">
            <div class="row">
                <div class="col-lg-4">
                    <h3>ช่วยเหลือ</h3>
                    <ul>
                        <li><a href="webboard/<?echo $eventid;?>">กระดานสนทนา</a></li>
                        <li><a href="webboard/<?echo $eventid;?>">ติดต่อเรา</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <img src="img/user/<?echo $getOwnerPic;?>" style="height: 140px;width:140px;object-fit: cover;">
                </div>
                <div class="col-lg-4">
                    <b><p><?echo $getEventOrName ?></p></b>
                    <p><span class='glyphicon glyphicon-earphone'></span> <?echo $getEventOrTel ?></p>
                    <p><span class='glyphicon glyphicon-inbox'></span> <?echo $getEventOrEmail ?></p>
                    <a href="<?echo $getEventOrFB ?>" id="eventFBbtn">Facebook</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-0 col-sm-0 col-md-2 col-lg-2">

    </div>
</body>


<?

}

?>
<head>
    <meta charset="UTF-8">
    <title><?echo $getEventName ?> บน Eventhubs</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
   <script>
    function initMap() {
      var lat_value = <? echo $getMapLat?>;
      var lng_value = <? echo $getMapLng?>;
      var uluru = {lat: lat_value, lng: lng_value,};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
    }
    $("#buttonToBuy").click(function() {
        $('html, body').animate({
            scrollTop: $("#eventBuyTicket").offset().top
        }, 500);
    });
    $("#buttonToDetail").click(function() {
        $('html, body').animate({
            scrollTop: $("#eventDetail").offset().top
        }, 800);
    });
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaUHstzyhRrOeBISEQfYLrwJHNakmT3DM&callback=initMap">
    </script>
</head>




