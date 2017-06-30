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


//create members table
$sql = "CREATE TABLE IF NOT EXISTS 'members'(
        id varchar(20) NOT NULL,
        member_name VARCHAR(100) NOT NULL,
        member_fullname VARCHAR(200) NOT NULL,
        member_type VARCHAR(20) NOT NULL,
        join_date timestamp(6) NOT NULL,
        permanent_address VARCHAR(300),
        current_address VARCHAR(300),
        member_email VARCHAR(100),
        member_status VARCHAR(30) NOT NULL,
        primary key(id)
        )";
$retval = mysqli_query($connection, $sql);
if(!$retval){
    die('could not create table:');
}
echo "Table member created sucessfully\n";

mysqli_close($connection);
?>

