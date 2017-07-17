<!DOCTYPE html>
<html>
<head>
    <title>Previous Record Page</title>
    <link rel = "stylesheet" href ="css/Search%20Book.css"/>
    <link rel = "stylesheet" href ="css/Search%20Book%20Result.css"/>
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
            </ul>
        </nav>
    </div>
</header>

<?php

    session_start();
    include("../database.php");
    include("../table.php");
    include("../book.php");
    include("../book_session.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $user_id=$_SESSION['id'];

    /*Getting data for Paging*/
    if(!(isset($_GET['startrow']))){
     $startrow=0;
    }
    else {
        $startrow = (int)$_GET['startrow'];
    }

$bk_sess = new book_session();
    // To get the count of element which are added to the table
    $sqlZero = "Select id,book_title,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions where member_id = '$user_id' Limit $startrow,5";
    $resultCount = $bk_sess->featuredLoad($dbObj,$sqlZero);
    $No_Pages=mysqli_num_rows($resultCount)/5;

    $sql = "Select id,book_title,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions where member_id = '$user_id' Limit $startrow,5";
    $result = $bk_sess->featuredLoad($dbObj,$sql);
    $numOfRows = mysqli_num_rows($result);

    // If the page is over then return tha last page again
    if(($numOfRows==0)&&($startrow!=0))
    {
     $startrow =$startrow-5;
     $sql = "Select id,book_title,date_of_borrowal,date_to_be_returned,date_of_return from book_sessions where member_id = '$user_id' Limit $startrow,5";
     $result = $bk_sess->featuredLoad($dbObj, $sql);
     $len=mysqli_num_rows($result);
    }



?>
<?php if(!$result){ echo "No records found";}
else{ ?>
    <div>
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
                    <td><?php echo ($startrow+$i+1)."." ?></td><?php
                    foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                        ?>
                        <td><?php echo $value ;?></td>
                    <?php } echo "<br />";}?></tr>

            <?php
            $next=$startrow+5;
            if(!$startrow==0){$prev=$startrow-5;}
            else{$prev=0;}
            $prevlink = "Previous%20Records.php?startrow=".$prev;?>
            <?php $nxtlink = "Previous%20Records.php?startrow=".$next;?>


            <div class="tableNav" align="centre">
                <a class="button" href=<?php echo $prevlink?>>&laquo; Previous</a>
                <div class="pagePoint">
                    <?php for($i=0; $i<$No_Pages; $i++){
                        $page_startrow=0+2*$i;
                        $page_link="Previous%20Records.php?startrow=".$page_startrow;?>
                        <a class="pagination" href=<?php echo $page_link?>> <?php echo $i+1?></a>

                    <?php }?>
                </div>
                <a id="nextbtn"class="button" href=<?php echo $nxtlink?>>Next &raquo;</a>


            </div>

        </table>

<?php }?>
</body>
</html>



