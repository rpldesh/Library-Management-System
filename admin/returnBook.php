<?php
session_start();
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 04-Jul-17
 * Time: 2:51 PM
 */
$msg = "";
if(isset($_POST["returnBTN"])){
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
        echo ;
        //$book = new book();
        //$bookSession = new book_session();
        //$book->load($dbObj,$bookId);
        //$book->book_status = "available";
        //$book->update($dbObj);
        //$sql = "Update book_sessions set date_of_return = ,session_status from book_sessions where member_id = '$member->id' and session_status != 'returned'";

    }
}



?>

