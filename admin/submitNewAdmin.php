<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 30-Jun-17
 * Time: 12:24 PM
 */

include("../database.php");
include("../table.php");
include("admin.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','lms_db');

if(isset($_POST['submit'])) {
    $adminName = $_POST['adminName'];
    $adminType = $_POST['adminType'];
    $uName = $_POST['uName'];
    $pwd = $_POST['pwd'];
    $rePwd = $_POST['rePwd'];
    if ($pwd != $rePwd) {
        echo "Re-entered password does not match..!!";
    }
    elseif (strlen($pwd)>64 or strlen($pwd)<8){
        echo "Your password must contain 8-64 characters..!!";
    }else {
        $admin = new admin();
        $sql1 = "Select id FROM admins WHERE username = '{$uName}' LIMIT 1";
        $result1 = $admin->featuredLoad($dbObj, $sql1);
        if (count($result1)>0) {
            echo "Username already exists. Please select another username..!!";
        }else{
            $sql2 = "Select count(*) FROM admins";
            echo $sql2."<br />";
            $result2 = $admin->featuredLoad($dbObj,$sql2);
            echo count($result2)."<br />";
            foreach ($result2 as $key=>$value){
                $noOfRows = $value;
            }
            $newId = $noOfRows+1;
            echo $newId."<br />";
            $data = array("id"=>$newId, "admin_name" => $adminName, "admin_type" => $adminType, "username" => $uName, "pwd" => $pwd, "join_date" => time(), "admin_status" => "allowed");
            $admin->bind($data);
            $admin->insert($dbObj);
            echo "Admin member account successfully created..!!";
            /*$sql = "Select join_date FROM admins WHERE id = 4";
            $result = $admin->featuredLoad($dbObj,$sql);
            foreach ($result as $key=>$value){
                echo "<br />".$value."<br />";
                echo  date("m/d/y", $value);
            }*/
        }
    }
}
$dbObj->closeConnection();

?>








<!DOCTYPE html>
<html>
<!--
<head>
    <title>Create Admin Account</title>
    <link rel = "stylesheet" href ="addNewAdminPageStyle.css"/>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education<br />Veyangoda</h3>

        </div>
    </div>
    <article class="backgroundimage">
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li class="logout"><a href="#">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>
        <div class="container">




        </div>
</article>

</body>
-->

</html>

