<?php

/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 02-Jul-17
 * Time: 12:51 AM
 */
if(!isset($_POST["submitID"]) and !isset($_POST["calcFine"])){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>ID configuration for Returning</title>
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

                <button class="Submitbtn" name="submitID" type="submit">Submit</button>
                <button class="cancelbtn" onclick="window.location='Administration Page.html'"name="cancel" type="button" >Cancel</button>
            </div>
        </form>
    </div>


    </article>

    </body>
    </html>

<?php }

if (isset($_POST["submitID"])){
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include("../book_session.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');

    $member = new member();
    $loadResult = $member->load($dbObj,$_POST["memberID"]);

    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Books to be Returned</title>
        <link rel="stylesheet" href="returnPage.css"/>
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


    <?php if(!$loadResult){ ?>
        <div class = "MessageBox"><?php echo "Member does not exist..!!" ?><a href="config_id_for_return.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>
    <?php }
    else {
        $sql = "Select book_id,book_title,date_of_borrowal,date_to_be_returned,session_status from book_sessions where member_id = '$member->id' and session_status = 'pending'";
        $bkSession = new book_session();
        $result = $bkSession->featuredLoad($dbObj,$sql);
        $numOfRows = mysqli_num_rows($result);
        $delayedBooks = array();
        ?>
        <div class = "topOfTable"><p align="Left"><?php echo "Member Index No : ".$member->id ?><br /><?php echo "Name :".$member->member_name ?></p>
            <h3 align="left" style="color: cornsilk">Books to be Returned </h3>
        </div>
        <div style="overflow:auto;">
            <table style="width:100%">
                <tr>
                    <th>Book Accession Number</th>
                    <th>Book Name </th>
                    <th>Date of Borrowal</th>
                    <th>Date to be Returned</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <?php
                    $count = 0;
                    for($i=0;$i<$numOfRows;$i++){
                        ?><tr><?php
                        foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                            if($key == 'date_to_be_returned') {
                                //$return_date = strtotime($value);
                                if (date("Y-m-d") > date("Y-m-d", strtotime($value))) {
                                    //$count = $count+1;
                                    $start = strtotime($value);
                                    $end = time();
                                    $noOfDays = ceil(abs($end - $start) / 86400);
                                    $fine = $noOfDays -2;
                                    ?><td><p style="color: red"><?php echo $value ."    Expired"."<br />"."Fine : "."Rs.".$fine.".00" ?></p></td><?php
                                }if (date("Y-m-d") <= date("Y-m-d", strtotime($value))) {
                                    ?><td><?php echo $value ."    Not Expired" ?></td><?php
                                }
                            } else{
                            ?><td><?php echo $value ?></td>
                        <?php
                        }}?>
                 </tr><?php
                    }
                    ?>

            </table>
        </div>

        <div class="btns">
        <form action="returnBook.php" method="post">
            <button class="return" name="return" type="submit">Return Book</button>
            <a href="Administration%20Page.html"><button name="exitBtn" class="exitBtn" type="button">Exit</button></a>
        </form>
        </div>

    </body>
    </html>
<?php
}} ?>

