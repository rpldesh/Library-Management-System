<?php
/**
 * Created by PhpStorm.
 * User: Shalika
 * Date: 7/1/2017
 * Time: 4:56 PM
 */

include("../database.php");
include("../table.php");
include("../book.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','LMS_DB');

if(isset($_POST['save'])){
    echo "in isset";
    $title =$_POST['title'];
    $id=$_POST['accNo'];
    $ISBN=$_POST['isbn'];
    $author=$_POST['AutName'];
    $category_no=$_POST['CatNo'];
    $publisher_name=$_POST['Pubname'];
    $published_date=$_POST['DOP'];
    $publisher_address=$_POST['POP'];
    $price=$_POST['Remarks'];
    $no_pages = $_POST['NoOfPg'];
    $date_added=time();
    $book_type=$_POST['Bktype'];
    $book_status="available";
    $remarks=$_POST['Remarks'];

    $book=new book();
    $data = array("id"=>$id,"title"=>$title,"author"=>$author,"ISBN"=>$ISBN,"category_no"=>$category_no,
        "publisher_name"=>$publisher_name,"published_date"=>$published_date,"publisher_address"=>$publisher_address,"price"=>$price,
        "no_pages"=>$no_pages,"date_added"=>$date_added,"book_type"=>$book_type,"book_status"=>$book_status,"remarks"=>$remarks,);

    $book->bind($data);
    $book->insert($dbObj);

    echo $id." ".$title." ".$author." ".$ISBN." ".$category_no." ".$publisher_name." ".$published_date." ".$publisher_address." ".$price." ".$no_pages." ".$date_added." ".$book_type." ".$book_status."".$remarks;
    echo "Book added successfully..!";
}

$dbObj->closeConnection();
?>