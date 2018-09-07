<?php
    session_start();
    $topic_ID = $_GET['topic_ID'];
    $topic_text = $_GET['topic_text'];
    $User_ID = $_GET['User_ID'];
    require_once('../../lib/fpdf181/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Times','B',20);
    $pdf->Cell(0,20,'Vote.com',0,1,"C");;
    $pdf->Output();
?>