<?php
include '../header.php';
if(isset($_GET['eid'])&&isset($_GET['estatus'])){
    $id = $_GET['eid'];
    $status = $_GET['estatus'];
    $mesql = "";
    if($status==0){
        
        $mesql = "UPDATE EventOrganizers SET EventStatus = 1 WHERE ID = '{$id}'";
    }elseif($status==1){
    
        $mesql = "UPDATE EventOrganizers SET EventStatus = 0 WHERE ID = '{$id}'";
    }
    $userData = mysqli_query($con,$mesql);
    if($userData){
        echo "<script type='text/javascript'>";
        echo "window.location = 'index.php'; ";
        echo "</script>";
        mysqli_close($con);
    }
}else{
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'; ";
    echo "</script>";
}



?>