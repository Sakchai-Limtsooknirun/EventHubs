<?php

$EventID=$_GET['EventID'];


require "./FPDF/fpdf.php";

class myPDF extends FPDF{
    function header(){

        $this->SetFont('Arial','B',12);
        $this->Cell(276,5,'EventHubs',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Eventhubs.com',0,0,'C');




        $this->ln(10);

    }


    function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page ' .$this->PageNo().'/{nb}',0,0,'C' );
    }


    function TableDetail($EventID){
      include '../connection.php';
      $this->AddFont('angsa','','angsa.php');
      $this->SetFont('angsa','',18);

      $result0 = mysqli_query($con, "SELECT * FROM `EventOrganizers`  WHERE ID = $EventID ");
      $row0 = mysqli_fetch_assoc($result0);
      $EventName  = $row0['EventName'];
      $Location = $row0['Location'];



      $DateStart = DateThai($row0['DateStart']);
      $DateEnd = DateThai($row0['DateEnd']);
      $this->Cell(276,10,iconv( 'UTF-8','TIS-620','รายชื่อคนที่เข้าร่วมกิจกรรม'.$EventName),0,0,'C');
      $this->Ln();
      $this->Cell(276,10,iconv( 'UTF-8','TIS-620','เวลา : '.$DateStart.' - '.$DateEnd),0,0,'C');
      $this->Ln();
      $this->Cell(276,10,iconv( 'UTF-8','TIS-620','สถานที่ : '.$Location),0,0,'C');
      $this->Ln();





        $this->Cell(12,10,iconv( 'UTF-8','TIS-620','ลำดับ'),1,0,'c');
        $this->Cell(50,10,iconv( 'UTF-8','TIS-620','ชื่อ นามสกุล'),1,0,'c');
        $this->Cell(60,10,iconv( 'UTF-8','TIS-620','ประเภทบัตร'),1,0,'c');
        $this->Cell(20,10,iconv( 'UTF-8','TIS-620','ราคา'),1,0,'c');
        $this->Cell(40,10,iconv( 'UTF-8','TIS-620','สถานะ'),1,0,'c');
        $this->Cell(50,10,iconv( 'UTF-8','TIS-620','email'),1,0,'c');
        $this->Cell(40,10,iconv( 'UTF-8','TIS-620','เบอร์โทรศัพท์'),1,0,'c');


        $this->Ln();













      $this->SetFont("Times",'B',12);
      $this->AddFont('angsa','','angsa.php');

      $result = mysqli_query($con, "SELECT * FROM `EventTicket`  WHERE EventID = $EventID ");
      $no = 1 ;
       while ($row = mysqli_fetch_assoc($result)) {
         $disabled;
         $TicketID=$row['TicketID'];
         $TicketName=$row['TicketName'];
         $TicketPrice=$row['TicketPrice'];




         $result2 = mysqli_query($con, "SELECT * FROM `EventHandler`  WHERE TicketID = $TicketID ");
         while ($row2 = mysqli_fetch_assoc($result2)) {

           $OwnerID = $row2['OwnerID'];
           $BuyTime = $row2['CardSBuyTime'];
           $Status = CheckStatus($row2['CardStatus']);
           $Token = $row2['CardToken'];
           if($row2['CardStatus']!=1){
             $disabled = "disabled";
           }



           $result3 = mysqli_query($con, "SELECT * FROM `user`  WHERE ID = $OwnerID ");

           while ($row3 = mysqli_fetch_assoc($result3)) {

             $Firstname = $row3['Firstname'];
             $LastName = $row3['Lastname'];
             $Email = $row3['email'];
             $Phone = $row3['telephone'];





             $this->SetFont('angsa','',16);
             $this->Cell(12,10,iconv( 'UTF-8','TIS-620',$no),1,0,'c');
             $this->Cell(50,10,iconv( 'UTF-8','TIS-620',$Firstname." ".$LastName),1,0,'c');
             $this->Cell(60,10,iconv( 'UTF-8','TIS-620', $TicketName),1,0,'c');
             $this->Cell(20,10,iconv( 'UTF-8','TIS-620',$TicketPrice),1,0,'c');
             $this->Cell(40,10,iconv( 'UTF-8','TIS-620','ยืนยันเรียบร้อย'),1,0,'c');
             $this->Cell(50,10,iconv( 'UTF-8','TIS-620',$Email),1,0,'c');
             $this->Cell(40,10,iconv( 'UTF-8','TIS-620',$Phone),1,0,'c');
             $this->Ln();

           $no += 1;



           }


         }
       }







    }


}

$pdf = new  myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->TableDetail($EventID);
ob_end_clean();
$pdf->Output();








?>
