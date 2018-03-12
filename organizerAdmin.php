<link rel="stylesheet" href="css/style.css">
<?php
include 'header.php';
if ($type != 'Admin') {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
} elseif (isset($_SESSION['Username'])) {
    $query = "SELECT * FROM `OrganizerRegister` ORDER BY RegisID DESC";
    $data  = mysqli_query($con, $query);

    ?>
<script>
$(document).ready(function() {
   $("#sort").DataTable({
      columnDefs : [
    { type : 'date', targets : [3] }
],
   });
});
</script>
<html>
<div class="row">
  <div class="col-lg-1">
    
  </div>
  <div class="col-lg-10">
<div class="loginbg">

  <h2>ผู้สมัครเป็นผู้จัด</h2>
  <table class="table responsive" id="sort">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">วันที่</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">เบอรติดต่อ</th>
      <th scope="col">Email</th>
      <th scope="col">กิจกรรม</th>
      <th scope="col">เพิ่มเติม</th>
      <th scope="col">สถานะ</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
    <?php
    $count = 0;
    while ($row = $data->fetch_array()) {
        $RegisID = $row['RegisID'];
        $count++;
        if ($row['OrStatus'] == "0"){
          $status = "ยังไม่ติดต่อ";
          $link = "<a href='organizerChange.php?id=$RegisID'><p class='far fa-check-circle'></p></a>";
        }else if ($row['OrStatus'] == "1"){
          $status = "ติดต่อแล้ว";
          $link = "<a href='organizerChange.php?id=$RegisID'><p class='far fa-check-circle'></p></a>";
        }
        else if ($row['OrStatus'] == "2"){
          $status = "เป็น Organizer แล้ว";
          $link = "";
        }



        ?>

    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $row['OrCreate'] ?></td>
      <td><?php echo $row['OrName'] ?></td>
      <td><?php echo $row['OrTel']." (".$row['OrTelTime'].")" ?></td>
      <td><?php echo $row['OrEmail'] ?></td>
      <td><?php echo $row['OrType']." ".$row['OrSize'] ?> </td>
      <td><?php echo $row['OrAddcit'] ?></td>
      <td><?php echo $status; ?></td>
      <td><? echo $link;?></td>

    </tr>
    <?php
}
    ?>
  </tbody>
</table>
</div>
  </div>
  <div class="col-lg-1">
    
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src "https://cdn.datatables.net/plug-ins/1.10.15/sorting/stringMonthYear.js"></script>
</html>
<?php
}
?>
<style>
table{
  color:black;
}
th{
  background-color: #efefef;
}
@media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px) {

  /* Force table to not be like tables anymore */
  table.responsive,
  .responsive thead,
  .responsive tbody,
  .responsive th,
  .responsive td,
  .responsive tr {
    display: block !important;
  }

  /* Hide table headers (but not display: none;, for accessibility) */
  .responsive thead tr {
    position: absolute !important;
    top: -9999px;
    left: -9999px;
  }

  .responsive tr {
    border: 1px solid #ccc;
  }

  .responsive td {
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee !important;
    position: relative !important;
    padding-left: 25% !important;
  }

  .responsive td:before {
    /* Now like a table header */
    position: absolute !important;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap !important;
    font-weight: 500 !important;
  }

  /*
  Label the data
  */
  .responsive td:before {
    content: attr(data-table-header) !important;
  }
}
</style>