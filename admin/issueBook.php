<?php
include("../database.php");
include("../table.php");
include("../member.php");
include("../book.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
session_start();?>

<!DOCTYPE html >
<html >
<head >
    <title > Issue Book </title >
    <link rel = "stylesheet" href = "css/issueBook.css" />
</head >
<body >
<header >
    <div class="head_top" >
        <div class="logo_name" ><img class="siyanelogo" src = "images/siyane_logo.jpg" >

            <h1 > LIBRARY</h1 >
            <h3 > Siyane National College of Education <br />Veyangoda </h3 >

        </div >
    </div >
    <article class="backgroundimage" >
        <div class="bgimage" >
            <nav >
                <ul >
                    <li ><a href = "Administration Page.php?id=back" > HOME</a ></li >

                </ul >
            </nav >

            </div >
    </header >


<?php

if (isset($_POST['GotoIssueForm']) || !isset($_POST['checkbtn'])) {

?>



<div class="bookIssuingForm" >
    <form align = "center" method = "POST" action = "" autocomplete = "off" >
        <div class="container" >
            <h1 > Book Issuing Form </h1 ><hr />
            <label for="memberID" ><b > Member ID </b ></label ><br />
            <h4><input type="text" value="<?php echo  $_SESSION['id'] ?>"readonly/></h4></br>

            <label for="memberName" ><b > Name with initials </b ></label ><br />
            <h4><input type="text" value="<?php echo $_SESSION['member_name']?>"readonly/></h4></br>

            <label for="accessionNo" ><b > Accession No </b ></label ><br />
            <input name = "accessionNo" type = "text" placeholder = "Enter Accession No" required /><br />

            <button class="checkbtn" onclick = "window.location='isseBook.php'" name = "checkbtn" type = "submit" > Check</button >
            <button class="cancelbtn" onclick="window.location='Administration Page.php?id=back'" name="cancelBtn"
                    type="button"> Cancel</button>


        </div>
        </form>


</div>

    </body >
    </html >

<?php


}
    if(isset($_POST['checkbtn'])) {

        $bk = new book();
        $result = $bk->load($dbObj, $_POST['accessionNo']);
        $message='';
        if (!$result) {

            $message="Incorrect Accession Number";?>
            <link rel = "stylesheet" href ="css/messageBox.css"/>

            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="issueBook.php">&times;</a></strong></span>
                <?php echo $message;?>
            </div>
            <?php
        } else {
            $_SESSION['book_id'] = $bk->id;
            $_SESSION['title'] = $bk->title;
            $_SESSION['book_type'] = $bk->book_type;
            $_SESSION['category_no'] = $bk->category_no;

            header("Location:issueSave.php");

        }

    }
$dbObj->closeConnection();?>