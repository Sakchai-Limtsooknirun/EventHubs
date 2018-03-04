<?php
include 'header.php';
$query = "select * from user";
$data = mysqli_query($con,$query);

echo "<table border='1' align='center' width='500'>";
//หัวข้อตาราง
echo "<tr align='center' bgcolor='#CCCCCC'><td>รหัส</td><td>Uername</td><td>ชื่อ</td><td>นามสกุล</td><td>อีเมล์</td><td>วันที่สมัคร</td><td>แก้ไข</td><td>ลบ</td></tr>";
while($row = $data->fetch_array()) { 
  echo "<tr>";
  echo "<td>" .$row["ID"] .  "</td> "; 
  echo "<td>" .$row["Username"] .  "</td> ";  
  echo "<td>" .$row["Firstname"] .  "</td> ";
  echo "<td>" .$row["Lastname"] .  "</td> ";
  echo "<td>" .$row["email"] .  "</td> ";
  echo "<td>" .$row["ts"] .  "</td> ";
  //แก้ไขข้อมูล
  //echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
  
  //ลบข้อมูล
  //echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
  echo "</tr>";
}
echo "</table>";
//5. close connection
mysqli_close($con);
?>

