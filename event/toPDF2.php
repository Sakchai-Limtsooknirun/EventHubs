<?php

require "fpdf.php";

class myPDF extends FPDF{
    function header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(276,5,'BOOM',0,0,'C');
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
        $this->SetFont("Times",'B',12);
        $this->AddFont('angsa','','angsa.php');

        $this->SetFont('angsa','',18);

        $this->Cell(15,10,iconv( 'UTF-8','TIS-620','ลำดับ'),1,0,'c');
        $this->Cell(50,10,iconv( 'UTF-8','TIS-620','ชื่อ นามสกุล'),1,0,'c');
        $this->Cell(40,10,iconv( 'UTF-8','TIS-620','ประเภทบัตร'),1,0,'c');
        $this->Cell(40,10,iconv( 'UTF-8','TIS-620','ราคา'),1,0,'c');
        $this->Cell(40,10,iconv( 'UTF-8','TIS-620','สถานะ'),1,0,'c');
        $this->Cell(50,10,iconv( 'UTF-8','TIS-620','email'),1,0,'c');
        $this->Cell(40,10,iconv( 'UTF-8','TIS-620','เบอร์โทรศัพท์'),1,0,'c');

        $this->Ln();
    }

    funtion TableDetail($EventID){


    }
}
$pdf = new  myPDF();

$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->Output();
$EventID=2;






?>
