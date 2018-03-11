<?php
include('phpqrcode/qrlib.php');
// QRcode::png('your message here...');   //input
//echo '<img src="example_001_simple_png_output.php" />';

//----------------บนโชว์แค่รูป ------------ล่างเซฟรูปด้วย
echo gen_QRpic("dawdwa","test3");
function gen_QRpic($strmasg,$strFNAME){
 $tempDir = "img/qrcode/";
 $codeContents = $strmasg;   //inputtext
 //$fileName = uniqid('QR', true) . '.png';  //filenameUniqid
 $fileName = $strFNAME.'.png' ;  //filename
 $pngAbsoluteFilePath = $tempDir.$fileName;
 //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
 if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        //echo '<img src="'.$tempDir.$fileName.'" />';
        return 'File generated!';
    } else {
        return 'File already generated! We can use this cached file to speed up site on common codes!';
    }
  }



?>
