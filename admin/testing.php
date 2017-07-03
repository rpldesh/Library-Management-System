<?php
include("../database.php");
include("../table.php");
include("../member.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
if(isset($_POST['submit'])) {
    $m = new member();
    $m->load($dbObj, $_POST["memberID"]);
    echo $m->member_name;
}
?>