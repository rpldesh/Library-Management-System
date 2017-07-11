<!DOCTYPE html>
<html>
<head>
    <title>Admin Login Page</title>
    <link rel = "stylesheet" href ="css/Administration Page.css"/>
    <link rel = "stylesheet" href ="../css/mainpage.css"/>

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

                <li><a href="#">HOME</a></li>
            </ul>
        </nav>
    </div>
</header>

<article class="whitebg">

<form class="loginForm" methood="POST" action="" autocomplete="off">
    <div class="imgcontainer"><img src="Images/login-bg.png" alt="" class="loginimge"/></div>
    <div class="container">
        <label for="user"><b>Admin Username</b></label><br />
        <input id="user" name="uname" type="text" placeholder="Enter Username" required autofocus/><br />
        <label for="psw"><b>Password</b></label><br />
        <input id="psw" name="psw" type="password" placeholder="Enter Password" required/><br />
        <button type="submit" name="loginBTN">Login</button>
        <button class="cancelbtn" type="button" onclick="window.location='../index.php'">Cancel</button>
    </div>
</form>

    <?php
    include("database.php");
    include("table.php");
    include("login.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');

    if(isset($_POST["loginBTN"])) {
        if (empty($_POST['uname']) || empty($_POST['psw'])) {
            echo "Username or password is invalid";
        } else {
            $username = $_POST['uname'];
            $password = $_POST['psw'];
            $encripted = md5("$password");
            $login = new login();
            $result = $login->load($dbObj,$user_name);
            $numOfRows = mysqli_num_rows($dbObj->getResult());

            $lst_login_date=date('Y-m-d');
            if ($numOfRows == 1) {
                session_start();
                $login->last_login_date=$lst_login_date;
                $login->update($dbObj);
                $_SESSION['id'] = $user_name;
                header("Location:member/Member Page.php");
            } else {
                echo "Your Username or Password is invalid";
            }
        }
    }
    ?>

</article>
</body>
</html>
