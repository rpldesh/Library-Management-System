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
            <h3>Siyane National College of Education<br />Veyangoda</h3>

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

<?php
session_start();
include("../database.php");
include("../table.php");
include("../member.php");
include("../book.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
$message = '';?>

<div class="bookIssuingForm">
                <form align="center" method="POST" action="issueSave.php" autocomplete="off">
                    <div class="container">
                        <h1> Book Issuing Form </h1>
                        <hr/>
                        <label for="memberID"><b> Member ID </b></label><br/>
                        <h4><input type="text" value="<?php echo $_SESSION['id'] ?>" readonly/></h4></br>

                        <label for="memberName"><b> Name with initials </b></label><br/>
                        <h4><input type="text" value="<?php echo $_SESSION['member_name'] ?>"readonly/></h4></br>

                        <label for="accessionNo"><b> Accession No </b></label><br/>
                        <h4><input type="text" value="<?php echo $_SESSION['book_id'] ?>" readonly/></h4></br>

                        <label for="bookTitle"><b> Book Title </b></label><br/>
                        <h4><input type="text" value="<?php echo $_SESSION['title'] ?>"readonly/></h4></br>

                        <label for="bookType"><b> Book Type</b></label><br/>
                        <h4><input type="text" value="<?php echo $_SESSION['book_type'] ?>" readonly></h4></br>

                        <label for="date"><b> Date to be Returned </b></label><br/>
                        <input id="date" name="DoR" type="date" required/><br/>


                        <button class="Submitbtn" name="Issue" type="submit"> Issue</button>
                        <button class="cancelbtn" onclick="window.location='Administration Page.php?id=back'" name="cancelBtn" type="button"> Cancel
                        </button>
                    </div>
                </form>

            </div>



            </body>
            </html>




<?php
if(isset($_POST['Issue'])) {

    $book_id = $_SESSION['book_id'];
    $book1 = new book();
    $book1->load($dbObj, $book_id);
    $date_to_be_returned = $_POST['DoR'];

    if ($book1->book_status != "available" || $book1->book_type!="borrowable") {
        $message = "Sorry...!!This book is not allowed to be borrowed";?>

    <div id="invalidBorobk" class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="issueBook.php">&times;</a></strong></span>
    <?php echo $message;?>

</div>
<?php
    } elseif (date("Y-m-d") >= date("Y-m-d", strtotime($date_to_be_returned))) {
        $message = "Date to be returned is invalid";
        ?>
<div id="invaliddateofborro" class="alert">
        <span id="" class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="issueSave.php">&times;</a></strong></span>
    <?php echo $message;?>

</div><?php
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
        $message = "Issued Successfully";?>
    <div id="suucissue" class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="issueBook.php">&times;</a></strong></span>
    <?php echo $message;?>

    </div>
<?php

    }
    ?>

</body>
</html>
    <?php
}
$dbObj->closeConnection();
?>






