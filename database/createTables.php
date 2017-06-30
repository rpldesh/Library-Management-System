<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 28-Jun-17
 * Time: 11:47 PM
 */


$connection = mysqli_connect('localhost','root','');
mysqli_select_db($connection,'LMS_DB')or die("Error occured");

//create admins table
$sql = "CREATE TABLE IF NOT EXISTS 'admins'(
    id INT NOT NULL , 
   admin_name VARCHAR(50) NOT NULL, 
   admin_type VARCHAR(20) NOT NULL, 
   username VARCHAR(50) NOT NULL UNIQUE, 
   password VARCHAR(50) NOT NULL,
   join_date timestamp(6) NOT NULL, 
   state VARCHAR(20),
   primary key ( id ))";
$retval = mysqli_query(  $connection, $sql );
if(! $retval ) {
    die('Could not create table: ');
}
echo "Table admins created successfully\n";

//create books table
$sql = "CREATE TABLE IF NOT EXISTS 'books'(
        id INT NOT NULL,
        title VARCHAR(500) NOT NULL,
		author VARCHAR(500) NOT NULL,
        ISBN VARCHAR(50),
        category_no VARCHAR(50) NOT NULL,
        publisher_name VARCHAR(500) NOT NULL,
        published_date DATE NOT NULL,
        price FLOAT NOT NULL,
        no_pages INT  NOT NULL,
        date_added TIMESTAMP(6) NOT NULL,
        book_type VARCHAR(100) NOT NULL,
        status VARCHAR(50) NOT NULL,
        primary key (id))";
$retval = mysqli_query($connection,$sql);
if(!$retval){
    die('Could not create table:');
}
echo "Table books created successfully\n";S





mysqli_close($connection);
?>

