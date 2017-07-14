<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Create/Disable Admin Account</title>
    <link rel = "stylesheet" href ="css/addNewAdminPageStyle.css"/>
    <link rel = "stylesheet" href ="css/AddBook.css"/>
    <style>div.alert{display:none;}</style>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education</br>Veyangoda</h3>

        </div>
    </div>
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration Page.php">HOME</a></li>
                </ul>
            </nav>
        </div>
</header>
<div class="tab">
    <div class="ChangeSettings">
        <button class="tablinks" onclick="ClickOption(event, 'Create')">Create New Admin Account</button>
        <button class="tablinks" onclick="ClickOption(event, 'Disable')">Disable an Admin Account</button>
    </div>
</div>
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
?>

<div id="Create" class="tabcontent">
                <div class="adminRegform">
                <form align="center" method="POST" action="" autocomplete="off">
                    <div class="container">
                        <h1>Admin Registration Form</h1><hr />
                        <label for="adminName"><b>Name with initials</b></label><br />
                        <input id="adminName" name="adminName" type="text" placeholder="Enter name with initials " required autofocus/><br />
                        <label for="adminType"><b>Admin Type</b></label><br />
                        <select name="adminType" required<br />
                        <option value="librarian">Librarian</option><option value="clerk" >Clerk</option><option value="audit" >Audit</option></select>
                        <label for="uName"><b>Username</b></label><br />
                        <input name="uName" type="text" placeholder="Enter a username" required/><br />
                        <label for="pwd"><b>Password</b></label><br />
                        <input name="pwd" type="password" placeholder="Enter a password" required/><br />
                        <label for="rePwd"><b>Re-enter Password</b></label><br />
                        <input name="rePwd" type="password" placeholder="Re-enter the password" required/><br />
                        <button class="Submitbtn" name="submit" type="submit">Create account</button>
                        <a href="Administration%20Page.php"><button class="cancelbtn" name="cancelBtn" type="button">Cancel</button></a>
                    </div>
                </form>
            </div>


<?php

if(isset($_POST['submit']) ) {
    $adminName = $_POST['adminName'];
    $adminType = $_POST['adminType'];
    $uName = $_POST['uName'];
    $pwd = $_POST['pwd'];
    $rePwd = $_POST['rePwd'];

    if ($pwd != $rePwd) {
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Re-entered password does not match..!!";
    }
    elseif (strlen($pwd)>64 or strlen($pwd)<8){
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Your password must contain 8-64 characters..!!";
    }else {
        $admin = new admin();
        $sql1 = "Select id FROM admins WHERE username COLLATE latin1_general_cs = '{$uName}' LIMIT 1";
        $result1 = $admin->featuredLoad($dbObj, $sql1);
        if (mysqli_num_rows($result1)>0) {
            ?> <style>div.alert{display:inline-block;}</style><?php
            $message = "Username already exists. Please select another username..!!";
        }else{
            $sql2 = "Select * FROM admins";
            $result2 = $admin->featuredLoad($dbObj,$sql2);
            $newId = mysqli_num_rows($result2)+1;
            $data = array("id"=>$newId, "admin_name" => $adminName, "admin_type" => $adminType, "username" => $uName, "pwd" => md5("$pwd"), "join_date" => date("Y-m-d"), "admin_status" => "allowed");
            $admin->bind($data);
            $admin->insert($dbObj);
            ?> <style>div.alert{display:inline-block;}</style><?php
            $message = "Admin member account successfully created..!!";
        }
    }
}


?>
</div>

<div id="Disable" class="tabcontent">

    <div class="Password">
        <form  method="POST" action="disableAdmin.php" autocomplete="off">
            <div class="container">
                <h1>Disable Admin Account</h1><hr />
                <label><b>Enter Username</b></label>
                <input type="text" name="uName" id="textEmail" />
                <button name="entered" class="Submitbtn" type="submit">Check</button>
            </div>
        </form>
    </div>

</div>


<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php echo $message;?>
</div>

<script>
    function ClickOption(evt, optionName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(optionName).style.display = "inline-block";
    evt.currentTarget.className += " active";
    }
</script>
<?php $dbObj->closeConnection(); ?>
</body>
</html>

