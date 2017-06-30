
/**
* Created by PhpStorm.
* User: Shalika
* Date: 6/30/2017
* Time: 3:28 PM
*/


<!DOCTYPE html>
<html>
<head>
    <title>Add Book Page</title>
    <link rel = "stylesheet" href ="AddBook.css"/>
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

<div class="addbkform">
    <form align="center" method="POST" action="" autocomplete="off">
        <div class="container">
            <h1>Book Registration Form</h1><hr />
            <label for="AccNo"><b>Accession Number</b></label><br />
            <input id="AccNo" name="accNo" type="text" placeholder="Enter Accession Number" required autofocus/><br />
            <label for="title"><b>Titile</b></label><br />
            <input id="title" name="title" type="text" placeholder="Enter Accession Number" required autofocus/><br />
            <label for="bktype"><b>Book Type</b></label><br />
            <select id="bktype" name="Bktype" required><br />
                <option value="borrowable" >Borrowable</option><option value="reference" >Reference</option></select>
            <label for="autname"><b>Author</b></label><br />
            <input id="autname" name="AutName" type="text" placeholder="Enter Author" required/><br />
            <label for="isbn"><b>ISBN</b></label><br />
            <input id="isbn" name="isbn" type="text" placeholder="Enter Accession Number" required autofocus/><br />
            <label for="NoP"><b>No Of Pages</b></label><br />
            <input id="NoP" name="NoOfPg" type="number" placeholder="Enter No Of Pages" required/><br />
            <label for="price"><b>Price</b></label><br />
            <input id ="price" name="Price" type="text" placeholder="Enter the Price" required/><br />
            <label for="catno"><b>Category Number</b></label><br />
            <input id="catno" name="CatNo" type="text" placeholder="Enter Category No" required/><br />
            <label for="pubName"><b>Publisher Name</b></label><br />
            <input id="pubName" name="Pubname" type="text" placeholder="Enter Publisher Name" required/><br />
            <label for="dop"><b>Date of Publication</b></label><br />
            <input id="dop" name="DOP" type="date"/><br />
            <label for="pop"><b>Place Of Publication</b></label><br />
            <input id="pop" name="POP" type="text" placeholder="Enter place Of Publication" /><br />
            <label for="remarks"><b>Remarks</b></label><br />
            <textarea id="remarks" name="Remarks" clos="40" rows="6" required></textarea><br />
            <button class="Submitbtn"type="submit">Submit</button>
            <button class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>
</div>
<div class="Messagebox">Member added successfully</div>

</article>

</body>
</html>

<?php

include("../database.php");
include("../table.php");
include("Book.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','LMS_DB');

if(isset($_POST['save'])){
    echo "in isset";
    $title =$_POST['title'];
    $id=null=$_POST['accNo'];
    $ISBN=$_POST['isbn'];
    $author=$_POST['AutName'];
    $category_no=$_POST['CatNo'];
    $publisher_name=$_POST['Pubname'];
    $published_date=$_POST['DOP'];
    $publisher_name=$_POST['POP'];
    $price=$_POST['Remarks'];
    $no_pages = $_POST['NoOfPg'];
    $date_added=time();
    $book_type=$_POST['Bktype'];
    $book_status="available";
    $remarks=$_POST['Remarks'];

    $book=new Book();
    $data = array("id"=>$id,"title"=>$title,"author"=>$author,"ISBN"=>$ISBN,"category_no"=>$category_no,
        "publisher_name"=>$publisher_name,"published_date"=>$published_date,"publisher_address"=>$publisher_address,"price"=>$price,
        "no_pages"=>$no_pages,"date_added"=>$date_added,"book_type"=>$book_type,"book_status"=>$book_status,"remarks"=>$remarks,);
    $book->bind($data);


    $book->insert($dbObj);
    echo $id." ".$title." ".$author." ".$ISBN." ".$category_no." ".$publisher_name." ".$published_date." ".$publisher_address." ".$price." ".$no_pages." ".$date_added." ".$book_type." ".$book_status."".$remarks;
}

?>