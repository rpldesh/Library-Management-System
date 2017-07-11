


<!DOCTYPE html>
<html>
<head>
    <title>Add Book Page</title>
    <link rel = "stylesheet" href ="css/AddBook.css"/>
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
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.php">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>
<?php if(!isset($_POST['save'])){?>

<div class="addbkform">
    <form  method="POST" action="" autocomplete="off">
        <div class="container">
            <h1>Book Registration Form</h1><hr />
            <label for="AccNo"><b>Accession Number</b></label><br />
            <input id="AccNo" name="accNo" type="text" placeholder="Enter Accession Number" value="<?php if (isset($_POST['accNo'])) echo $_POST['accNo']; ?>" required autofocus/><br />
            <label for="title"><b>Titile</b></label><br />
            <input id="title" name="title" type="text" placeholder="Enter Title" required autofocus/><br />
            <label for="bktype"><b>Book Type</b></label><br />
            <select id="bktype" name="Bktype" required><br />
                <option value="borrowable" >Borrowable</option><option value="reference" >Reference</option></select>
            <label for="autname"><b>Author</b></label><br />
            <input id="autname" name="AutName" type="text" placeholder="Enter Author" required/><br />
            <label for="isbn"><b>ISBN</b></label><br />
            <input id="isbn" name="isbn" type="text" placeholder="Enter Accession Number"autofocus/><br />
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
            <textarea id="remarks" name="Remarks" cols="40" rows="6"></textarea><br />
            <button name="save" class="Submitbtn" type="submit">Submit</button>
            <button name="cancel" class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>
</div>
<?php }
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
        $message = "This accession number already exists. Please enter correct accession number..!!";
    } elseif (date("Y-m-d",strtotime($published_date)) > date("Y-m-d")) {
        $message = "Invalid date..!";
    } elseif ($no_pages <= 0) {
        $message = "Invalid Number of Pages..!";
    } elseif (is_float($price + 0) && ($price < 0)) {
        $message = "Invalid price..!";
    } else {

        $data = array("id" => $id, "title" => $title, "author" => $author, "ISBN" => $ISBN, "category_no" => $category_no,
            "publisher_name" => $publisher_name, "published_date" => $published_date, "publisher_address" => $publisher_address, "price" => $price,
            "no_pages" => $no_pages, "date_added" => $date_added, "book_type" => $book_type, "book_status" => $book_status, "remarks" => $remarks);

        $book->bind($data);
        $book->insert($dbObj);
        $message = "Book added successfully..!!";
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
