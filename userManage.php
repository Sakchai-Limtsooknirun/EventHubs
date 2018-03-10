<?php
include 'header.php';
$query = "select * from user";

if(isset($_POST['txtKeyword']) && (isset($_POST['sorttype'])) && ($_POST['sorttype']!="null")){
   if(($_POST['txtKeyword']=='male')||($_POST['txtKeyword']=='Male')||($_POST['txtKeyword']=='MALE')||($_POST['txtKeyword']=='ชาย')){
      $_POST['txtKeyword']='m';
   }elseif(($_POST['txtKeyword']=='female')||($_POST['txtKeyword']=='FeMale')||($_POST['txtKeyword']=='FEMALE')||($_POST['txtKeyword']=='หญิง')){
      $_POST['txtKeyword']='f';
   }
  echo $query .= " where {$_POST['sorttype']} = '{$_POST['txtKeyword']}'";
}

$data = mysqli_query($con,$query);




echo "<form align = 'center' name='frmSearch' method='post' action = 'userManage.php'>
<table align = 'center' width='340' border='1'>
ค้นหาด้วย:
<select style='color:#260d31' style = 'height:40'; align = 'center' name='sorttype'>
<option value=null >-------</option>
<option value='ID' >รหัส</option>
<option value='Username'>USERNAME</option>
<option value='Firstname'>ชื่อ</option>
<option value='Lastname'>นามสกุล</option>
<option value='sex'>เพศ</option>
<option value='email'>E-mail</option>
</select>

  <tr>
  <br>
  <center>
    <th>ค้นหา
    <input class=navbar-form navbar-left role='search' style='color:#260d31' name='txtKeyword' type='text'>
    <center>
    <div class='form-group'>
    <input style='color:#260d31' class='btn btn-default'  type='submit' value='Search'></th>
    </div>
    <center>
  </tr>
  
</table>
</form>";
if($data->num_rows==0){
  echo "<h1 align = 'center' style=color:red; >DATA NOT FOUND<h1>";
}
echo "<div id='sun'>";
echo "<table  class='table table-hover table-bordered' cellspacing='0' width='100%'>";

echo "<thead>
      <tr align='center' bgcolor='#CCCCCC'>

      <th>Profile</th>

      <th><a href='#' onclick='jay(\"ids\")'>รหัส</th>
      <th><a href='#' onclick='jay(\"lvs\")'>ระดับสมาชิก</th>
      <th><a href='#' onclick='jay(\"users\")'>Uername</th>
      <th><a href='#' onclick='jay(\"names\")'>ชื่อ</th>
      <th><a href='#' onclick='jay(\"lastnames\")'>นามสกุล</th>
      <th><a href='#' onclick='jay(\"sexs\")'>เพศ</th>
      <th><a href='#' onclick='jay(\"mails\")'>อีเมล์</th>
      <th><a href='#' onclick='jay(\"days\")'>วันที่สมัคร</th>
      <th>แก้ไข/ลบ</th>
      </tr>
      </thead>
      <tbody>";

while($row = $data->fetch_array()) { 
  echo "<tr style='color:#260d31' align='center' style = height:50%;>";

  echo "<td width='auto'>" ."<img class='img-thumbnail' width=50% height=50% src='img/user/".$row['Picture']."' alt='' width='100%'>" .  "</td> "; 
  echo "<td width='auto'>" .$row["ID"] .  "</td> "; 
  echo "<td width='auto'>" .checkType($row["Username"]) .  "</td> "; 
  echo "<td width='auto'>" .$row["Username"] .  "</td> ";  
  echo "<td width='auto'>" .$row["Firstname"] .  "</td> ";
  echo "<td width='auto'>" .$row["Lastname"] .  "</td> ";
  if($row["sex"]=="m"){
  echo "<td width='auto'>" ."Male" .  "</td> ";
  }else{
    echo "<td width='auto'>" ."Female" .  "</td> ";
  }
  echo "<td width='auto'>" .$row["email"] .  "</td> ";
  echo "<td width='auto'>" .$row["ts"] .  "</td> ";
  if($row["Username"]!= $_SESSION["Username"]){
  echo "<td width='auto'class='btn btn-default' style = margin-top:10px; ><a href='adminEdit.php?IDedit=$row[0]'>Edit</a></td> ";
  echo "<td width='auto' class='btn btn-danger' style = margin-top:10px;><a  href='UserDelete.php?IDedit=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">Del</a></td> ";
  echo "</tr>";
  }
  echo  "</tbody>";

}
echo "</table>";
echo "</div>";
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
    var s = 0;

    function jay(sort){
        console.log(sort);
        if(s == 0){
        $.get('sortdata.php',{sort:sort,sun:''},function(data){
            console.log(data);
            $('#sun').html(data);
        });
        s = 1;
        }
        else{
            $.get('sortdata.php',{sort:sort,sun:'DESC'},function(data){
            console.log(data);
            $('#sun').html(data);
        });
        s = 0;
        }
    }
    </script>
</body>
</html>