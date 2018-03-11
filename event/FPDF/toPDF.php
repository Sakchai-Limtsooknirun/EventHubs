
<?php

include '../connection.php';

?>


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>



<script type="text/javascript" src="html2canvas.js"></script>

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="tableExport.js"></script>
<script type="text/javascript" src="jquery.base64.js"></script>
<script type="text/javascript" src="html2canvas.js"></script>
<script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="jspdf/jspdf.js"></script>
<script type="text/javascript" src="jspdf/libs/base64.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




<?php





$EventID = 2;

 $result = mysqli_query($con, "SELECT * FROM `EventOrganizers`  WHERE ID = $EventID ");


 $recordsEventOrgan = array();

 while ($row = mysqli_fetch_assoc($result)) {
    $records[] = $row;
  }

?>




<div>
<div class="row style="height:200px;width:100%;overflow:scroll;">
  <div class='col-sm-1'>
  </div>
  <div class='col-sm-10'>
                <table id="employees" class="table table-striped">
                <thead>
                    <tr class="warning">
                        <th>ลำดับ</th>
                        <th>ชื่อจริง</th>
                        <th>นามสกุล</th>
                        <th>ประเภทบัตร</th>

                        <th>ราคา</th>
                        <th>สถานะ</th>
                        <th>e-mail</th>
                        <th>เบอร์ติดต่อ</th>
                        <th>Token</th>


                    </tr>
                </thead>
                <tbody>
                  <h2>รายชื่อผู้สมัคร<h2>

                <?php foreach($records as $rec):?>
                    <tr>


                        <?php



                        $result = mysqli_query($con, "SELECT * FROM `EventTicket`  WHERE EventID = $EventID ");
                        $no = 1 ;
                         while ($row = mysqli_fetch_assoc($result)) {
                           $disabled;
                           $TicketID=$row['TicketID'];
                           $TicketName=$row['TicketName'];
                           $TicketPrice=$row['TicketPrice'];




                           $result2 = mysqli_query($con, "SELECT * FROM `EventHandler`  WHERE TicketID = $TicketID AND CardStatus = 2 ");
                           while ($row2 = mysqli_fetch_assoc($result2)) {

                             $OwnerID = $row2['OwnerID'];
                             $BuyTime = $row2['CardSBuyTime'];
                             $Status = CheckStatus($row2['CardStatus']);
                             // $Status = $row2['CardStatus'];
                             $Token = $row2['CardToken'];

                             if($row2['CardStatus']!=1){
                               $disabled = "disabled";
                             }



                             $result3 = mysqli_query($con, "SELECT * FROM `user`  WHERE ID = $OwnerID ");

                             while ($row3 = mysqli_fetch_assoc($result3)) {

                               $Firstname = $row3['Firstname'];
                               $LastName = $row3['Lastname'];
                               $Email = $row3['email'];
                               $Phone = $row3['telephone'];


                                 echo "<tr><td>$no</td><td>$Firstname</td><td>$LastName</td><td>$TicketName</td><td >$TicketPrice</td><td>$Status</td><td>$Email</td><td>$Phone</td><td>$Token</td>";



                             $no += 1;



                             }


                           }
                         }

                        ?>

                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </table>

                  </div>
</div>
</div>


<li><a href="#" onclick="$('#employees').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src="images/json.jpg" width="24px"> JSON</a></li>
<li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false'});"><img src="images/json.jpg" width="24px">JSON (ignoreColumn)</a></li>
