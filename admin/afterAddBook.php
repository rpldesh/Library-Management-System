
<!DOCTYPE html>
<html>
<head>
    <title>Add New Admin Member</title>
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
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>


<form  method="POST" action="afterAddBook.php" autocomplete="off"></form>

<div class = "MessageBox"><?php echo $message ?><a href="Administration Page.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>

</article>

</body>
</html>


>>>>>>> c490ace1d088def27a63dc35a6c22e99cc0e7013
<?php
/**
 * Created by PhpStorm.
 * User: Shalika
 * Date: 7/1/2017
 * Time: 4:56 PM
 */

include("../database.php");
include("../table.php");
include("../book.php");
$message = "";
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','LMS_DB');

if(isset($_POST['save'])){
    echo "in isset";
    $title =$_POST['title'];
    $id=$_POST['accNo'];
    $ISBN=$_POST['isbn'];
    $author=$_POST['AutName'];
    $category_no=$_POST['CatNo'];
    $publisher_name=$_POST['Pubname'];
    $published_date=$_POST['DOP'];
    $publisher_address=$_POST['POP'];
    $price=$_POST['Price'];
    $no_pages = $_POST['NoOfPg'];
    $date_added=time();
    $book_type=$_POST['Bktype'];
    $book_status="available";
    $remarks=$_POST['Remarks'];

    $book=new book();
    $sql1 = "Select id FROM books WHERE id = '{$id}' LIMIT 1";
    $result1 = $book->featuredLoad($dbObj, $sql1);
    if (mysqli_num_rows($result1)>0) {
        $message = "This accession number already exists. Please enter correct accession number..!!";
    }if($published_date>time()){
        $message = "This is a future date.re enter the correct date..!";
    }if($no_pages<=0){
        $message = "No of pages cannot be negative value or 0. re enter the correct value..!";
    }if (is_float($price+0) && ($price>0)){
        $message = "--------------------------------";
    }

    $data = array("id"=>$id,"title"=>$title,"author"=>$author,"ISBN"=>$ISBN,"category_no"=>$category_no,
        "publisher_name"=>$publisher_name,"published_date"=>$published_date,"publisher_address"=>$publisher_address,"price"=>$price,
        "no_pages"=>$no_pages,"date_added"=>$date_added,"book_type"=>$book_type,"book_status"=>$book_status,"remarks"=>$remarks);

    $book->bind($data);
    $book->insert($dbObj);
    $message= "Book added successfully..!!";

    echo $id." ".$title." ".$author." ".$ISBN." ".$category_no." ".$publisher_name." ".$published_date." ".$publisher_address." ".$price." ".$no_pages." ".$date_added." ".$book_type." ".$book_status."".$remarks;
}

$dbObj->closeConnection();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <link rel = "stylesheet" href ="AddBook.css"/>
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
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>


<form  method="POST" action="afterAddBook.php" autocomplete="off"></form>

<div class = "MessageBox"><?php echo $message ?><a href="Administration Page.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>

</article>

</body>
</html>