<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 07-Jul-17
 * Time: 12:59 PM
 */

if(isset($_POST["generate"])){
    $startDate = new DateTime($_POST["startDate"]);
    $finishDate = new DateTime($_POST["finishDate"]);
    $finishDate = $finishDate->modify( '+1 day' );
    //echo strtotime($startDate)." ".strtotime($finishDate)."br /";
    $interval = DateInterval::createFromDateString('1 day');
    $period =new DatePeriod($startDate,$interval,$finishDate);
    foreach ($period as $dt){
        $date = $dt->format("Y-m-d");
        echo $date."<br />";
        for ($i=0;$i,10;$i++){
            $sql = "Select date_of_borrowal,book_title from book_sessions where date_of_borrowal = $date and ";
    }}
}

?>
