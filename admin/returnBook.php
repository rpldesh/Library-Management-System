<?php
session_start();
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 04-Jul-17
 * Time: 2:51 PM
 */
$msg = "";
if(isset($_POST["return"])){
    if(!isset($_POST["bookId"])){
        $msg = "Please select a book";
        echo $msg;
    }else{
        $bookId = $_POST["bookId"];
        include("../database.php");
        include("../table.php");
        include("../member.php");
        include("../book_session.php");
        $dbObj=database::getInstance();
        $dbObj->connect('localhost','root','','lms_db');
        $book = new book();
        $bookSession = new book_session();
        $book->load($dbObj,$bookId);
        $book->status = "available";
        $book->update($dbObj);

    }
}



?>

