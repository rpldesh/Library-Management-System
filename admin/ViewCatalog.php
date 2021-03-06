<?php
/**
 * Created by PhpStorm.
 * User: Dell-PC
 * Date: 7/6/2017
 * Time: 6:22 PM
 */
session_start();
$session_value=(isset($_SESSION['adminType']))?$_SESSION['adminType']:'';

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

// To count the number of elements which are added to the table
$sqlZero = "Select * from books where 1";
$resultCount = $book->featuredLoad($dbobj,$sqlZero);
$No_Pages=mysqli_num_rows($resultCount)/5;
$sql= "Select * from books Limit $startrow,5";

$result = $book->featuredLoad($dbobj,$sql);
$len= mysqli_num_rows($result);

// If the page is over then return tha last page again
if($len==0)
{
    $startrow =$startrow-5;
    $sql = "Select * from books Limit $startrow,5";
    $result = $book->featuredLoad($dbobj, $sql);
    $len=mysqli_num_rows($result);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>View Catalog</title>
    <link rel = "stylesheet" href ="css/ViewCatalog.css"/>
    <script type="text/javascript">
        <!--
        function allowLibrarianOnly() {
            var adminType= "<?php echo $session_value; ?>";
            if(adminType == "librarian"){
                return true;
            }else{
                alert("The area you are trying to enter is restricted to your admin type.\nPlease login as a valid admin.");
                return false;
            }
        }
        -->
    </script>

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
                </ul>
            </nav>
        </div>
</header>
</article>

    <div class="searchbox" >
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

    <div class="Catelogtable" style="...">
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


                    $sql = "Select * from books Where $value like $keyword Limit $startrow,5";
                    $result = $book->featuredLoad($dbobj, $sql);
                    $len=mysqli_num_rows($result);


                    // To count the number of elements which are added to the table
                    $sqlZero = "Select * from books Where $value like $keyword";
                    $resultCount = $book->featuredLoad($dbobj,$sqlZero);
                    $No_Pages=mysqli_num_rows($resultCount)/5;

                    if($len==0)
                    {
                        $startrow =$startrow-5;
                        $sql = "Select * from books Where $value like $keyword Limit $startrow,5";
                        $result = $book->featuredLoad($dbobj, $sql);
                        $len=mysqli_num_rows($result);}
                    }

                for($i=0; $i<$len; $i++){?>
                        <tr>
                        <?php foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                            if($key=="id"){
                                $link= '"bookDetails.php?id='.$value.'"'?><?php }?>

                            <td><a class="contentLink" onclick="return allowLibrarianOnly();" href=<?php echo $link?> ><?php echo $value ?></a></td>
                            <?php } ?>
                        </tr>
                <?php }

                $next=$startrow+5;

                if(!$startrow==0){$prev=$startrow-5;}
                else{$prev=0;}?>

        <?php $prevlink = "ViewCatalog.php?startrow=".$prev;?>
        <?php $nxtlink = "ViewCatalog.php?startrow=".$next;?>

        <div class="tableNav" align="centre">
            <a class="button" href=<?php echo $prevlink?>>&laquo; Previous</a>
            <div class="pagePoint">
                <?php for($i=0; $i<$No_Pages; $i++){
                    $page_startrow=0+5*$i;
                    $page_link="ViewCatalog.php?startrow=".$page_startrow;?>
                    <a class="pagination" href=<?php echo $page_link?>> <?php echo $i+1?></a>

                <?php }?>
            </div>
            <a id="nextbtn"class="button" href=<?php echo $nxtlink?>>Next &raquo;</a>

        </div>
        <p align="centre" ><?php $error?></p>
    </div>
    </table>




</body>
</html>


