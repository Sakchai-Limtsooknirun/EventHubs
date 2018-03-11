<?
$path    = basename(realpath(__DIR__ . '/..'));
echo "<base href='/$path/'>";
include '../header.php';
$usernameID = ownerID($username);
if ($type == "NotLogin") {
    echo "<script type='text/javascript'>";
    echo "window.location = 'form_login.php?st=3'; ";
    echo "</script>";
    exit;
}else if ($type == "Organizer"){ //--------------------- Organizer ------------------------
?>


<body>

    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain webboard">
        <?
  $phpArray = array();
        $result = mysqli_query($con, "SELECT * FROM `EventOrganizers` WHERE `EventOwnerID` = '$usernameID'");
        while ($row = mysqli_fetch_assoc($result)) {
            $status = 1;
            $EventName = $row['EventName'];
            $EventStatus = $row['EventStatus'];
            $ID = $row['ID'];
            $Location = $row['Location'];
            $DateB = $row['DateStart'];
            $DateEnd = $row['DateEnd'];
            $DateStart = DateThai($row['DateStart']);
            $CapacityNow = $row['CapacityNow'];
            $MaximumCapacity = $row['MaximumCapacity'];
            $Picture = $row['Picture'];
            $ShortURL = $row['ShortURL'];
            // $ShortURL = $actual_link = "http://$_SERVER[HTTP_HOST]/".$path."/eventview/".$ShortURL;
            $Detail     = trim($row['Detail']);
            $Detail     = preg_replace("/\r\n|\r/", "<br />", $Detail);
            $Detail     = nl2br($Detail);
            $Precondition = $row['PreCondition'];
            $Price = $row['Price'];
            $Color = $row['ColorTone'];
            $EventOrgName = $row['EventOrganizersName'];
            $EventContactTell = $row['EventContactTell'];
            $EventContactEmail = $row['EventContactEmail'];
            $EventFacebook = $row['EventFacebook'];
            $Type= $row['Type'];
            $resultTicket = mysqli_query($con, "SELECT * FROM `EventTicket` WHERE `EventID` = '$ID'");
            $i=0;
            while ($row2 = mysqli_fetch_assoc($resultTicket)) {
                $phpArray[$EventName.$i]=$row2['TicketName'];
                $phpArray[$EventName."P".$i]=$row2['TicketPrice'];
                $i+=1;
            }
            $SetModals = sprintf('onclick="SetModal(\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%.187s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\')"',$type,$EventName,$EventStatus,$ID,$Location,$DateB,$DateEnd,$CapacityNow,$MaximumCapacity,$Picture,$ShortURL,$Detail,$Precondition,$Price,$Color,$EventOrgName,$EventContactTell,$EventContactEmail,$EventFacebook,$phpArray);
            $checkcap = sprintf('onclick="CheckCap()"');
            echo "
<div class='eventCard'>
    <div class='eventTopic'>
        <p>$EventName</p>
        <p id='eventStatus'>สถาณะ : $EventStatus</p>
    </div>
    <div class='col-lg-4'>
        <img src='img/event/$Picture' alt='' width='100%'>
    </div>
    <div class='col-lg-8'>
        <p id='eventInfo'><span class='glyphicon glyphicon-pushpin'></span> $Location</p>
        <p id='eventInfo'><span class='glyphicon glyphicon-calendar'></span> $DateStart</p>
        <p id='eventInfo'><span class='glyphicon glyphicon-link'></span> <a href='$ShortURL' target='_blank'>$ShortURL</a></p>
        <p id='eventInfo'><span class='glyphicon glyphicon-user'></span> $CapacityNow / $MaximumCapacity คน</p>
        <br>";
        echo "
      <span>  <a  type='button' class='btnlogin' data-toggle='modal' data-target='#myModal' ".$SetModals."   >จัดการ</a>
        <a  class='btnlogin'  href='event/memberediter.php?eid= $ID '>ดูแลสมาชิก</a></span>
    </div>
</div>
            ";
        }
        if ($status != 1) {
            echo "
            <p id='notfound'>ไม่มีกิจกรรม</p>
            <p id='notfound'><a href='#'>สร้างกิจกรรมใหม่</a></p>";
        } else {
        }
        ?>







    <script>
    var index = 0 ;
    function CheckType(Type){
      if(Type==1){
        type="งานปาร์ตี้คอนเสิร์ตและเทศกาล";
      }
      else if(Type==2){
        type="กีฬา";
      }
      else if(Type==2){
        type="การประชุมอบรมและสัมมนา";
      }
      else{
        type="ชั้นเรียนและงานฝีมือ";
      }
      return type;
    }
      function SetModal(Type,EventName,EventStatus,ID,location,DateStart,DateEnd,CapacityNow,MaximumCapacity,Picture,ShortURL,Detail,Precondition,Price,Color,EventOrgName,EventContactTell,EventContactEmail,EventFacebook,phpArray){
        var jArray= <?php echo json_encode($phpArray ); ?>;
          i=0
          while(!isEmpty(jArray[EventName+i])){
            // alert(jArray[EventName+i]+"    :     "+jArray[EventName+"P"+i]);
            add_fields(jArray[EventName+i],jArray[EventName+"P"+i],EventName,i);
            index = i;
            i+=1;
          }
        console.log(Picture+"      IMG");
        console.log(DateStart+" DATE BEFORE ");
        EventStatus=CheckStatus(EventStatus);
        console.log(EventStatus + "       THIS IS  STASUS");
        Type = CheckType(Type);
        console.log(Type+"  THIS IS TYPE");
         document.getElementById("eventname").setAttribute('value',EventName);
         document.getElementById("status").setAttribute('value',EventStatus);
         document.getElementById("type").setAttribute('value',Type);
         document.getElementById("detail").value = Detail;
         document.getElementById("ID").value = ID;
         document.getElementById("location").setAttribute('value',location);
         document.getElementById("date").value = DateStart;
         setDate(DateStart,'date','time');
        setDate(DateEnd,'dateEnd','timeEnd');
         document.getElementById("capacity").setAttribute('value',MaximumCapacity);
         document.getElementById("capacitynow").setAttribute('value',CapacityNow);
         document.getElementById("picture").setAttribute('value',Picture);
         document.getElementById("url").setAttribute('value',ShortURL);
          document.getElementById("precondition").setAttribute('value',Precondition);
          document.getElementById("color").setAttribute('value',Color);
           document.getElementById("ownname").setAttribute('value',EventOrgName);
            document.getElementById("tell").setAttribute('value',EventContactTell);
             document.getElementById("email").setAttribute('value',EventContactEmail);
              document.getElementById("facebook").setAttribute('value',EventFacebook);
         // console.log(DateStart + "  asdasdasdasd");
         // console.log(DateStart + "  asdasdasdasd");
      }
      function CheckCap(){
        console.log(" < < < < < < < < < < < < << < < < <  < < <YEE PAP ");
        alert("aslhljashdjhasd");
      }
      function CheckStatus(Status){
        if(Status==0){
          Status="อนุมัติ";
        }
        else{
          Status="รอการอนุมัติ";
        }
        return Status;
      }
      function setDate(oldDate,date1,time1){
        console.log(oldDate + "    DATE FUNC" );
        console.log(date1+"      DATE ! B");
        console.log(time1+"   TIME B");
        if(!isEmpty(oldDate)){
        var date = oldDate.split("-");
        var year = date[0];
        var time = oldDate.split(" ")[1];
        console.log(year+"   YEAR");
        var month = date[1];
        var day = date[2].split(" ")[0];
        da = year+"-"+month+"-"+day;
        document.getElementById(date1).value = da;
        console.log(da+ ":DATEEEE");
        document.getElementById(time1).value = time;
      }
        // document.getElementById("dateEnd").value = da;
        // document.getElementById("timeEnd").value = "18:00:00";
      }
      function isEmpty(str) {
        console.log(!str || 0 === str.length);
    return (!str || 0 === str.length);
}
function add_fields(Type,Price,EventName,i) {
    var objTo = document.getElementById('Tickets')
    var divtest = document.createElement("div");
    console.log(Type+"   TTTTT");
    console.log(Price+"       PPPPPP");
    divtest.innerHTML = '<div  >ประเภทของบัตร <input class="form-control  " type="text" style="width:200px;" name="TT[]" value="'+Type+'"'+' /> ราคาของบัตร <input  class="form-control" type="text" style="width:200px;" namae="TT[]" value="'+Price+'"'+' /></div><hr>';
    objTo.appendChild(divtest)
}
</script>
    </script>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="form-group">
                <tr>




                </tr>
            </div>
            <h4 class="modal-title" id="modalform">แก้ไข</h4>
          </div>
          <div class="modal-body">
            <form name="EventEdit"  method="post" action="event/eventediter.php" enctype="multipart/form-data">

            <br>ชื่อกิจกรรม <input id="eventname"  type="text" size="40" class="form-control" name="name"   required/>
            <br>สถานะกิจกรรม <input id="status"  type="text" size="40" class="form-control" name="status" readonly="readonly" required/>
            <br>รหัสกิจกรรม <input id="ID" type="text" size="40" class="form-control" name="id" readonly="readonly"   required/>


            <br>สถานะกิจกรรม <input id="type"  type="text" size="40" class="form-control" name="type" readonly="readonly" required/>

            <br>สถานที่ตั้ง <input id="location" type="text" size="40" class="form-control" name="location"   required/>
            <br>รายละเอียด<textarea id= 'detail' name="detail" rows="12" cols="120" class="form-control" name="detail" ></textarea>
            <br>วันที่เริ่มกิจการ <input id="date" type="date" class="form-control" name="dates" required/>
            <br>  เวลา <input id="time" type="time" class="form-control" name="times" required/>
            <br>  วันที่หมดกิจกรรม <input id="dateEnd" type="date" class="form-control" name="datee" required/>
            <br>  เวลา <input id="timeEnd" type="time" class="form-control" name="timee" required/>




            <div id="ticket">
            <br><button type="button" class="btn btn-default" onclick="add_fields();" >Add Tickets</button><br>
            <div  id="Tickets">


            </div>


            </div>
            <br>  คุณสมบัติที่ต้องมีก่อนเข้าร่วมกิจกรรม(มีหรือไม่มีก็ได้) <input id="precondition" type="text" class="form-control" name="precondition" >
            <br>  จำนวนผู้เข้าร่วมสูงสุด<input id="capacity" style="color:#260d31" type="number" size="40" class="form-control" min="0" name="capmax"  required>
            <br>  จำนวนผู้เข้าร่วม ณ เวลานั้น<input id="capacitynow" style="color:#260d31" type="number" size="40" class="form-control"  readonly="readonly" name="capnow" required>
            <br>  รูปภาพ<input id="picture" type="file" name="picture1" accept="image/*">
            <br>  วีดีโอ <input id="video" style="color:#260d31" type="text" name="video" accept="image/*"  size="40" >
            <br>  ShoerURL :<input id="url" style="color:#260d31" type="text" size="40"  class="form-control" name="url" readonly="readonly" required >
            <br><label>โทนสีเว็บ</label>
            <br>  <input type="text" id="color" class="form-control"  name="color">
            <br><label>ชื่อผู้จัดงาน</label>
            <br>  <input type="text" id="ownname" class="form-control" name="ownname" >
            <br>  <label>เบอร์ติดต่อผู้จัด</label>
            <br>  <input type="text" id="tell" class="form-control" name="tell" >
            <br>  <label>E-mail ติดต่อผู้จัด</label>
            <br>  <input type="email" id="email" class="form-control" name="email">
            <br>  <label>Facebook กิจกรรม</label>
            <br>  <input type="text" id="facebook" class="form-control" name="facebook">


        </div>
          <div class="modal-footer">
          <tr>

            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="#myModal">Done</button>
              <button type="submit" class="btn btn-default" '.$checkcap.' data-target="#myModal">Confirm</button>

            </tr>
          </div>
          </form>


        </div>
      </div>
    </div>
  </div>

</body>


<? //------------------------------------------
}
else {
?>
<body>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 contain">
            <p>Error</p>
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	</div>


</body>
		<?
}
?>

<head>
    <meta charset="UTF-8">
    <title>Eventhubs | จัดการกิจกรรม</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

</head>
