<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 30-Jun-17
 * Time: 12:24 PM
 */

include("database.php");
include("table.php");
include("admin.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','lms_db');

if(isset($_POST['sub'])) {
    echo "in isset";
    $adminName = $_POST['adminName'];
    $adminType = $_POST['adminType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin = new admin();
    //$data = array("id"=>2,"fname"=>"Panther", "lname"=>"Pink");
    //$admin->bind($data);
    $admin->insert($dbObj);
    echo $adminName." ".$adminType." ".$username." ".$password;
}
else{
    echo ".....";
}

/*
 *

$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','test_db');

$user1 = new user();
//$user1->load($dbObj,'3');
//echo "{$user1->fname} {$user1->lname}";
//$data = array("id"=>2,"fname"=>"Panther", "lname"=>"Pink");
//$user1->bind($data);
//echo "{$user1->id} {$user1->fname} {$user1->lname}";
//$user1->update($dbObj);
//$user1->insert($dbObj);
//echo "{$user1->fname} {$user1->lname}";
//$out = $user1->featuredLoad($dbObj,"SELECT lname from users where fname = 'Scooby'");
//foreach ($out as $key=>$value){
//    echo $key." --- ".$value."<br />";
//}
if(isset($_POST['add'])) {
$emp_name = $_POST['emp_name'];
$emp_address = $_POST['emp_address'];

$emp_salary = $_POST['emp_salary'];
$sql = "INSERT INTO employee (emp_name,emp_address, emp_salary, join_date) VALUES('$emp_name','$emp_address',$emp_salary, NOW())";
mysqli_select_db($connection,'test_db');
$retval = mysqli_query( $connection,$sql );
if(! $retval ) {
die('Could not enter data: ');
}
echo "Entered data successfully\n";
mysqli_close($connection);
*/


?>





