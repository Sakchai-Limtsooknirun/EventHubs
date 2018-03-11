<?php
include '../connection.php';

require "fpdf.php";

if(!empty($_GET)){
    $EventID = $_GET['EventID'];

    $result0 = mysqli_query($con, "SELECT * FROM `EventOrganizers`  WHERE ID = $EventID ");
    $row0 = mysqli_fetch_assoc($result0);
    $EventName  = $row0['EventName'];
    $Location = $row0['Location'];
    $CapMax = $row0['MaximumCapacity'];
    $CapNow = $row0['CapacityNow'];
  }


class myPDF extends FPDF{


    function header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(276,5,'$str',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'BOOMINNNNN',0,0,'C');
        $this->ln(20);

    }


    function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page ' .$this->PageNo().'/{nb}',0,0,'C' );
    }
    function headerTable(){
        $this->SetFont("times",'B',12);
        $this->Cell(50,10,'ลำดับ',1,0,'L');
        $this->Cell(50,10,'ชื่อจริง',1,0,'c');
        $this->Cell(50,10,'นามสกุล',1,0,'c');
        $this->Cell(50,10,'ประเภทของตั๋ว',1,0,'c');
        $this->Cell(50,10,'Sex',1,0,'c');
        $this->Cell(50,10,'QR',1,0,'c');
        $this->Cell(50,10,'CO',1,0,'c');
        $this->Ln();
    }


    function TableDetail($con,$EventID){

      $result = mysqli_query($con, "SELECT * FROM `EventTicket`  WHERE EventID = $EventID ");
      $no = 1 ;
       while ($row = mysqli_fetch_assoc($result)) {
         $disabled;
         $TicketID=$row['TicketID'];
         $TicketName=$row['TicketName'];
         $TicketPrice=$row['TicketPrice'];




         $result2 = mysqli_query($con, "SELECT * FROM `EventHandler`  WHERE TicketID = $TicketID AND CardStatus =2");
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


             $this->Cell(20,10,$Firstname,1,0,'c');
             $this->Cell(40,10,$LastName,1,0,'L');
             $this->Cell(40,10,$OwnerID,1,0,'L');
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
$pdf->headerTable();
$pdf->TableDetail($con,$EventID);

$pdf->Output();



  function CheckStatus($Status){
    if($Status == 0){
      return "รอการชำระเงิน";
    }
    else if($Status == 1){
      return "ชำระเงินเรียบร้อย";
    }
    else if($Status == 2){
      return "ยืนยันเรียบร้อย";
    }
    else if($Status == 3){
      return "ยกเลิก";
    }
  else{
      return "เข้าร่วมงานเรียบร้อย";
    }
  }













 ?>
