<?php




require "event/FPDF/fpdf.php";

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


    function TableDetail(){
      include 'connection.php';
      $this->AddFont('angsa','','angsa.php');
      $this->SetFont('angsa','',18);


             
      $this->Cell(12,10,iconv( 'UTF-8','TIS-620','ID'),1,0,'c');
      $this->Cell(60,10,iconv( 'UTF-8','TIS-620','EventName'),1,0,'c');
      $this->Cell(40,10,iconv( 'UTF-8','TIS-620','type'),1,0,'c');
      $this->Cell(30,10,iconv( 'UTF-8','TIS-620','DateStart'),1,0,'c');
      $this->Cell(30,10,iconv( 'UTF-8','TIS-620','DateEnd'),1,0,'c');
      $this->Cell(40,10,iconv( 'UTF-8','TIS-620','Location'),1,0,'c');
      $this->Cell(12,10,iconv( 'UTF-8','TIS-620','MaximumCapacity'),1,0,'c');
      $this->Cell(40,10,iconv( 'UTF-8','TIS-620','EventOwner'),1,0,'c');

      $this->Ln();






      $EventNameSun ="";
      $result0 = mysqli_query($con, "SELECT * FROM `EventOrganizers`");
    //   var_dump($result0);
      while($row0 = mysqli_fetch_assoc($result0)){
        // var_dump($row0);
        // echo "<br>";
      $ID  = $row0['ID'];
      $EventName = $row0['EventName'];
    //   echo "$EventName";
    //   echo "<br>";
      
      $typeE = $row0['Type'];
      $Location = $row0['Location'];
      $maxCap  =$row0['MaximumCapacity'];
      $OwnerID  =$row0['EventOwnerID'];
      $DateStart = DateThai($row0['DateStart']);
      $DateEnd = DateThai($row0['DateEnd']);
        
      $result1 = mysqli_query($con, "SELECT * FROM user WHERE ID = $OwnerID");
      while($row1 = mysqli_fetch_assoc($result1)){
    $OwnnerName = $row1['Firstname']." ".$row1['Lastname'];

                       
      $this->Cell(12,10,iconv( 'UTF-8','TIS-620',$ID),1,0,'c');
      $this->Cell(60,10,iconv( 'UTF-8//IGNORE','TIS-620',$EventName),1,0,'c');
      $this->Cell(40,10,iconv( 'UTF-8','TIS-620',$typeE),1,0,'c');
      $this->Cell(30,10,iconv( 'UTF-8','TIS-620',$DateStart),1,0,'c');
      $this->Cell(30,10,iconv( 'UTF-8','TIS-620',$DateEnd),1,0,'c');
      $this->Cell(40,10,iconv( 'UTF-8','TIS-620',$Location),1,0,'c');
      $this->Cell(12,10,iconv( 'UTF-8','TIS-620',$maxCap),1,0,'c');
      $this->Cell(40,10,iconv( 'UTF-8','TIS-620',$OwnnerName),1,0,'c');

      $this->Ln();
      }
    }
}
}


$pdf = new  myPDF();

$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->TableDetail();
ob_end_clean();
$pdf->Output();








?>