<?php
require "event/FPDF/fpdf.php";
class myPDF extends FPDF
{
    public function header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(276, 5, 'EventHubs', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(276, 10, 'Eventhubs.com', 0, 0, 'C');
        $this->ln(10);
    }
    public function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    public function TableDetail()
    {
        include 'connection.php';
        $this->AddFont('angsa', '', 'angsa.php');
        $this->SetFont('angsa', '', 12);
        $this->Cell(5, 10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'c');
        $this->Cell(80, 10, iconv('UTF-8', 'TIS-620', 'EventName'), 1, 0, 'c');
        $this->Cell(20, 10, iconv('UTF-8', 'TIS-620', 'TypeEvent'), 1, 0, 'c');
        $this->Cell(30, 10, iconv('UTF-8', 'TIS-620', 'DateStart'), 1, 0, 'c');
        $this->Cell(110, 10, iconv('UTF-8', 'TIS-620', 'Location'), 1, 0, 'c');
        $this->Cell(40, 10, iconv('UTF-8', 'TIS-620', 'EventOwner'), 1, 0, 'c');
        $this->Ln();
        $c = 1;
        $EventNameSun = "";
        $result0      = mysqli_query($con, "SELECT * FROM `EventOrganizers`");
        //   var_dump($result0);
        while ($row0 = mysqli_fetch_assoc($result0)) {
            // var_dump($row0);
            // echo "<br>";
            $ID           = $row0['ID'];
            $EventNameSun = $row0['EventName'];
            //   echo "$EventNameSun";
              // echo "<br>";
            $typeE     = $row0['Type'];
            if ($typeE == 1){
              $typeE = "คอนเสริท";
            }else if ($typeE == 2){
              $typeE = "กีฬา";
            }
            else if ($typeE == 3){
              $typeE = "ประชุม สัมนา";
            }else if ($typeE == 4){
              $typeE = "งานฝีมือ";
            }
            $Location  = $row0['Location'];
            $maxCap    = $row0['MaximumCapacity'];
            $OwnerID   = $row0['EventOwnerID'];
            $EventOrganizersName   = $row0['EventOrganizersName'];
            $DateStart = DateThai($row0['DateStart']);
            $DateEnd   = DateThai($row0['DateEnd']);
            if ($EventNameSun == "") {
                $EventNameSun == "Hello";
            }
                $this->Cell(5, 10, iconv('UTF-8', 'TIS-620', $c), 1, 0, 'c');
                $this->Cell(80, 10, iconv('UTF-8//IGNORE', 'TIS-620', "$EventNameSun"), 1, 0, 'c');
                $this->Cell(20, 10, iconv('UTF-8', 'TIS-620', $typeE), 1, 0, 'c');
                $this->Cell(30, 10, iconv('UTF-8', 'TIS-620', $DateStart), 1, 0, 'c');
                $this->Cell(110, 10, iconv('UTF-8', 'TIS-620', $Location), 1, 0, 'c');
                $this->Cell(40, 10, iconv('UTF-8', 'TIS-620', $EventOrganizersName), 1, 0, 'c');
                $this->Ln();
                $c++;
        }
    }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
ob_end_clean();
$pdf->TableDetail();
$pdf->Output();
