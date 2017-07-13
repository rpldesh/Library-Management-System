<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 13-Jul-17
 * Time: 1:35 AM
 */

function calculateFine($dateToBeReturned){
    $startDate = strtotime($dateToBeReturned);
    $endDate = time();
    $noOfDays = ceil(abs($endDate - $startDate )/86400);
    $fine = $noOfDays - 2;
    $fineInRupees = "Rs. ".$fine.".00";
    return $fineInRupees;
}

?>