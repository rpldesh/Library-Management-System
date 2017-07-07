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
                <li><a href="#">ADMIN PROFILE</a></li>

                <li><a href="addNewAdminPage.php">ADD NEW ADMIN</a></li>
                <li class="logout"><a href="../mainpage.php">LOGOUT</a></li>
            </ul>
        </nav>
    </div>
</header>

<article class="whitebg">

<form class="loginForm" methood="POST" action="member/Member%20Page.php" autocomplete="off">
    <div class="imgcontainer"><img src="Images/login-bg.png" alt="" class="loginimge"/></div>
    <div class="container">
        <label for="user"><b>Admin Name</b></label><br />
        <input id="user" name="uname" type="text" placeholder="Enter Username" required autofocus/><br />
        <label for="psw"><b>Password</b></label><br />
        <input id="psw" name="psw" type="password" placeholder="Enter Password" required/><br />
        <button type="submit">Login</button>
        <button class="cancelbtn" type="button">Cancel</button>
    </div>
</form>

</article>
