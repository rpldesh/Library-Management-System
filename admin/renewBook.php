<!DOCTYPE html>

<html>
<head>
    <title>Renew Book</title>
    <link rel = "stylesheet" href ="css/issueBook.css"/>
    <style>
        div.alert{display:none ;}
    </style>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg"/>

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education</br>Veyangoda</h3>

        </div>
    </div>
    <article class="backgroundimage">
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration Page.php?id=back">HOME</a></li>

                </ul>
            </nav>
        </div>
</header>


<?php

session_start();
include("../database.php");
include("../table.php");
include("../book.php");
include("../book_session.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root', '', 'lms_db');
$message = "";


$bookIds=$_SESSION['bookIds']; ?>

        <div class="bookRenewalForm">

            <form align="center" method="POST" action="renewBook.php" autocomplete="off">
                <div class="container">
                    <h1> Book Renewal Form </h1>
                    <hr/>
                    <label for="memberID"><b> Member ID </b></label><br/>
                    <h4><input type="text" value="<?php echo $_SESSION['ID'] ?>" readonly/></h4></br>

                    <label for="memberName"><b> Name with initials </b></label><br/>
                    <h4><input type="text" value="<?php echo $_SESSION['Name'] ?>" readonly/></h4></br>

                    <label for="accessionNo"><b> Accession No & Book Title </b></label><br/>
                    <h4><?php foreach ($bookIds as $value) {
                            $nb = new book();
                            $nb->load($dbObj, $value);
                            echo $value."- " . $nb->title ."</br>";
                    } ?></h4></br>

                    <label for="date"><b> Date to be Returned </b></label><br/>
                    <input id="date" name="DoR" type="date" required/><br/>

                    <button class="Submitbtn" name="Renew" type="submit"> Renew</button>
                    <button class="cancelbtn" onclick="window.location='Administration Page.php?id=back'" name="cancelBtn"
                            type="button"> Cancel
                    </button>
                </div>
            </form>


        </div>
        </body>
        </html>
        <?php

   /*}*/

/*}*/

if(isset($_POST['Renew'])) {


   if(date("m-d-Y")>= date("m-d-Y",strtotime($_POST['DoR']))){
       $message="Date to be returned is unvalid";?>
        <style>div.alert{display:inline-block;}</style>
       <div class="alert">
           <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="renewBook.php">&times;</a></strong></span>
           <?php  echo $message;?>

       </div>
       <?php
   }else{
       $memberId = $_SESSION['ID'];

       $Date_to_be_returned=$_POST['DoR'];
       foreach ($_SESSION['bookIds'] as $value) {

        $bookSession = new book_session();
        $sql = "Update book_sessions set session_status ='extended',date_to_be_returned='$Date_to_be_returned' where member_id = '$memberId' and book_id = '$value' and session_status != 'returned'";
        $dbObj->doQuery($sql);
        $message = "Renewed successfully..!!";
        ?><style>div.alert{display:inline-block;}</style>
    <?php }?>
       <div class="alert">
<span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="Administration%20Page.php">&times;</a></strong></span>

           <?php  echo $message;?>

       </div>

    <?php
   }
    $dbObj->closeConnection();

} ?>






