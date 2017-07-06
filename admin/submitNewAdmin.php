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
$message = "";
if(isset($_POST['submit'])) {
    $adminName = $_POST['adminName'];
    $adminType = $_POST['adminType'];
    $uName = $_POST['uName'];
    $pwd = $_POST['pwd'];
    $rePwd = $_POST['rePwd'];

    if ($pwd != $rePwd) {
        $message = "Re-entered password does not match..!!";
    }
    elseif (strlen($pwd)>64 or strlen($pwd)<8){
        $message = "Your password must contain 8-64 characters..!!";
    }else {
        $admin = new admin();
        $sql1 = "Select id FROM admins WHERE username = '{$uName}' LIMIT 1";
        $result1 = $admin->featuredLoad($dbObj, $sql1);
        if (mysqli_num_rows($result1)>0) {
            $message = "Username already exists. Please select another username..!!";
        }else{
            $sql2 = "Select * FROM admins";
            $result2 = $admin->featuredLoad($dbObj,$sql2);
            $newId = mysqli_num_rows($result2)+1;
            echo $newId."<br />";
            $data = array("id"=>$newId, "admin_name" => $adminName, "admin_type" => $adminType, "username" => $uName, "pwd" => $pwd, "join_date" => time(), "admin_status" => "allowed");
            $admin->bind($data);
            $admin->insert($dbObj);
            $message = "Admin member account successfully created..!!";
        }
    }
}
$dbObj->closeConnection();

?>




<!DOCTYPE html>
<html>
<head>
    <title>Add New Admin Member</title>
    <link rel = "stylesheet" href ="css/AddBook.css"/>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg"/>

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education</br>Veyangoda</h3>

        </div>
    </div>
    <article class="backgroundimage">
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration Page.php">HOME</a></li>
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>


    <form  method="POST" action="afterAddBook.php" autocomplete="off"></form>
<div class = "MessageBox"><?php echo $message ?><a href="Administration Page.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>

</article>

</body>
</html>

