<?php
$connection = mysqli_connect('localhost','root','');
$sql='CREATE Database LMS_DB';
$retval=mysqli_query($connection,$sql);
if(! $retval){
    die('Could not create the database: ');
}

echo "Database LMS_DB created successfully\n";
mysqli_close($connection);
?>