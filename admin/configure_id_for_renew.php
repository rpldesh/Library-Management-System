<?php
session_start();
if(!isset($_POST["submitID"])){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>ID configuration for Renewal</title>
        <link rel = "stylesheet" href ="css/configure_id.css"/>
    </head>
    <body>
    <header>
        <script type="text/javascript">
            function validate(){
                var missingField=false;
                var strFields="";
                if(id_config.memberID.value==""){
                    missingField=true;
                    strFields+="Plese enter a member ID";
                }
                if(missingField){
                    alert("Sorry! You must provide following fields to continue:\n"+strFields);
                    return false;
                }
                return true;
            }
        </script>
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

                    </ul>
                </nav>
            </div>
    </header>

    <div class="idconfigureform">
        <form name="id_config"class="Form" align="center" method="POST" action="" autocomplete="off">
            <div class="container">

                <label for="memberId"><b>Enter Member ID:</b></label></br>
                <input id="memberId" name="memberID" type="text"  required autofocus/></br >

                <button class="Submitbtn" name="submitID" type="submit" onclick="validate()">Submit</button>
                <button class="cancelbtn" onclick="window.location='Administration Page.php'" name="cancel" type="button" >Cancel</button>
            </div>
        </form>
    </div>

    </body>
    </html>

<?php }

if(isset($_POST["submitID"])) {
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include("../book_session.php");
    include ("calculateFine.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $message='';
    $member = new member();
    $loadResult = $member->load($dbObj,$_POST["memberID"]);
    $_SESSION['ID'] = $member->id;
    $_SESSION['Name'] = $member->member_name;
    ?>
    <!DOCTYPE HTML>
    <head>
        <title>Books to be Returned</title>
        <link rel="stylesheet" href="css/renewPage.css"/>
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
                        <li><a href="Administration%20Page.php?id=back">HOME</a></li>

                    </ul>
                </nav>
            </div>
    </header>

    <?php if(!$loadResult){
        $message="Member does not exist..!!";?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="configure_id_for_renew.php">&times;</a></strong></span>
            <?php  echo $message;?>

        </div>
    <?php }
    else {

        header("Location:renewTable.php");
    }
    ?>
        </body>
        </html>
    <?php $dbObj->closeConnection();}
?>

