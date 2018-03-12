<?php
include 'header.php';
if($type!='Admin'){
    echo "<script type='text/javascript'>";
      echo "window.location = 'form_login.php?st=3'; ";
      echo "</script>";
      exit;
  }elseif(isset($_SESSION['Username'])){
   echo  "<h1 align = 'center'>Log view</h1>";
  $query = "SELECT `ID`,`EventName`,`Type`,`DateStart`,`DateEnd`,`Location`,`MaximumCapacity`,`EventOwnerID` FROM EventOrganizers";
  

  $data = mysqli_query($con,$query);
  if($data==true){
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
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500" rel="stylesheet"/>
  <html>
  <div class="row">
  <div class="container"> 
    
    
    <table class="table responsive" id="sort">
      <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">EventName</th>
              <th scope="col">Type</th>
              <th scope="col">DateStart</th>
              <th scope="col">DateEnd</th>
              <th scope="col">Location</th>
              <th scope="col">MaximumCapacity</th>
              <th scope="col">EventOwner</th>
    
          </tr>
      </thead>
      <tbody>
      <?php 
               while($row = $data->fetch_array()) { ?>
          <tr>
              <?php $userName=getOneValue("SELECT Firstname AS 'get' FROM user WHERE ID = '{$row['EventOwnerID']}'");?>
              <td data-table-header="ID"><?php echo $row['ID'] ?></td>
              <td data-table-header="EventName"><?php echo $row['EventName'] ?></td>
              <td data-table-header="Type"><?php echo $row['Type']?></td>
              <td data-table-header="DateStart"><?php echo $row['DateStart']?> </td>
              <td data-table-header="DateEnd"><?php echo $row['DateEnd']?></td>
              <td data-table-header="Location"><?php echo $row['Location']?></td>
              <td data-table-header="MaximumCapacity"><?php echo $row['MaximumCapacity']?></td>
              <td data-table-header="EventStatus"><?php echo $userName ?></td>
              
          </tr>
          <?php 
              }
              ?>
      </tbody>
  </table>
  </div>
  </div>
  
   
<center>
<input class="btn btn-primary" type="button" style="color:#260d31" value="PDF" onclick="window.location.href='PDFevent.php'" />
<center>
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script src "https://cdn.datatables.net/plug-ins/1.10.15/sorting/stringMonthYear.js"></script>
  </html>
  <?php
  }else{
      echo false;
  }
  }
  ?>
  <style>
  table {
    width: 100%;
    border-collapse: collapse;
    color: black ;
  }
  
  
  /* Zebra striping */
  
  tr:nth-of-type(odd) {
    background: #f4f4f4;
  }
  
  tr:nth-of-type(even) {
    background: #F0546A;
  }
  
  th {
    background: #A9EBF7;
    color: #DD6262;
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