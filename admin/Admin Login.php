<?php
include("../database.php");
include("../table.php");
include("admin.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
$message = "";

if(isset($_POST["login"])) {
    if (empty($_POST['uname']) || empty($_POST['psw'])) {
        $message = "Username or password is invalid";
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
            }
            elseif($admin->pwd != $encriptedPwd  ){
                $message = "Incorrect password..!";
            }
            else {
                session_start();
                $admin->last_login_date = date("Y-m-d");
                $admin->update($dbObj);
                $_SESSION['username'] = $admin->username;
                $_SESSION['adminName'] = $admin->admin_name;
                $_SESSION['adminType'] = $admin->admin_type;
                $_SESSION['adminStatus']=$admin->admin_status;
                $_SESSION['add_date']=$admin->join_date;
                $_SESSION['psw']=$admin->pwd;
                header("Location:Administration Page.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login Page</title>
    <link rel = "stylesheet" href ="css/AddBook.css"/>

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



<form class="loginForm" method="POST" action="Admin%20Login.php" autocomplete="off">
    <div class="imgcontainer"><img src="images/login-bg.png" alt="" class="loginimge"/></div>
    <div class="container">
        <span class="warningMsg"><?php echo $message ;?></span><br /><br />
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

