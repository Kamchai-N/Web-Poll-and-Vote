
<?php
    session_start();
    $topic_ID = $_GET['topic_ID'];
    $topic_text = $_GET['topic_text'];
    $User_ID = $_GET['User_ID'];
    $con = mysqli_connect('localhost','root','123456789','web_vote');
    if(!$con){
         exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
    }
    mysqli_set_charset($con,"utf8");
    require_once('../../lib/fpdf181/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddFont('angsana','','angsab.php');    
    $pdf->AddPage();
    $pdf->Image('../../AI/icon-01.png',90,20,-300);
    $pdf->SetFont('angsana','',25);
    $pdf->setXY(60 , 45);
    $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' , $topic_text ) );
    $sql = "SELECT * FROM `vote_topic` WHERE `topic_ID` = $topic_ID";
    $query = mysqli_query($con,$sql);
    while($data  = mysqli_fetch_array($query)){
        $date1=date_create("$data[4]");
        $f = date_format($date1,"d-m-Y");
        $pdf->SetFont('angsana','',20);
        $pdf->setXY(20, 60);
        $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' , 'เมื่อวันที่ '.$f.' ถึง '.Date("d-m-Y")) );
    }
    $pdf->SetFont('angsana','',20);
    $pdf->setXY(30, 80);
    $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' ,'รายการ') );
    $pdf->SetFont('angsana','',20);
    $pdf->setXY(180, 80);
    $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' , 'คน') );
    $sql = "SELECT * FROM `vote_choice` WHERE `topic_ID` = $topic_ID";
    $query = mysqli_query($con,$sql); 
    $c =100;
    $s = 1;
    while($data  = mysqli_fetch_array($query)){
        $pdf->SetFont('angsana','',20);
        $pdf->setXY(30, $c);
        $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' , $s .'.  '. $data[2]));
        $pdf->SetFont('angsana','',20);
        $pdf->setXY(180, $c);
        $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' ,$data[3]));
        $s = $s + 1;
        $c += 10;
    }
    $pdf->SetFont('angsana','',20);
    $pdf->setXY(30, 200);
    $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' , '--------------------------------------------------------------------------------------------------'));
    $pdf->SetFont('angsana','',20);
    $pdf->setXY(85, 210);
    $pdf->MultiCell( 0  , 0 , iconv( 'UTF-8','cp874' ,'รับรองข้อมูลโดย Vote.com'));
    
    $pdf->Output();
?>
