
<?
include 'header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} else {
    $usernameID = ownerID($username);
    $token      = $_GET['token'];
    $receipt    = substr($token, 0, 8);
    $getOwner   = getOneValue("SELECT `OwnerID` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
    if ($usernameID != $getOwner) {
        systemLog("$username พยายามเข้าหน้าจ่ายเงินของผู้อื่น ($token)");
        echo "<script type='text/javascript'>";
        echo "window.location = 'ticket.php?st=1'; ";
        echo "</script>";
    } else {
//------------------------------------------
        $date        = DateThai(date("Y-m-d H:i:s"));
        $ticketID    = getOneValue("SELECT `TicketID` AS 'get' FROM `EventHandler` WHERE `CardToken` = '$token'");
        $ticketName  = getOneValue("SELECT `TicketName` AS 'get' FROM `EventTicket` WHERE `TicketID` = '$ticketID'");
        $ticketPrice = getOneValue("SELECT `TicketPrice` AS 'get' FROM `EventTicket` WHERE `TicketID` = '$ticketID'");
        $eventName   = getOneValue("SELECT `EventName` AS 'get' FROM `EventOrganizers` INNER JOIN EventTicket ON EventOrganizers.ID = EventTicket.EventID WHERE `TicketID` = '$ticketID'");

        ?>


<body>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
    <h2>จ่ายเงิน</h2>
<div class="row">
    <div class="col-lg-6">
    <form action="paymenter.php" method="POST" enctype="multipart/form-data">
        <div class="well">
            <p>เลือกวิธีชำรเงิน</p>
            <div id="exTab1" class="" style="padding:20px 10px; color:black;">
                <ul  class="nav nav-pills">
                    <input type="hidden" value="<?echo $token; ?>" name="token">
                    <input type="hidden" value="0" name="method" id="method">
                    <li class="active"><a href="#cash" data-toggle="tab" onclick="activaTab(0)">เงินสด</a></li>
                    <li><a href="#credit" data-toggle="tab" onclick="activaTab(1)">บัตรเครดิต</a></li>
                </ul>
                <div class="tab-content" >
                    <div class="tab-pane active" id="cash" style="word-wrap: break-word;">
                        <br>
                        <p>คุณสามารถชำระเงินผ่านธนาคารได้โดยโอนเงินผ่าน Internet Banking</p>
                        <p>Mobile Bangking หรือหน้าตู้ฝาก ADM ได้ตลอด 24 ชั่วโมง</p>
                        <table class="table table-hover" style='color:var(--font-gray);'>
                            <thead>
                                <tr>
                                    <th>ธนาคาร</th>
                                    <th>หมายเลขบัญชี</th>
                                    <th>ชื่อบัญชี</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ไทยพาณิชญ์</td>
                                    <td>123-456789-0</td>
                                    <td>บมจ. อีเว้นฮับ จำกัด</td>
                                </tr>
                                <tr>
                                    <td>กสิกรไทย</td>
                                    <td>355-746332-3</td>
                                    <td>บมจ. อีเว้นฮับ จำกัด</td>
                                </tr>
                                <tr>
                                    <td>กรุงไทย</td>
                                    <td>875-465241-8</td>
                                    <td>บมจ. อีเว้นฮับ จำกัด</td>
                                </tr>
                                <tr>
                                    <td>ทหารไทย</td>
                                    <td>267-978633-4</td>
                                    <td>บมจ. อีเว้นฮับ จำกัด</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>หลักฐานการชำระเงิน (สลิป)</p>
                        <input type="file" name="eventPic" id="eventPic" accept="image/*">
                    </div>
                    <div class="tab-pane" id="credit">
                        <br>
            <!-- <div class='form-row'> -->
              <div class='col-xs-12 form-group'>
                <label class='control-label'>Name on Card</label>
                <input class='form-control' size='4' type='text'>
              </div>
            <!-- </div> -->
            <!-- <div class='form-row'> -->
              <div class='col-xs-12 form-group card '>
                <label class='control-label'>Card Number</label>
                <input autocomplete='off' type='text' class='form-control card-number' maxlength="16" name="card">
              </div>
            <!-- </div> -->
            <!-- <div class='form-row'> -->
              <div class='col-xs-4 form-group cvc '>
                <label class='control-label'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration '>
                <label class='control-label'>Expiration</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration '>
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
              </div>
            <!-- </div> -->
                    <small>กรุณาตรวจสอบความถูกต้องของบัตรเครดิต</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="well" >
            <div class="row" style="padding:10px 40px;">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <address>
                                <strong>EventHubs</strong>
                                <br>
                                50 ถนนพหลโยธิน แขวงลาดยาว
                                <br>
                                เขตจตุจักร กรุงเทพฯ 10900
                                <br>
                                <abbr title="Phone">โทร :</abbr> (66)2942-8200-45
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>
                                <em>วันที่ : <?echo $date; ?></em>
                            </p>
                            <p>
                                <em>หมายเลขอ้างอิง #: <?echo $receipt; ?></em>
                            </p>
                        </div>
                    </div>
                    <div class="row" style="color: var(--font-gray)">
                        <div class="text-center">
                            <h1>ใบเสร็จ</h1>
                        </div>
                        </span>
                        <table class="table table-hover" style="color: var(--font-gray)">
                            <thead>
                                <tr>
                                    <th>บัตร</th>
                                    <th class="text-right">ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9" ><em><?echo $ticketName . " " . $eventName; ?></em></h4></td>
                                    <td class="col-md-1 text-right" >฿<?echo $ticketPrice; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                    <p>
                                        <strong>รวม:</strong>
                                    </p>
                                    <p>
                                        <strong>ค่าธรรมเนียม:</strong>
                                    </p></td>
                                    <td class="text-right">
                                    <p>
                                        <strong>฿<?echo $ticketPrice; ?></strong>
                                    </p>
                                    <p>
                                        <strong>฿50</strong>
                                    </p></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><h4><strong>ราคารวม: </strong></h4></td>
                                    <td class="text-right text-danger"><h4><strong>฿<?echo $ticketPrice + 50; ?></strong></h4></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            จ่าย   <span class="glyphicon glyphicon-chevron-right"></span>
                        </button></td>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
</body>


<?//------------------------------------------
    }
}
?>


<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
    function activaTab(n){
        // $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        var methodId = document.getElementById("method");
        methodId.value = n;

    };
    </script>
</head>





