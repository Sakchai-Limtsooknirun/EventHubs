<?php
include 'header.php';
if(isset($_GET['user'])){
    $userN = $_GET['user'];
    $meSQLWeb = "SELECT * FROM user WHERE Username='{$userN}' ";
    $userDataWeb = mysqli_query($con,$meSQLWeb);
    if ($userDataWeb == TRUE) {
        $meResultWeb = $userDataWeb->fetch_assoc();
        
?>

    <!DOCTYPE html>
    <html lang="en">
    <div align="center" class="container">
        <div  class="row">
            <h2>Profile Form</h2>
          
    <center>
        <div style="width:80%; background-color:#000000;">
    <div class="panel panel-default">
      <div class="panel-heading">  <h4 >User Profile</h4></div>
       <div class="panel-body">
           
        <div class="box box-info">
    
                <div class="box-body">
                         <div class="col-sm-6">
                         <div  align="center"> <img alt="User Pic" src="img/user/<?php echo $meResultWeb['Picture']; ?>" id="profile-image1" class="img-circle img-responsive"> 
                              
                <br><div style="color:#999;" >Avatar image</div>
                         </div>
                  <br>
                  <!-- /input-group -->
                </div>
                <div class="col-sm-6" align = "center" >
                <h3 align = "left"  style="color:#00b1b1;">Profile</h4></span>
                <h4 align = "left"  style="color:#00b1b1;">Firstname : <?php echo $meResultWeb['Firstname']; ?></h4></span>
                <h4 align = "left"  style="color:#00b1b1;">Lastname : <?php echo $meResultWeb['Lastname']; ?></h4></span>
                <h4 align = "left"  style="color:#00b1b1;">ระดับสมาชิก : <?php echo $type; ?></h4></span>
                <h4 align = "left"  style="color:#00b1b1;">E-mail : <?php echo $meResultWeb['email']; ?></h4></span>
                <h4 align = "left"  style="color:#00b1b1;">เพศ : <?php 
                                                                            if($meResultWeb['sex']){
                                                                             echo "Male" ;
                                                                            }else{echo "Female";
                                                                            echo $meResultWeb['sex'];} ?></h4></span>
                
                <h4 align = "left"  style="color:#00b1b1;">เบอร์โทรศัพท์ : <?php echo $meResultWeb['telephone']; ?></h4></span>
                <h4 align = "left"  style="color:#00b1b1;">วันที่/เวลา ที่สมัคสมาชิก : <?php echo DateThai($meResultWeb['ts']); ?></h4></span>
                <div class="clearfix"></div>
                <hr style="margin:5px 0 5px 0;">
                </div>                                                                      
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
    ?>