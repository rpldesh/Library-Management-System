<!DOCTYPE html>
<html>
<head>
    <title>ID configuration</title>
    <link rel = "stylesheet" href ="configure_id.css"/>
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
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="#">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>

<div class="idconfigureform">
    <form align="center" method="POST" action="" autocomplete="off">
        <div class="container">

            <label for="memberId"><b>Enter Member ID:</b></label><br />
            <input id="memberId" name="memberID" type="text"  required autofocus/><br />

            <button class="Submitbtn" name="submit" type="submit">Submit</button>
            <button class="cancelbtn" type="button" href="Administration Page.html">Cancel</button>
        </div>
    </form>
</div>


</article>

</body>
</html>

<?php
include("../database.php");
include("../table.php");
include("member.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
if(isset($_POST['submit'])){
    $m=new member();
    m.load($dbObj,$_POST['memberID']);


}
?>