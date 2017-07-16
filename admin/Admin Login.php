<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login Page</title>
    <link rel = "stylesheet" href ="css/AddBook.css"/>
    <style>img.warImg{display: none;}</style>

    </head>
<body>
    <header>
        <div class="head_top"><img class="siyanelogo" src="images/siyane_logo.jpg"/>
        <div class="logo_name">
            <h1>LIBRARY</h1>
            <h3>Siyane National College Of Education<br />Veyangoda</h3>
        </div>
        </div>
        <div class="bgimage">
        <nav>
            <ul>
                <li><a href="../index.php">HOME</a></li>
            </ul>
        </nav>
        </div>
    </header>

    <?php
    include("../database.php");
    include("../table.php");
    include("admin.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $message ="";

    if(isset($_POST["login"])) {
        if (empty($_POST['uname']) || empty($_POST['psw'])) {
            $message = "Username or password is invalid..!";
            ?>
            <style>img.warImg{display: inline-block;}</style>
        <?php
        } else {
            $username = $_POST['uname'];
            $password = $_POST['psw'];
            $encriptedPwd = md5("$password");
            $admin = new admin();
            $sql = "Select * from admins where username = '$username'";
            $result = $admin->featuredLoad($dbObj, $sql);
            $numOfRows = mysqli_num_rows($result);
            if ($numOfRows == 1) {
                foreach (mysqli_fetch_assoc($result) as $key => $value) {
                    $admin->$key = $value;
                }
                if($admin->admin_status != "allowed"){
                    $message = "Your account is not valid anymore..!";
                    ?>
                    <style>img.warImg{display: inline-block;}</style>
                    <?php
                }
                else if($username != $admin->username ){
                    $message = "Incorrect username..!";
                    ?>
                    <style>img.warImg{display: inline-block;}</style>
                    <?php
                }
                else if($admin->pwd != $encriptedPwd){
                    $message = "Incorrect password..!";
                    ?>
                    <style>img.warImg{display: inline-block;}</style>
                    <?php
                }
                else if($admin->pwd == $encriptedPwd) {
                    $admin->last_login_date = date("Y-m-d");
                    $admin->update($dbObj);
                    $_SESSION['username'] = $admin->username;
                    $_SESSION['adminName'] = $admin->admin_name;
                    $_SESSION['adminType'] = $admin->admin_type;
                    $_SESSION['adminStatus']=$admin->admin_status;
                    $_SESSION['add_date']=$admin->join_date;
                    $_SESSION['id']=$admin->id;
                    header("Location:Administration Page.php");
                }
                else{
                    $message = "Invalid username..!";
                    ?>
                    <style>img.warImg{display: inline-block;}</style>
                    <?php
                }
            }else{
                $message = "Invalid username..!";
                ?>
                <style>img.warImg{display: inline-block;}</style>
                <?php
            }
        }
    }$dbObj->closeConnection();

    if (isset($_GET['id']) && $_GET['id']=='adminLogout' && !isset($_POST["login"])){
        $_SESSION['username'] = '';
        $_SESSION['adminName'] = '';
        $_SESSION['adminType'] = '';
        $_SESSION['adminStatus']='';
        $_SESSION['add_date']='';
        $_SESSION['user']='';
        session_destroy();
    }
    ?>


    <form class="loginForm" method="post" action="" autocomplete="off">
        <h2 align="center">Admin Login</h2>
        <div class="imgcontainer"><img src="images/login-bg.png" alt="" class="loginimge"/></div>
        <div class="container">
            <span class="warningMsg"><img class="warImg" src="images/warning.gif" height="25px" width="25px"/>  <?php echo $message ; ?></span><br /><br />
            <label for="user"><b>Admin Username</b></label><br />
            <input id="user" name="uname" type="text" placeholder="Enter Username" required autofocus/><br />
            <label for="psw"><b>Password</b></label><br />
            <input id="psw" name="psw" type="password" placeholder="Enter Password" required/><br />
            <button name="login" type="submit" >Login</button>
            <button class="cancelbtn" type="button" onclick="window.location='../index.php'">Cancel</button>
        </div>
    </form>


</body>
</html>

