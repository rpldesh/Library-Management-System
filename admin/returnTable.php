<!DOCTYPE HTML>
<html>
<head>
    <title>Books to be Returned</title>
    <link rel="stylesheet" href="css/returnPage.css"/>
    <style>div.alert{display: none;}</style>
    <style>div.Done{display: none;}</style>
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

<?php

session_start();
include("../database.php");
include("../table.php");
include("../member.php");
include("../book_session.php");
include ("calculateFine.php");
include("../book.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');

$member = new member();
$loadResult = $member->load($dbObj,$_SESSION['idForReturn']);
$_SESSION['idForReturn'] = $member->id;
$sql = "Select book_id,book_title,date_of_borrowal,date_to_be_returned,session_status from book_sessions where member_id = '$member->id' and session_status != 'returned'";
$bkSession = new book_session();
$result = $bkSession->featuredLoad($dbObj,$sql);
$numOfRows = mysqli_num_rows($result);
?>

<div style="overflow:auto;">
    <table style="width:100%">
        <caption>Member Details & Previous Records</caption>
        <tr>
            <th>Member ID</th>
            <th>Name with Initials</th>
            <th>Member Type</th>
            <th colspan="6">Books to be returned</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><p><b>No.</b></p></td>
            <td><p><b>Accession No</b></p></td>
            <td><p><b>Title</b></p></td>
            <td><p><b>Date of Borrowal</b></p></td>
            <td><p><b>Date to be Returned</b></p></td>
            <td><p><b>Status</b></p></td>
        </tr>
        <tr>

            <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->id?></td>
            <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->member_name?></td>
            <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->member_type?></td>

            <?php
            for($i=0;$i<$numOfRows;$i++){
            ?><td><?php echo ($i+1)."." ?></td><?php
            foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                if($key == 'date_to_be_returned') {
                    if (date("Y-m-d") > date("Y-m-d", strtotime($value))) {
                        $fine = calculateFine($value);
                        ?><td><p style="color: red"><?php echo $value ."    Expired"."</br>"."Fine : ". $fine ?></p></td><?php
                    }if (date("Y-m-d") <= date("Y-m-d", strtotime($value))) {
                        ?><td><?php echo $value ."    Not Expired" ?></td><?php
                    }
                }elseif($key == 'date_of_borrowal'){
                    ?><td><?php echo date("Y-m-d",strtotime($value)) ?></td><?php
                }elseif($key == 'book_id'){
                    ?><td><form action="returnTable.php" method="post">
                        <input type="checkbox" name="bookIds[]" value=<?php echo $value ?> /><?php echo $value ?>

                    </td>
                <?php } else{
                    ?><td><?php echo $value ?></td>
                    <?php
                }}?>
        </tr><?php
        }
        ?>

    </table>
</div>
<button class="returnBTN" type="submit" name="returnBTN">Return Book/Books</button>
<button class="cancelbtn" type="button" onclick="window.location='config_id_for_return.php'" name="cancel">Cancel</button>

<?php
if(isset($_POST["returnBTN"])) {
    if (!isset($_POST["bookIds"])) {
        ?>
        <style>div.alert {
                display: inline-block;
            }</style><?php
        $msg = "Please select at least one book to proceed";
    }
    else {
        $bookIds = $_POST["bookIds"];
        //$_SESSION["bookIDs"] = $bookIds;
        //header("Location:returnBook.php");
        $memberId = $_SESSION['idForReturn'];
        //$bookIds = $_SESSION["bookIDs"];
        foreach ($bookIds as $value) {
            $book = new book();
            $bookSession = new book_session();
            $book->load($dbObj, $value);
            $book->book_status = "available";
            $book->update($dbObj);
            $dateOfReturn = date("Y-m-d");
            $sql = "Update book_sessions set date_of_return = '$dateOfReturn', session_status = 'returned' where member_id = '$memberId' and book_id = '$value' and session_status != 'returned'";
            $dbObj->doQuery($sql);
        } ?>
        <!-- <style>div.Done {
                display: inline-block;
            }</style> --><?php
        //$msg = "Returned successfully..!!";
        header("Location:returnBook.php");
    }
}
$dbObj->closeConnection();
?>
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closeIcon" style="text-decoration: none; color: white" href="returnTable.php">&times;</a></strong></span>
    <?php  echo $msg;?>

</div>
<div class="Done">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closeIcon" style="text-decoration: none; color: white" href="Administration%20Page.php?id=backFromReturn">&times;</a></strong></span>
    <?php  echo $msg;?>

</div>
</body>
</html>

