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
    if(!isset($_POST["bookIds"])){
        $msg = "Please select a book";
        echo $msg;
    }else{
        include("../database.php");
        include("../table.php");
        include("../member.php");
        include("../book_session.php");
        $dbObj=database::getInstance();
        $dbObj->connect('localhost','root','','lms_db');
        $memberId = $_SESSION['ID'];
        $bookIds = $_POST["bookIds"];
        foreach ($bookIds as $value){
            echo $value." ";
            $book = new book();
            $bookSession = new book_session();
            $book->load($dbObj,$value);
            $book->book_status = "available";
            $book->update($dbObj);
            //$sql = "Update book_sessions set date_of_return = time(), session_status = 'returned' where member_id = $memberId and book_id = $value and session_status != 'returned'";
            $sql = "Select "
        }

    }
}



?>

