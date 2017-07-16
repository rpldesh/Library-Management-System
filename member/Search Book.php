<!DOCTYPE HTML>
<html>
<head>
    <title>Search Book</title>

    <link rel="stylesheet" href="css/Search Book.css"/>

</head>
<body>

<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education<br />Veyangoda</h3>

        </div>
    </div>
    <div class="bgimage">
        <nav>
            <ul>
                <li><a href="Member%20Page.php">HOME</a></li>
                <li class="backtoSrch"><a href="Search%20Book.php">Back to Search</a></li>
            </ul>
        </nav>
    </div>
</header>



<?php if(!isset($_POST["save"]) ){ ?>

		<div class="searchBook">
			<form  method="POST" action="" autocomplete="off">
				<div class="container">
				<h1>Search a Book</h1><hr />
				    <label><b>Select Search Option</b></label><br /><br />
				    <input class="radioBtn" type="radio" name="searchOption" value="author" required="required"/>Search by Author
                    <input class="radioBtn" type="radio" name="searchOption" value="title" required="required"/>Search by Title<br /><br />
				    <label><b>Author/Title </b></label>
				    <input class="normal" type="search" name="searchName" Placeholder="Enter the Author/Title"/>
				    <button name="save" class="Submitbtn" type="submit">Click Here to Search</button>
				</div>
			</form>
		</div>

<?php }
if (isset($_POST["save"])) {


    include("../database.php");
    include("../table.php");
    include("../book.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');

    $value=$_POST["searchOption"];
    $input=$_POST["searchName"];
    $book = new book();
    $sql = "Select id,category_no,title,author,book_type,book_status from books where $value LIKE '%$input%' ";



    $result = $book->featuredLoad($dbObj,$sql);
    $numOfRows = mysqli_num_rows($result);


?>
<?php if(!$result){ echo "No book found";}
    else{ ?>
    <div style="overflow:auto;">
        <table style="width:100%">
            <caption>Searched Book Reuslt</caption>
            <tr>
                <th>No:</th>
                <th>Accession No</th>
                <th>Category No</th>
                <th>Title</th>
                <th>Author</th>
                <th>Book Type</th>
                <th>Availability</th>
            </tr>

            <?php
            for($i=0;$i<$numOfRows;$i++){?>
            <tr>
                <td><?php echo ($i+1)."." ?></td><?php
                foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                ?>
                <td><?php echo $value ?></td>
                <?php }}?></tr>


        </table>
    </div>
    <?php }?>
    </body>
    </html>
<?php } ?>


