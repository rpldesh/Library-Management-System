<?php
session_start();
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 04-Jul-17
 * Time: 2:51 PM
 */
$msg = "";
if(isset($_POST["returnBTN"])) {
    if(!isset($_POST["bookIds"])){
        $msg = "Please select a book";
    }else{
        include("../database.php");
        include("../table.php");
        include("../book.php");
        include("../book_session.php");
        $dbObj=database::getInstance();
        $dbObj->connect('localhost','root','','lms_db');
        $memberId = $_SESSION['ID'];
        $bookIds = $_POST["bookIds"];
        foreach ($bookIds as $value){
            echo $value."<br />";
            $book = new book();
            $bookSession = new book_session();
            $book->load($dbObj,$value);
            $book->book_status = "available";
            $book->update($dbObj);
            $dateOfReturn = date("Y-m-d");
            $sql = "Update book_sessions set date_of_return = $dateOfReturn, session_status = 'returned' where member_id = $memberId and book_id = $value and session_status != 'returned'";
            $dbObj->doQuery($sql);
        }$msg = "Returned successfully..!!";
        $dbObj->closeConnection();
        session_destroy();
    }
?>

<!DOCTYPE html>

<html>
<head>
    <title>Return Book</title>
    <link rel = "stylesheet" href ="css/messageBox.css"/>
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
                    <li><a href="Administration Page.php">HOME</a></li>
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>

<div class = "MessageBox"><?php echo $msg ?><a href="Administration Page.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>

</article>

</body>
</html>
<?php } ?>