<?php
include 'header.php';
$query = "select * from Log";
$data = mysqli_query($con,$query);

//echo store_log($username,'test สำเร็จ');

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

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500" rel="stylesheet"/>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<html>
<div class="row">
<div class="container"> 
  
  <h1>Log view</h1> 
  <table class="table responsive" id="sort">
	<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Username</th>
			<th scope="col">IP Adress</th>
			<th scope="col">Date</th>
			<th scope="col">Activity</th>
		</tr>
	</thead>
	<tbody>
    <?php 
             while($row = $data->fetch_array()) { ?>
		<tr>
            
			<td data-table-header="ID"><?php echo $row['log_id'] ?></td>
			<td data-table-header="Authors"><?php echo $row['log_username'] ?></td>
			<td data-table-header="Journal"><?php echo $row['log_ip']?></td>
			<td data-table-header="Date"><?php echo $row['log_date']?> </td>
            <td data-table-header="Link"><?php echo $row['log_act']?></td>
            
		</tr>
		<?php 
            }
            ?>
	</tbody>
</table>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src "https://cdn.datatables.net/plug-ins/1.10.15/sorting/stringMonthYear.js"></script>
</html>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}


/* Zebra striping */

tr:nth-of-type(odd) {
  background: #f4f4f4;
}

tr:nth-of-type(even) {
  background: #fff;
}

th {
  background: #782f40;
  color: #ffffff;
  font-weight: 300;
}

td,
th {
  padding: 10px;
  border: 1px solid #ccc;
  text-align: left;
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