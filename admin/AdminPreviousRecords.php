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
                <li><a href="Administration%20Page.php">HOME</a></li>
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
         $sql = "Select id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value = $keyword Limit $startrow,5";

         // To get the count of element which are added to the table
         $sqlZero = "Select id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value = $keyword";
         $resultCount = $bk_sess->featuredLoad($dbObj,$sqlZero);
         $No_Pages=mysqli_num_rows($resultCount)/5;

     }

     else{

         $keyword = '"%'.$_POST['Search'].'%"';
         $sql = "Select id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value like $keyword Limit $startrow,5";

         // To get the count of element which are added to the table
         $sqlZero = "Select id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value LIKE $keyword";
         $resultCount = $bk_sess->featuredLoad($dbObj,$sqlZero);
         $No_Pages=mysqli_num_rows($resultCount)/5;

     }


    $result = $bk_sess->featuredLoad($dbObj, $sql);
    $numOfRows=mysqli_num_rows($result);

    if($numOfRows==0)
    {
        if($value=='id') {
            $startrow = $startrow - 5;
            $keyword = '"' . $_POST['Search'] . '"';
            $sql = "Select id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value = $keyword ORDER By`book_sessions`.`date_of_borrowal` DESC Limit $startrow,5";
        }

        else {

            $keyword = '"%' . $_POST['Search'] . '%"';
            $sql = "Select id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions Where $value like $keyword ORDER By`book_sessions`.`date_of_borrowal` DESC Limit $startrow,5";
        }

        $result = $bk_sess->featuredLoad($dbobj, $sql);
        $numOfRows=mysqli_num_rows($result);
    }

}
else{
    $bk_sess = new book_session();

    // To get the count of element which are added to the table
    $sqlZero = "Select book_id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions";
    $resultCount = $bk_sess->featuredLoad($dbObj,$sqlZero);
    $No_Pages=mysqli_num_rows($resultCount)/5;


       $sql = "Select book_id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions ORDER By`book_sessions`.`date_of_borrowal` DESC Limit $startrow,5";

    $result = $bk_sess->featuredLoad($dbObj,$sql);
    $numOfRows = mysqli_num_rows($result);

    // If the page is over then return tha last page again
    if($numOfRows==0 && $startrow!=0)
    {
        $startrow =$startrow-5;
        $sql = "Select book_id,book_title,member_id,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions ORDER By`book_sessions`.`date_of_borrowal` DESC Limit $startrow,5";
        $result = $bk_sess->featuredLoad($dbObj, $sql);
        $numOfRows=mysqli_num_rows($result);
    }
}

if(!$result){ echo "No records found";}
else{ ?>
    <div style="" class="addminprevRcd">
        <table style="width:100%">
            <caption>Previous Records</caption>
            <tr>
                <th>No:</th>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Borrower</th>
                <th>Date of Borrowal</th>
                <th>Date to be Returned</th>
                <th>Date of Return</th>
            </tr>

            <?php
            for($i=0;$i<$numOfRows;$i++){?>
            <tr>
                <td><?php echo ($startrow+$i+1)."." ?></td><?php
                foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                    ?>
                    <td><?php echo $value ;?></td>
                <?php } echo "<br />";}?></tr>

            <?php
            $next=$startrow+5;
            $prev=$startrow-5;
            $prevlink = "AdminPreviousRecords.php?startrow=".$prev;
            $nxtlink = "AdminPreviousRecords.php?startrow=".$next;?>

            <div class="tableNav" align="centre">
                <a class="button" href=<?php echo $prevlink?>>&laquo; Previous</a>
                <div class="pagePoint">
                    <?php for($i=0; $i<$No_Pages; $i++){
                        $page_startrow=0+5*$i;
                        $page_link="AdminPreviousRecords.php?startrow=".$page_startrow;?>
                        <a class="pagination" href=<?php echo $page_link?>> <?php echo $i+1?></a>

                    <?php }?>
                </div>
                <a id="nextbtn" class="button" href=<?php echo $nxtlink?>>Next &raquo;</a>

            </div>
        </table>

<?php }?>
</body>
</html>



