<?php
include 'header.php';
$query = "select * from user";


if(empty($_GET['sort'])){
  $query = "select * from user";
}else{
if ($_GET['sort'] == 'ids')
{
    $query .= " ORDER BY ID";
}
elseif ($_GET['sort'] == 'lvs')
{
    $query .= " ORDER BY role";
}
elseif ($_GET['sort'] == 'users')
{
    $query .= " ORDER BY Username";
}
elseif($_GET['sort'] == 'names')
{
    $query .= " ORDER BY Firstname";
}
elseif($_GET['sort'] == 'lastnames')
{
    $query .= " ORDER BY Lastname";
}
elseif($_GET['sort'] == 'sexs')
{
    $query .= " ORDER BY sex";
}
elseif($_GET['sort'] == 'mails')
{
    $query .= " ORDER BY email";
}
elseif($_GET['sort'] == 'days')
{
    $query .= " ORDER BY ts";
}
else{
}
}

if(isset($_POST['txtKeyword']) && (isset($_POST['sorttype'])) && ($_POST['sorttype']!="null")){
   if(($_POST['txtKeyword']=='male')||($_POST['txtKeyword']=='Male')||($_POST['txtKeyword']=='MALE')||($_POST['txtKeyword']=='ชาย')){
      $_POST['txtKeyword']='m';
   }elseif(($_POST['txtKeyword']=='female')||($_POST['txtKeyword']=='FeMale')||($_POST['txtKeyword']=='FEMALE')||($_POST['txtKeyword']=='หญิง')){
      $_POST['txtKeyword']='f';
   }
  echo $query .= " where {$_POST['sorttype']} = '{$_POST['txtKeyword']}'";
}
// else{
//   $query = "select * from user";
//}
$data = mysqli_query($con,$query);
if($data==true){
  echo "OK";
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">


<?php

echo "<form align = 'center' name='frmSearch' method='post' action = 'userManage.php'>
<table align = 'center' width='340' border='1'>
ค้นหาด้วย:
<select style = 'height:40'; align = 'center' name='sorttype'>
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
    <th>ค้นหา
    <input name='txtKeyword' type='text'>
    <input type='submit' value='Search'></th>
  </tr>
</table>
</form>";
if($data->num_rows==0){
  echo "<h1 align = 'center' style=color:red; >DATA NOT FOUND<h1>";
}
echo "<table  class='table table-hover table-striped table-bordered' cellspacing='0' width='100%'>";

echo "<thead>
      <tr align='center' bgcolor='#CCCCCC'>

      <th>Profile</th>
      <th><a href=userManage.php?sort=ids>รหัส</th>
      <th><a href=userManage.php?sort=lvs>ระดับสมาชิก</th>
      <th><a href=userManage.php?sort=users>Uername</th>
      <th><a href=userManage.php?sort=names>ชื่อ</th>
      <th><a href=userManage.php?sort=lastnames>นามสกุล</th>
      <th><a href=userManage.php?sort=sexs>เพศ</th>
      <th><a href=userManage.php?sort=mails>อีเมล์</th>
      <th><a href=userManage.php?sort=days>วันที่สมัคร</th>
      <th>แก้ไข/ลบ</th>
      </tr>
      </thead>
      <tbody>";
while($row = $data->fetch_array()) { 
  echo "<tr align='center' style = height:50%;>";

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
  echo "<td width='auto'class='btn btn-default' style = margin-top:10px; ><a href='adminEdit.php?IDedit=$row[0]'>Edit</a></td> ";
  if($row["Username"]!= $_SESSION["Username"]){
  echo "<td width='auto' class='btn btn-danger' style = margin-top:10px;><a  href='UserDelete.php?IDedit=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">Del</a></td> ";
  echo "</tr>";
  }
  echo  "</tbody>";

}
echo "</table>";
mysqli_close($con);
?>
