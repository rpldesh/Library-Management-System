<?php
include("../database.php");
include("../table.php");
include("../member.php");
include("../book.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
session_start();
$message = '';
if(isset($_POST['Issue'])) {

    $book_id = $_SESSION['book_id'];
    $book1 = new book();
    $book1->load($dbObj, $book_id);
    $date_to_be_returned = $_POST['DoR'];

    if ($book1->book_status != "available" || $book1->book_type!="Borrowable") {
        $message = "Sorry...!!This book is not allowed to borrow";
    } elseif (date("m-d-Y") >= date("m-d-Y", strtotime($date_to_be_returned))) {
        $message = "Date to be returned is invalid";
    } else {
        $book1->book_status = "issued";
        $book1->update($dbObj);

        $book_session1 = new book_session();
        $sql = "Select * FROM book_sessions";
        $result = $book_session1->featuredLoad($dbObj, $sql);
        $newId = mysqli_num_rows($result) + 1;
        $date_of_borrowal=date("Y-m-d");
        $data = array("id" => $newId, "book_id" => $book_id, "member_id" => $_SESSION['id'], "book_title" => $_SESSION['title'], "category_no" => $_SESSION['category_no'],"date_of_borrowal" =>$date_of_borrowal, "date_to_be_returned" => $date_to_be_returned,
            "session_status" => "Pending");
        $book_session1->bind($data);
        $book_session1->insert($dbObj);
        $message = "Issued Successfully";

    }
}

$dbObj->closeConnection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Save Issue</title>
    <link rel = "stylesheet" href ="css/AddBook.css"/>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg"/>

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education</br >Veyangoda</h3>

        </div>
    </div>
    <article class="backgroundimage">
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration Page.php">HOME</a></li>
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../index.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>


<!--<form  method="POST" action="issueBook.php" autocomplete="off"></form>-->
<div class = "MessageBox"><?php echo $message ?><a href="issueBook.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>

</article>

</body>
</html>

