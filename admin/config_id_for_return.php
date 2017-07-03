<?php

/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 02-Jul-17
 * Time: 12:51 AM
 */
//include("configure_id.php");
include("../database.php");
include("../table.php");
include("../member.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
$sql = "Select book_id, from book_sessions where member_id = '3'";
$bkSession = new book_session();
$result = $bkSession->featuredLoad($dbObj,$sql);
$objList = mysqli_fetch_assoc($result);
/*for($i=0;$i<mysqli_num_rows($result);$i++){
    foreach (mysqli_fetch_assoc($result) as $key=>$value) {
        echo $key."------".$value . "<br />";
    }echo "<br />";
}*/
//}
//while ($row = mysqli_fetch_assoc($result1)){
  //  print_r($row);
//}


//foreach($solution as $tata){
  //  echo $tata."<br />";
//}
    //echo date("m/d/y", $value);
//}


?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Return Book</title>
    <link rel="stylesheet" href="Table%20Page.css"/>
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



<div style="overflow:auto;">
    <table style="width:100%">
        <caption>Books To Be Returned</caption>

        <tr>
            <th>Book Accession Number</th>
            <th>Book Name</th>
            <th>Date of Borrowal</th>
            <th>Date to be Returned</th>
            <th>Status</th>
        </tr>
        <tr>
            <?php
            for($i=0;$i<mysqli_num_rows($result);$i++){
                ?><tr><?php
                foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                    ?>
                    <td><?php echo $value ?></td>
                <?php
                }?>
         </tr><?php
            }
            ?>

    </table>
</div>

</body>
</html>




