
<?
$path    = basename(realpath(__DIR__ . '/..'));
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
}else if ($type == "Organizer" || $type == "Admin" ){ //--------------------- Organizer ------------------------
?>


<body>

    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
    </div>



    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard " >





        <?
        if(!empty($_GET)){

          $EventID = $_GET['eid'];
          $result0 = mysqli_query($con, "SELECT * FROM `EventOrganizers`  WHERE ID = $EventID ");
          $row0 = mysqli_fetch_assoc($result0);
          $EventName  = $row0['EventName'];
          $Location = $row0['Location'];
          $CapMax = $row0['MaximumCapacity'];
          $CapNow = $row0['CapacityNow'];

          $DateStart = DateThai($row0['DateStart']);
          $DateEnd = DateThai($row0['DateEnd']);

          echo "<h2>สมาชิกในกิจกรรม $EventName</h2>
          <div class='col-sm-3'></div>
          <div class='col-sm-6'>
              <div >
              <h3>รายละเอียด </h3>
                <p>ชื่อกิจกรรม : $EventName</p>
                <p>ระยะเวลากิจกรรม: $DateStart - $DateEnd </p>
                <p>สถานที่ : $Location</p>
                <p>สมาชิก: $CapNow / $CapMax</p>
                <br>
                </div>
            </div>


          ";

        echo "<div  >
        <table class = ' table table-hover table-borderd' style='width:100%;color:black;'>
        <tr>

            <th>ลำดับ</th>
            <th>ชื่อจริงผู้ใช้</th>
              <th>นามสกุล</th>
              <th>ประเภทบัตร</th>
              <th>ราคาของบัตร</th>
              <th>เวลาซื้ออบัตร</th>
              <th>สถานะ</th>
              <th>ยืนยัน</th>
              <th>ยกเลิก</th>


            </tr>



                ";

                function CheckStatus($Status){
                  if($Status == 0){
                    return "รอการชำระเงิน";
                  }
                  else if($Status == 1){
                    return "ชำระเงินเรียบร้อย";
                  }
                  else if($Status == 2){
                    return "ยืนยันเรียบร้อย";
                  }
                  else if($Status == 3){
                    return "ยกเลิก";
                  }
                else{
                    return "เข้าร่วมงานเรียบร้อย";
                  }
                }


               $result = mysqli_query($con, "SELECT * FROM `EventTicket`  WHERE EventID = $EventID ");
               $no = 1 ;
                while ($row = mysqli_fetch_assoc($result)) {
                  $disabled;
                  $TicketID=$row['TicketID'];
                  $TicketName=$row['TicketName'];
                  $TicketPrice=$row['TicketPrice'];




                  $result2 = mysqli_query($con, "SELECT * FROM `EventHandler`  WHERE TicketID = $TicketID ");
                  while ($row2 = mysqli_fetch_assoc($result2)) {

                    $OwnerID = $row2['OwnerID'];
                    $BuyTime = $row2['CardSBuyTime'];
                    $Status = CheckStatus($row2['CardStatus']);
                    $Token = $row2['CardToken'];

                    if($row2['CardStatus']!=1){
                      $disabled = "disabled";
                    }



                    $result3 = mysqli_query($con, "SELECT * FROM `user`  WHERE ID = $OwnerID ");

                    while ($row3 = mysqli_fetch_assoc($result3)) {

                      $Firstname = $row3['Firstname'];
                      $LastName = $row3['Lastname'];
                      if($row2['CardStatus']==2){
                        echo "<tr><td>$no</td><td>$Firstname</td><td>$LastName</td><td>$TicketName</td><td >$TicketPrice</td><td>$BuyTime</td><td>$Status</td><td><a href='event/confirm.php?userID=$OwnerID&TicketID=$TicketID&EventID=$EventID&Token=$Token' ><button class='btn btn-default' disabled>ยืนยันแล้ว</button></a></td><td><a href='event/cancel.php?userID=$OwnerID&TicketID=$TicketID&EventID=$EventID&Token=$Token'><button class='btn btn-default' disabled>ยกเลิก</button></a></td></tr>";


                      }else if($row2['CardStatus']!=1){
                        echo "<tr><td>$no</td><td>$Firstname</td><td>$LastName</td><td>$TicketName</td><td >$TicketPrice</td><td>$BuyTime</td><td>$Status</td><td><a href='event/confirm.php?userID=$OwnerID&TicketID=$TicketID&EventID=$EventID&Token=$Token' ><button class='btn btn-default' disabled>ยืนยัน</button></a></td><td><a href='event/cancel.php?userID=$OwnerID&TicketID=$TicketID&EventID=$EventID&Token=$Token'><button class='btn btn-default'>ยกเลิก</button></a></td></tr>";

                      }else{


                      echo "<tr><td>$no</td><td>$Firstname</td><td>$LastName</td><td>$TicketName</td><td >$TicketPrice</td><td>$BuyTime</td><td>$Status</td><td><a href='event/confirm.php?userID=$OwnerID&TicketID=$TicketID&EventID=$EventID&Token=$Token' ><button class='btn btn-default'>ยืนยัน</button></a></td><td><a href='event/cancel.php?userID=$OwnerID&TicketID=$TicketID&EventID=$EventID&Token=$Token'><button class='btn btn-default disabled'>ยกเลิก</button></a></td></tr>";

                    }

                    $no += 1;



                    }


                  }
                }
        echo "</table></div>";
        }
        else{


            echo "<center><h1>คุณไม่มีสิทธิเข้าหน้านี้</h1></center>";






          ?>


          </div>



            <?
        }
        ?>
          <a href="event/toPDF.php?EventID=<?php echo $EventID; ?>"><button style="float:right ; width:150px;"class='btn btn-default'>ออกใบรายชื่อ</button><>

        </div>
        <hr>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">

    </div>
</body>


<? //------------------------------------------
}
else {

?>
<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
            <p>คุณไม่มีสิทธิเข้าหน้านี้</p>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
</body>
		<?
}

?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
