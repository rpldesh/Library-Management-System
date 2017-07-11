<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 07-Jul-17
 * Time: 12:59 PM
 */

$startDate="";
$finishDate="";


if(isset($_POST["generate"])){
    include("../database.php");
    include("../table.php");
    include("../book_session.php");
    require('../fpdf181/fpdf.php');
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');

    $startDate = new DateTime($_POST["startDate"]);
    $finishDate = new DateTime($_POST["finishDate"]);
    $lastDate = $finishDate;
    $finishDate = $finishDate->modify( '+1 day' );

    $pdf = new FPDF();
    $bs = new book_session();
    $pdf->AddPage();
    $topic = "Daily Circulation Report ( ".date_format($startDate,'Y-m-d')." - ".($_POST["finishDate"])." ) ";
    $cat=array("000-099","100-199","200-299","300-399","400-499","500-599","600-699","700-799","800-899","900-999");
    $pdf->SetFont("Arial","B",16);
    $pdf->Cell(190,20,$topic,1,1,"C",0,0);
    $pdf->Cell(35,20,"Date",1,0,"C");
    $pdf->Cell(155,10,"Category No.",1,1,"C");
    $pdf->Cell(35,10,"",0,0);
    $pdf->SetFont("Arial","",10);
    for($i=0;$i<10;$i++){
        $pdf->Cell(14,10,$cat[$i],1,0,"C");
    }
    $pdf->Cell(15,10,"Total",1,1,"C");
    $interval = DateInterval::createFromDateString('1 day');
    $period =new DatePeriod($startDate,$interval,$finishDate);
    foreach ($period as $dt){
        $date = $dt->format("Y-m-d");
        $pdf->Cell(35,10,$date,1,0);
        $count=0;
        for ($i=0;$i<10;$i++){
            $sql = "Select book_title from book_sessions where date_of_borrowal = '$date' and category_no like '$i%'";
            $result = $bs->featuredLoad($dbObj,$sql);
            $numOfRows = mysqli_num_rows($result);
            $count+=$numOfRows;
            $pdf->Cell(14,10,$numOfRows,1,0,"C");
            }$pdf->Cell(15,10,$count,1,1,"C");
    }$pdf->Output();
    $dbObj->closeConnection();
}


?>
