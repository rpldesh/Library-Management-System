<?php
session_start();

/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 02-Jul-17
 * Time: 12:51 AM
 */

if(!isset($_POST["submitID"])){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>ID configuration for Returning</title>
        <link rel = "stylesheet" href ="css/config_if_for_return.css"/>
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
                        <li><a href="Administration%20Page.php?id=backFromReturn">HOME</a></li>
                    </ul>
                </nav>
            </div>
    </header>

    <div class="idconfigureform">
        <form class="Form" align="center" method="POST" action="" autocomplete="off">
            <div class="container">

                <label for="memberId"><b>Enter Member ID:</b></label><br />
                <input id="memberId" name="memberID" type="text"  required autofocus/><br />

                <button class="Submitbtn" name="submitID" type="submit">Submit</button>
                <button class="cancelbtn" onclick="window.location='Administration Page.php?id=backFromReturn'" name="cancel" type="button" >Cancel</button>
            </div>
        </form>
    </div>

    </body>
    </html>

<?php }

if(isset($_POST["submitID"])){
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include("../book_session.php");
    include ("calculateFine.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');

    $member = new member();
    $loadResult = $member->load($dbObj,$_POST["memberID"]);
    $_SESSION['idForReturn'] = $member->id;
    ?>
    <!DOCTYPE HTML>
    <html>
    <body>
    <head>
        <title>Books to be Returned</title>
        <link rel="stylesheet" href="css/returnPage.css"/>
        <style>div.alertMsg{display: none;}</style>
    </head>

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
                        <li><a href="Administration%20Page.php">HOME</a></li>
                    </ul>
                </nav>
            </div>
    </header>


    <?php if(!$loadResult){
        ?> <style>div.alertMsg{display:inline-block;}</style><?php
        $message="Member does not exist..!!";?>
        <div class="alertMsg">
            <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closeIcon" style="text-decoration: none; color: white" href="config_id_for_return.php">&times;</a></strong></span>
            <?php  echo $message;?>

        </div>
    <?php }

    else {
        header("Location:returnTable.php");
    }?>

    </body>
    </html>
<?php
    $dbObj->closeConnection(); } ?>

