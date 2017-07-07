<?php
/**
 * Created by PhpStorm.
 * User: Dell-PC
 * Date: 7/6/2017
 * Time: 6:22 PM
 */


include ("../database.php");
include("../table.php");
include("../book.php");

$dbobj= database::getInstance();
$dbobj->connect('localhost','root','','lms_db');
$book = new book();
$sql= "Select * from books";

$result = $book->featuredLoad($dbobj,$sql);
$len= mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Admin Member</title>
    <link rel = "stylesheet" href ="css/ViewCatalog.css"/>

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
</article>

    <div>

        <form action="ViewCatalog.php" method="post">
            <input class="search" type="search" name="Search" placeholder="Search..">
            <input class="radioBtn" type="radio" name="searchOption" value="author"/>Search by Author
            <input class="radioBtn" type="radio" name="searchOption" value="title"/>Search by Title<br />
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <div style="...">
        <table style"...">
            <caption> <b>Catalog</b></caption>
            <tr>
                <th>ID:</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Catagory No</th>
                <th>Publisher</th>
                <th>Published Date</th>
                <th>Publishers Address</th>
                <th>Price</th>
                <th>No of Pages</th>
                <th>Added Date</th>
                <th>Book Type</th>
                <th>Book Status</th>
                <th>Remarks</th>
            </tr>

            <tr>
                <?php
                if (isset($_POST['search'])) {
                    $value = $_POST['searchOption'];
                    $keyword = '"%'.$_POST['Search'].'%"';
                    echo $keyword;

                    $sql = "Select * from books Where $value like $keyword";
                    echo $sql;
                    $result = $book->featuredLoad($dbobj, $sql);
                    $len=mysqli_num_rows($result);
                }

                for($i=0; $i<$len; $i++){
                        foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                            ?>
                            <td><?php echo $value ?></td>
                            <?php } ?>
            </tr>
                <?php  }?>

        </table>
    </div>



</body>
</html>


