<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Books Returned</title>
    <link rel="stylesheet" href="css/returnPage.css"/>
    <style>div.alertMsg{display: none;}</style>
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
    include("../database.php");
    include("../table.php");
    include("../book.php");
    include("../book_session.php");
    $dbObj = database::getInstance();
    $dbObj->connect('localhost', 'root', '', 'lms_db');
    $memberId = $_SESSION['idForReturn'];
    $bookIds = $_SESSION["bookIDs"];
    foreach ($bookIds as $value) {
        $book = new book();
        $bookSession = new book_session();
        $book->load($dbObj, $value);
        $book->book_status = "available";
        $book->update($dbObj);
        $dateOfReturn = date("Y-m-d");
        $sql = "Update book_sessions set date_of_return = '$dateOfReturn', session_status = 'returned' where member_id = '$memberId' and book_id = '$value' and session_status != 'returned'";
        echo $sql."<br />";
        $dbObj->doQuery($sql);
    } ?>
    <style>div.alertMsg {
            display: inline-block;
        }</style><?php
    $msg = "Returned successfully..!!";
    $dbObj->closeConnection();

?>
<div class="alertMsg">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closeIcon" style="text-decoration: none; color: white" href="Administration%20Page.php?id=backFromReturn">&times;</a></strong></span>
    <?php  echo $msg;?>

</div>
</body>
</html>
