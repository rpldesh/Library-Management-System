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



mysqli_close($connection);
?>

