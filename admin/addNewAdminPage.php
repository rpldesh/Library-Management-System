
<!DOCTYPE html>
<html>
<head>
    <title>Create Admin Account</title>
    <link rel = "stylesheet" href ="css/addNewAdminPageStyle.css"/>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

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

<div class="adminRegform">
    <form align="center" method="POST" action="submitNewAdmin.php" autocomplete="off">
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
            <a href="Administration%20Page.html"><button class="cancelbtn" name="cancelBtn" type="button">Cancel</button></a>
        </div>
    </form>
</div>


</article>

</body>
</html>

<php?

?>
