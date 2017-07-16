

<!DOCTYPE html>
<html>
<head>
    <title>Add Book Page</title>
    <link rel = "stylesheet" href ="css/AddBook.css"/>
    <style>div.alert{display:none;}</style>
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education</br>Veyangoda</h3>

        </div>
    </div>
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration Page.php">HOME</a></li>
                </ul>
            </nav>
        </div>
</header>

<div class="addbkform">
    <form  id="AddBkForm" method="POST" action="AddBook.php" autocomplete="off">
        <div class="container">
            <h1>Book Registration Form</h1><hr />
            <label for="AccNo"><b>Accession Number</b></label><br />
            <input id="AccNo" name="accNo" type="text" placeholder="Enter Accession Number" value="<?php if (isset($_POST['accNo'])) echo $_POST['accNo']; ?>" required autofocus/><br />
            <label for="title"><b>Titile</b></label><br />
            <input id="title" name="title" type="text" placeholder="Enter Title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>" required autofocus/><br />
            <label for="bktype"><b>Book Type</b></label><br />
            <select id="bktype" name="Bktype" required><br />
                <option value="borrowable" >Borrowable</option><option value="reference" >Reference</option></select>
            <label for="autname"><b>Author</b></label><br />
            <input id="autname" name="AutName" type="text" placeholder="Enter Author" value="<?php if (isset($_POST['AutName'])) echo $_POST['AutName']; ?>" required/><br />
            <label for="isbn"><b>ISBN</b></label><br />
            <input id="isbn" name="isbn" type="text" placeholder="Enter ISBN" value="<?php if (isset($_POST['isbn'])) echo $_POST['isbn']; ?>" autofocus/><br />
            <label for="NoP"><b>No Of Pages</b></label><br />
            <input id="NoP" name="NoOfPg" type="number"  placeholder="Enter No Of Pages" value="<?php if (isset($_POST['NoOfPg'])) echo $_POST['NoOfPg']; ?>" required/><br />
            <label for="price"><b>Price</b></label><br />
            <input id ="price" name="Price" type="number" step="0.01" placeholder="Enter the Price" value="<?php if (isset($_POST['Price'])) echo $_POST['Price']; ?>" required/><br />
            <label for="catno"><b>Category Number</b></label><br />
            <input id="catno" name="CatNo" type="text" placeholder="Enter Category No" value="<?php if (isset($_POST['CatNo'])) echo $_POST['CatNo']; ?>" required/><br />
            <label for="pubName"><b>Publisher Name</b></label><br />
            <input id="pubName" name="Pubname" type="text" placeholder="Enter Publisher Name" value="<?php if (isset($_POST['Pubname'])) echo $_POST['Pubname']; ?>" required/><br />
            <label for="dop"><b>Date of Publication</b></label><br />
            <input id="dop" name="DOP" type="date" value="<?php if (isset($_POST['DOP'])) echo $_POST['DOP']; ?>" /><br />
            <label for="pop"><b>Place Of Publication</b></label><br />
            <input id="pop" name="POP" type="text" placeholder="Enter place Of Publication" value="<?php if (isset($_POST['POP'])) echo $_POST['POP']; ?>" /><br />
            <label for="remarks"><b>Remarks</b></label><br />
            <textarea id="remarks" name="Remarks" cols="40" rows="6" value="<?php if (isset($_POST['Remarks'])) echo $_POST['Remarks']; ?>"></textarea><br />
            <button name="save" class="Submitbtn" type="submit">Submit</button>
            <button name="cancel" class="cancelbtn" type="button" onclick="window.location='Administration page.php'">Cancel</button>
        </div>
    </form>
</div>


<?php
include("../database.php");
include("../table.php");
include("../book.php");
$message = "";
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','LMS_DB');

if(isset($_POST['save'])) {
    $title = $_POST['title'];
    $id = $_POST['accNo'];
    $ISBN = $_POST['isbn'];
    $author = $_POST['AutName'];
    $category_no = $_POST['CatNo'];
    $publisher_name = $_POST['Pubname'];
    $published_date = $_POST['DOP'];
    $publisher_address = $_POST['POP'];
    $price = $_POST['Price'];
    $no_pages = $_POST['NoOfPg'];
    $date_added = date("Y-m-d");
    $book_type = $_POST['Bktype'];
    $book_status = "available";
    $remarks = $_POST['Remarks'];

    $book = new book();
    $sql1 = "Select id FROM books WHERE id = '{$id}' LIMIT 1";
    $result1 = $book->featuredLoad($dbObj, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "This accession number already exists. Please enter correct accession number..!!";
    } elseif (date("Y-m-d",strtotime($published_date)) > date("Y-m-d")) {
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Invalid date..!";
    } elseif ($no_pages <= 0) {
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Invalid Number of Pages..!";
    } elseif ($price < 0) {
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Invalid price..!";
    } else {

        $data = array("id" => $id, "title" => $title, "author" => $author, "ISBN" => $ISBN, "category_no" => $category_no,
            "publisher_name" => $publisher_name, "published_date" => $published_date, "publisher_address" => $publisher_address, "price" => $price,
            "no_pages" => $no_pages, "date_added" => $date_added, "book_type" => $book_type, "book_status" => $book_status, "remarks" => $remarks);

        $book->bind($data);
        $book->insert($dbObj);
        $message = "Book added successfully..!!";
        ?> <style>div.alert{display:inline-block;}</style><?php
        $_POST=array();
    }
}


$dbObj->closeConnection();

?>

<!--this line is for messeage box -->

<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong>&times;</strong></span>
    <?php  echo $message;?>

</div>


</body>
</html>
