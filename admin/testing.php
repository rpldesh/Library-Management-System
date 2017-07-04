<?php
include("../database.php");
include("../table.php");
include("../member.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
if(isset($_POST['submit'])) {
    $m = new member();
    $result=$m->load($dbObj, $_POST["memberID"]);
    if(!$result){?>

       <div class = "MessageBox"><?php echo "Member does not exist..!!" ?><a href="config_id.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>
    <?php   }


    else{
        echo $m->id;
        echo $m->member_name;
        $sql2="SELECT book_id,book_title,session_status FROM book_sessions WHERE member_id='$m->id' and session_status!='returned'";
        $bs=new book_session();
        $result2=$bs->featuredLoad($dbObj,$sql2);
        $numOfRows=mysqli_num_rows($result2);
       /* $objectArray=null;
        if($result2){
            $objectArray = mysqli_fetch_assoc($result2);
        }
        if($objectArray!=null) {
            $rows=$objectArray;
            foreach ($rows as $key => $value) {
                /*if ($key == 'member_id' || $key == 'book_status') {
                    continue;
                }

                $bs->$key = $value;
                echo $bs->book_id ." ".$bs->book_title;
            }*/




    }

}
?>