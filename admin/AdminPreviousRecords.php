<!DOCTYPE html>
<html>
<head>
    <title>Previous Record Page</title>
    <link rel = "stylesheet" href ="../member/css/Search%20Book.css"/>
    <link rel = "stylesheet" href ="../member/css/Search%20Book%20Result.css"/>
    <link rel = "stylesheet" href ="css/ViewCatalog.css"/>

</head>
<body>
<header>
    <div class="head_top"><img class="siyanelogo" src="images/siyane_logo.jpg">
        <div class="logo_name">
            <h1>LIBRARY</h1>
            <h3>Siyane National College Of Education<br />Veyangoda</h3>
        </div>
    </div>
    <div class="bgimage">
        <nav>
            <ul>
                <li><a href="Member Page.php">HOME</a></li>
                <li class="logout"><a href="../index.php">LOGOUT</a></li>
            </ul>
        </nav>
    </div>
</header>

<div>
    <form action="AdminPreviousRecords.php" method="post">
        <div class="searchbar">
            <input class="searchtext"  type="search" name="Search" placeholder="Search..">
            <button class="submit_3" type="submit" name="search">Search</button>
        </div>
        <div class="option">
            <input class="radioBtn" type="radio" name="searchOption" value="id" required/>Search by ID
            <input class="radioBtn" type="radio" name="searchOption" value="book_title" required/>Search by Title<br/>
        </div>
    </form>

</div>

<?php
include("../database.php");
include("../table.php");
include("../book.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');

/*Getting data for Paging*/
if(!(isset($_GET['startrow']))){
    $startrow=0;
}
else {
    $startrow = (int)$_GET['startrow'];
}


if (isset($_POST['search'])) {

    if(empty($_POST['Search'])){
        header("location: AdminPreviousRecords.php");
        exit();
    }
    $value = $_POST['searchOption'];
    $bk_sess = new book_session();
     if($value=='id'){
         $keyword = '"'.$_POST['Search'].'"';
         $sql = "Select id,book_title,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value = $keyword Limit $startrow,2";
     }

     else{

         $keyword = '"%'.$_POST['Search'].'%"';
         $sql = "Select id,book_title,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value like $keyword Limit $startrow,2";
     }


    $result = $bk_sess->featuredLoad($dbObj, $sql);
    $numOfRows=mysqli_num_rows($result);
}
else{
    $bk_sess = new book_session();
    $sql = "Select id,book_title,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Limit $startrow,2 ";
    $result = $bk_sess->featuredLoad($dbObj,$sql);
    $numOfRows = mysqli_num_rows($result);
}



?>
<?php if(!$result){ echo "No records found";}
else{ ?>
    <div style="overflow:auto;" class="addminprevRcd">
        <table style="width:100%">
            <caption>Previous Records</caption>
            <tr>
                <th>No:</th>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Date of Borrowal</th>
                <th>Date to be Returned</th>
                <th>Date of Return</th>
            </tr>

            <?php
            for($i=0;$i<$numOfRows;$i++){?>
            <tr>
                <td><?php echo ($i+1)."." ?></td><?php
                foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                    ?>
                    <td><?php echo $value ;?></td>
                <?php } echo "<br />";}?></tr>


        </table>
        <?php
            $next=$startrow+2;
            $prev=$startrow-2;
                $prevlink = "AdminPreviousRecords.php?startrow=".$prev;?>
        <?php $nxtlink = "AdminPreviousRecords.php?startrow=".$next;?>

        <a class="tableNav">
            <a href=<?php echo $prevlink?>><button class="page" type="submit" name="prev">Previous</button></a>
            <a href=<?php echo $nxtlink?>><button class="page" type="submit" name="next">Next</button></a>

    </div>
<?php }?>
</body>
</html>



