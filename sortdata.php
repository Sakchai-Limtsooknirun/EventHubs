<?php
include 'connection.php';
session_start();
$query = "select * from user";


if(empty($_GET['sort'])){
  $query = "select * from user";
}else{
if ($_GET['sort'] == 'ids')
{
    $query .= " ORDER BY ID ".$_GET['sun'];
}
elseif ($_GET['sort'] == 'lvs')
{
    $query .= " ORDER BY role ".$_GET['sun'];
}
elseif ($_GET['sort'] == 'users')
{
    $query .= " ORDER BY Username ".$_GET['sun'];
}
elseif($_GET['sort'] == 'names')
{
    $query .= " ORDER BY Firstname ".$_GET['sun'];
}
elseif($_GET['sort'] == 'lastnames')
{
    $query .= " ORDER BY Lastname ".$_GET['sun'];
}
elseif($_GET['sort'] == 'sexs')
{
    $query .= " ORDER BY sex ".$_GET['sun'];
}
elseif($_GET['sort'] == 'mails')
{
    $query .= " ORDER BY email " .$_GET['sun'];
}
elseif($_GET['sort'] == 'days')
{
    $query .= " ORDER BY ts ".$_GET['sun'];
}
else{
}
}


$data = mysqli_query($con,$query);



$r = "";
$r.= "<table  class='table table-hover  table-bordered' cellspacing='0' width='100%'>";

$r.= "<thead>
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
  $r .=  "<tr style='color:#260d31' align='center' style = height:50%;>";

  $r .=  "<td width='auto'>" ."<img class='img-thumbnail' width=50% height=50% src='img/user/".$row['Picture']."' alt='' width='100%'>" .  "</td> "; 
  $r .= "<td width='auto'>" .$row["ID"] .  "</td> "; 
  $r .= "<td width='auto'>" .checkType($row["Username"]) .  "</td> "; 
  $r .= "<td width='auto'>" .$row["Username"] .  "</td> ";  
  $r .="<td width='auto'>" .$row["Firstname"] .  "</td> ";
  $r .= "<td width='auto'>" .$row["Lastname"] .  "</td> ";
    if($row["sex"]=="m"){
        $r .= "<td width='auto'>" ."Male" .  "</td> ";
    }else{
        $r .= "<td width='auto'>" ."Female" .  "</td> ";
    }
    $r .= "<td width='auto'>" .$row["email"] .  "</td> ";
    $r .= "<td width='auto'>" .$row["ts"] .  "</td> ";
    $r .= "<td width='auto'class='btn btn-default' style = margin-top:10px; ><a href='adminEdit.php?IDedit=$row[0]'>Edit</a></td> ";
    if($row["Username"]!= $_SESSION["Username"]){
        $r .= "<td width='auto' class='btn btn-danger' style = margin-top:10px;><a  href='UserDelete.php?IDedit=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">Del</a></td> ";
        $r .= "</tr>";
    }
    $r .=  "</tbody>";
    
    }
    $r .=  "</table>";

echo $r;
mysqli_close($con);

?>

