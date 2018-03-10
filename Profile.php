<?php
include 'header.php';
if ($_SESSION["Username"] == $username){
    $meSQL = "SELECT * FROM user WHERE Username='{$_SESSION["Username"]}' ";
    $userData = mysqli_query($con,$meSQL);
    if ($userData == TRUE) {
        $meResult = $userData->fetch_assoc();
        
  
?>

<!DOCTYPE html>
<html lang="en">
<div align="center" class="container">
	<div  class="row">
		<h2>Profile Form</h2>
      
<center>
    <div style="width:80%; background-color:#000000;">
<div class="panel panel-default">
  <div class="panel-heading">  <h4 >Username : <?php echo $meResult['Username']; ?></h4></div>
   <div class="panel-body">
       
    <div class="box box-info">

            <div class="box-body">
                     <div class="col-sm-6">
                     <div  align="center"> <img alt="User Pic" src="img/user/<?php echo $meResult['Picture']; ?>" id="profile-image1" class="img-circle img-responsive"> 
                          
            <br><div style="color:#999;" >Avatar image</div>
                     </div>
              <br>
              <!-- /input-group -->
            </div>
            <div class="col-sm-6" align = "center" >
            <h3 align = "left"  style="color:#00b1b1;">Profile</h4></span>
            <h4 align = "left"  style="color:#00b1b1;">Firstname : <?php echo $meResult['Firstname']; ?></h4></span>
            <h4 align = "left"  style="color:#00b1b1;">Lastname : <?php echo $meResult['Lastname']; ?></h4></span>
            <h4 align = "left"  style="color:#00b1b1;">ระดับสมาชิก : <?php echo $type; ?></h4></span>
            <h4 align = "left"  style="color:#00b1b1;">E-mail : <?php echo $meResult['email']; ?></h4></span>
            <h4 align = "left"  style="color:#00b1b1;">เพศ : <?php 
                                                                        if($meResult['sex']){
                                                                         echo "Male" ;
                                                                        }else{echo "Female";
                                                                        echo $meResult['sex'];} ?></h4></span>
            
            <h4 align = "left"  style="color:#00b1b1;">เบอร์โทรศัพท์ : <?php echo $meResult['telephone']; ?></h4></span>
            <h4 align = "left"  style="color:#00b1b1;">วันที่/เวลา ที่สมัคสมาชิก : <?php echo DateThai($meResult['ts']); ?></h4></span>
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
            </div>                                                                      
            
            <input align = "center" class="btn btn-primary" type="button" style="color:#260d31" value="Edit Profile" onclick="window.location.href='Edit.php'" />
            
                          
            
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">   
   </div>

</div>

</center>

</html> 

<?php
    }
    
}else{
    echo "<script type='text/javascript'>";
    echo "window.location = 'signup.php'; ";
    echo "</script>";
}
mysql_close();
?>


    