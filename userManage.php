<?php
include 'header.php';
$query = "select * from user";
$data = mysqli_query($con,$query);

echo "<table class = 'table-hover table' border='1' align='center' width='auto'>";
//ัวข้อตาราง
echo "<tr align='center' bgcolor='#CCCCCC'>
      <td>Profile</td>
      <td>รหัส</td>
      <td>ระดับสมาชิก</td>
      <td>Uername</td>
      <td>ชื่อ</td>
      <td>นามสกุล</td>
      <td>อีเมล์</td>
      <td >วันที่สมัคร</td>
      <td>แก้ไข</td>
      <td>ลบ</td>
      </tr>";
while($row = $data->fetch_array()) { 
  echo "<tr align='center'>";
  
  echo "<td width='auto'>" ."<img src='img/user/".$row['Picture']."' alt='' width='100%'>" .  "</td> "; 
  echo "<td width='auto'>" .$row["ID"] .  "</td> "; 
  echo "<td width='auto'>" .checkType($row["Username"]) .  "</td> "; 
  echo "<td width='auto'>" .$row["Username"] .  "</td> ";  
  echo "<td width='auto'>" .$row["Firstname"] .  "</td> ";
  echo "<td width='auto'>" .$row["Lastname"] .  "</td> ";
  echo "<td width='auto'>" .$row["email"] .  "</td> ";
  echo "<td width='auto'>" .$row["ts"] .  "</td> ";
  //แก้ไขข้อมูล
  echo "<td width='auto' ><a href='adminEdit.php?IDedit=$row[0]'>Edit</a></td> ";
  
  //ลบข้อมูล
  if($row["Username"]!= $_SESSION["Username"]){
  echo "<td width='auto' ><a  href='UserDelete.php?IDedit=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">Del</a></td> ";
  echo "</tr>";
  }
}
echo "</table>";
mysqli_close($con);
?>
