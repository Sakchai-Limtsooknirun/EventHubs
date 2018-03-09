<?php
include 'header.php';
?>

<html>
<head>
</head>
<body>
<form name="form1" method="post" action="SendPassword.php">
  Forgot your password? (Input Username or Email)<br><br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td> Email</td>
        <td><input name="txtEmail" type="text" id="txtEmail">
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <input type="submit" name="btnSubmit" value="Send Password">
</form>
</body>
</html>