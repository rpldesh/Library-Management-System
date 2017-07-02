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
for($i=0;$i<mysqli_num_rows($result);$i++){
    foreach (mysqli_fetch_assoc($result) as $key=>$value) {
        echo $key."------".$value . "<br />";
    }echo "<br />";
}
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




