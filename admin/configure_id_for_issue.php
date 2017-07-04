<?php if(!isset($_POST["submitID"])){ ?>
<!DOCTYPE html>
<html>
<head>
    <title>ID configuration for issue</title>
    <link rel = "stylesheet" href ="configure_id.css"/>
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

<div class="idconfigureform">
    <form align="center" method="POST" action="configure_id_for_issue.php" autocomplete="off">
        <div class="container">

            <label for="memberId"><b>Enter Member ID:</b></label><br />
            <input id="memberId" name="memberID" type="text"  required autofocus/><br />

            <button class="Submitbtn" name="submitID" type="submit">Submit</button>
            <button class="cancelbtn" onclick="window.location='Administration Page.html'"name="cancel" type="button" >Cancel</button>
        </div>
    </form>
</div>


</article>

</body>
</html>



<?php }
include("../database.php");
include("../table.php");
include("../member.php");
include("../book_session.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');

if(isset($_POST['submitID'])) {
    $m = new member();
    $result = $m->load($dbObj, $_POST["memberID"]);

?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Member Details and Previous Records</title>
        <link rel = "stylesheet" href="issuePage.css"/>
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




    <?php
    if(!$result){?>

        <div class = "MessageBox"><?php echo "Member does not exist..Incorrect Member ID!!" ?><a href="configure_id_for_issue.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>
    <?php   }


    else {
        $sql2 = "SELECT book_id,book_title,session_status FROM book_sessions WHERE member_id='$m->id' and session_status!='returned'";
        $bs = new book_session();
        $result2 = $bs->featuredLoad($dbObj, $sql2);
        $numOfRows = mysqli_num_rows($result2);

    ?>
    <div style="overflow:auto;">
        <table style="width:100%">
            <caption>Member Details & Previous Records</caption>
            <tr>
                <th>Member ID</th>
                <th>Name with Initials</th>
                <th colspan="4">Books to be returned</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>No.</td>
                <td>Accession No</td>
                <td>Title</td>
                <td>Status</td>

            </tr>
            <tr>

                <td rowspan="<?php echo $numOfRows?>"> <?php echo $m->id?></td>
                <td rowspan="<?php echo $numOfRows?>"> <?php echo $m->member_name?></td>
            <?php
            for($i=0;$i<$numOfRows;$i++){?>

                <td><?php echo $i+1 ?></td>

                <?php

                foreach (mysqli_fetch_assoc($result2) as $key=>$value) {
                        ?><td ><?php echo $value ?></td>
                        <?php
                    }?>

                </tr>

            <?php } ?>

        </table>

        <button class="Submitbtn" type="button" onclick="window.location='issueBook.php'" name="Issue">Go to Issuing Form</button>
        <button class="cancelbtn" type="button" onclick="window.location='Administration Page.html'" name="cancel">Cancel</button>


    </div>
    </article>
    <?php } ?>
    </body>
    </html>
<?php } ?>
