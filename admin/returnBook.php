<?php
session_start();
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 04-Jul-17
 * Time: 2:51 PM
 */

if(isset($_POST["return"])){
    if(!isset($_POST["bookId"])){
        echo "Please select a book";
    }else{
        $bookId = $_POST["bookId"];
        include("../database.php");
        include("../table.php");
        include("../member.php");
        include("../book_session.php");
        $dbObj=database::getInstance();
        $dbObj->connect('localhost','root','','lms_db');


    }
}



?>



<!DOCTYPE html>
<!--
<html>
<head>
    <title>Return Book</title>
    <link rel = "stylesheet" href ="issueBook.css"/>
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
                    <li><a href="Administration Page.html">HOME</a></li>
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.html">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>

<div class="bookReturningForm">
    <form align="center" method="POST" action="" autocomplete="off">
        <div class="container">
            <h1>Book Issuing Form</h1><hr />
            <label for="memberID"><b>Member ID</b></label><br />
            <input id="memberID" name="memberID" type="text" placeholder=" " required autofocus/><br />

            <label for="memberName"><b>Name with initials</b></label><br />
            <input name="memberName" type="text" placeholder="" required/><br />

            <label for="accessionNo"><b>Accession No</b></label><br />
            <input name="accessionNo" type="text" placeholder="Enter Accession No" required/><br />

            <button class="checkbtn" onclick="window.location=''" name="checkbtn" type="submit">Check</button>

            <label for="bookTitle"><b>Book Title</b></label><br />
            <input name="bookTitle" type="text" placeholder="" required/><br />

            <label for="date"><b>Date of Return</b></label><br />
            <input id="date" name="DoR" type="date"/><br />

            <button class="Submitbtn" name="submit" type="submit">Issue</button>
            <button class="cancelbtn" onclick="window.location='Administration Page.html'" name="cancelBtn" type="button">Cancel</button>
        </div>
    </form>
</div>


</article>

</body>
-->
</html>


