<?php
include 'header.php';
if($type!='Admin'){
  echo "Need Permission to access ";
}elseif(isset($_SESSION['Username'])){
$query = "select * from user";
$data = mysqli_query($con,$query);
echo store_log($username,' เข้าใช้ส่วนจัดการผู้ใช้');

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

<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/> -->

<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500" rel="stylesheet"/>

<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> -->
<html>
<div class="row">
<div class="container"> 
  
  <h1>User Manager</h1> 
  <table class="table responsive" id="sort">
	<thead>
		<tr>
            <th style="width : 20%; height: 10% ;" scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">ระดับสมาชิก</th>
			      <th scope="col">Username</th>
			      <th scope="col">Firstname</th>
			      <th scope="col">Lastname</th>
            <th scope="col">Gender</th>
            <th scope="col">วันที่สมัครสมาชิก</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
		</tr>
	</thead>
	<tbody>
    <?php 
             while($row = $data->fetch_array()) { $sid = $row[0] ?>
		<tr>
            
			<td class = "Wpic" data-table-header="Picture"><img class='img-thumbnail' width=50% height=50% src='img/user/<?php echo $row['Picture']?>' alt='' width='100%'></td>
			<td  data-table-header="ID"><?php echo $row['ID'] ?></td>
			<td data-table-header="ระดับสมาชิก"><?php echo checkType($row['Username'])?></td>
			<td data-table-header="Username"><?php echo $row['Username']?> </td>
            <td data-table-header="Firstname"><?php echo $row['Firstname']?></td>
            <td data-table-header="Lastname"><?php echo $row['Lastname']?></td>
            <td data-table-header="Gender"><?php if($row["sex"]=="m"){
                                    echo "Male" ;
                                            }else{
                                            echo "Female";
  } ?></td>
        <td data-table-header="วันที่สมัครสมาชิก"><?php echo DateThai($row['ts']) ?></td>
            <?php if($row["Username"] == $_SESSION["Username"]){ ?>
                <td data-table-header="แก้ไข">--</td>
                <td data-table-header="ลบ">--</td>
            <?php } else{ ?> <td data-table-header="แก้ไข"><a  href='adminEdit.php?IDedit=<?php echo $sid ?>'>Edit</a></td>
            <td data-table-header="ลบ"><a  href="UserDelete.php?IDedit=<?php echo $sid ?>" onclick='return confirm("Do you want to delete this record? !!!")'>Del</a></td>  <?php } ?>
            
            
		</tr>
		<?php 
            }
            
            ?>
	</tbody>
</table>
</div>
</div>
          <?php }
          ?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src "https://cdn.datatables.net/plug-ins/1.10.15/sorting/stringMonthYear.js"></script>
</html>
<style>
table {
  width: 100%;
  border-collapse: collapse;
  color : black;
  
}


/* Zebra striping */

tr:nth-of-type(odd) {
  background: #f4f4f4;
}

tr:nth-of-type(even) {
  background:#F6E9E0;
}

th {
  background: #F0546A;
  color: #ffffff;
  font-weight: 300;
}

td,
th {
  padding: 10px;
  border: 1px solid #ccc;
  text-align: left;
   
}
.Wpic{
    align = "center";
}

td:nth-of-type(1) {
  font-weight: 500 !important;
}

td {
  font-family: 'Roboto', sans-serif !important;
  font-weight: 300;
  line-height: 20px;
}

span {
  font-style: italic
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