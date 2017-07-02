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
$sql = "Select * from book_sessions where member_id = '3'";
$bkSession = new book_session();
$result = $bkSession->featuredLoad($dbObj,$sql);
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
    <title></title>
    <link rel="stylesheet" href="../Table%20Page.css"/>
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
        <?php
        /*
        for($i=0;$i<mysqli_num_rows($result);$i++){
            foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                echo $key."------".$value . "<br />";
            }echo "<br />";
        }*/
        ?>
        <tr>
            <?php
            foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                ?>
                <th><?php echo $key ?></th>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td>150377G</td>
            <td>A.S.Madhushanki</td>
            <td>1995/NOV/27</td>
            <td>Gampaha</td>
            <td>pending</td>
            <td>3</td>
        </tr>
        <tr>
            <td>150301V</td>
            <td>I.M.A.S.Karunarathne</td>
            <td>1995/SEP/28</td>
            <td>Bemulla</td>
            <td>pending</td>
            <td>2</td>
        </tr>
        <tr>
            <td>150574H</td>
            <td>D.A.D.P.Senarath</td>
            <td>1995/JUL/21</td>
            <td>pallewela</td>
            <td>pending</td>
            <td>1</td>
        </tr>
    </table>
</div>

</body>
</html>




