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


/*Getting data for Paging*/
if(!(isset($_GET['startrow']))){
    $startrow=0;
}
else{
    $startrow=(int)$_GET['startrow'];

}
if (!(isset($_POST['search']))) {
    $_SESSION['indicator']='Started';
}

$sql= "Select * from books Limit $startrow,2";

$result = $book->featuredLoad($dbobj,$sql);
$len= mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Catalog</title>
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
            <div class="searchbar">
                <input class="searchtext"  type="search" name="Search" placeholder="Search..">
                <button class="submit_3" type="submit" name="search">Search</button>
            </div>
            <div class="option">
                <input class="radioBtn" type="radio" name="searchOption" value="author" required/>Search by Author
                <input class="radioBtn" type="radio" name="searchOption" value="title" required/>Search by Title<br/>
                <input class="radioBtn" type="radio" name="searchOption" value="isbn" required/>Search by ISBN<br/>

            </div>
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

                <?php
                session_start();



                /*if($_SESSION['indicator']=="error"){
                    header("location: ViewCatalog.php");
                    exit();
                }*/
                if (isset($_POST['search'])) {
                    if(empty($_POST['Search'])){
                        header("location: ViewCatalog.php");
                        exit();
                    }
                    $value = $_POST['searchOption'];
                    $keyword = '"%'.$_POST['Search'].'%"';
                    $_SESSION['indicator']="error";


                    $sql = "Select * from books Where $value like $keyword Limit $startrow,2";

                    $result = $book->featuredLoad($dbobj, $sql);
                    $len=mysqli_num_rows($result);
                }

                for($i=0; $i<$len; $i++){?>
                        <tr>
                        <?php foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                            if($key=="id"){
                                $link= '"bookDetails.php?=id'.$value.'"'?><?php }?>

                            <td><a href=<?php echo $link?>><?php echo $value ?></a></td>
                            <?php } ?>
                        </tr>
                <?php }


                $next=$startrow+2;
                $prev=$startrow-2;?>
        </table>
        <?php $nxtlink = "ViewCatalog.php?startrow=".$next;?>
        <?php $prevlink = "ViewCatalog.php?startrow=".$prev;?>
        <a class="tableNav">
            <a href=<?php echo $nxtlink?>><button class="page" type="submit" name="next">Next</button></a>
            <a href=<?php echo $prevlink?>><button class="page" type="submit" name="prev">Previous</button></a>
        </div>
    </div>



</body>
</html>


