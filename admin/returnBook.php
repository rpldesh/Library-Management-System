<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 04-Jul-17
 * Time: 2:51 PM
 */

if(isset($_POST["return"])){
    if(!isset($_POST["bookId"])){
        echo "Please select a book";
    }else{
        $bookId = $_POST["bookId"];
        echo $bookId;
    }
}



?>