
/////////=======================================
<?php
include '../header.php';


?>

<body>


<script src="//code.jquery.com/jquery.js"></script>

<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
</div>



<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard " >
  <div class='col-sm-3'></div>
  <div class='col-sm-6'>
<form action="test.php" method="post">
<div id="item">
  <input type="button" value="เพิ่มประเภทบัตร" id="add" class="btn btn-default" >

  </div>
  <input type="submit" value="ยืนยัน" class="btn btn-default">



</form>
</div>
</div>
</body>


<script>


  $("#add").click(function(){
    event.preventDefault()
    console.log("asdlhasjdh");
    // var boom = document.getElementById('iten')

    
    $('#item').append('<div>ประเภทบัตร<input class="form-control"  type="text" name="typecard[]" required>ราคาบัตร<input class="form-control" type="number" name="cardprice[]" required>ความจุ<input class="form-control" type="number" name="quan[]" required>'+'<br><input type="button" class="btn btn-default" value="ลบบัตรนี้" onclick="$(this).parent(\'div\').remove();" /></div><br>');


  });












</script>
