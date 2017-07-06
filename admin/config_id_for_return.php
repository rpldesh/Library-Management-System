<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 02-Jul-17
 * Time: 12:51 AM
 */
if(!isset($_POST["submitID"]) ){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>ID configuration for Returning</title>
        <link rel = "stylesheet" href ="css/config_if_for_return.css"/>
    </head>
    <body>
    <header>
        <div class="head_top">
            <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

                <h1>LIBRARY</h1>
                <h3>Siyane National College of Education</br>Veyangoda</h3>

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
        <form class="Form" align="center" method="POST" action="" autocomplete="off">
            <div class="container">

                <label for="memberId"><b>Enter Member ID:</b></label><br />
                <input id="memberId" name="memberID" type="text"  required autofocus/><br />

                <button class="Submitbtn" name="submitID" type="submit">Submit</button>
                <button class="cancelbtn" onclick="window.location='Administration Page.php'" name="cancel" type="button" >Cancel</button>
            </div>
        </form>
    </div>


    </article>

    </body>
    </html>

<?php }

if (isset($_POST["submitID"])){
    session_start();
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include("../book_session.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');

    $member = new member();
    $loadResult = $member->load($dbObj,$_POST["memberID"]);
    $_SESSION['ID'] = $member->id;
    $_SESSION['Name'] = $member->member_name;
    ?>
    <!DOCTYPE HTML>
    <head>
        <title>Books to be Returned</title>
        <link rel="stylesheet" href="css/returnPage.css"/>
    </head>
    <form>

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


    <?php if(!$loadResult){ ?>
        <div class = "MessageBox"><?php echo "Member does not exist..!!" ?><a href="config_id_for_return.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>
    <?php }
    else {
        $sql = "Select book_id,book_title,date_of_borrowal,date_to_be_returned,session_status from book_sessions where member_id = '$member->id' and session_status != 'returned'";
        $bkSession = new book_session();
        $result = $bkSession->featuredLoad($dbObj,$sql);
        $numOfRows = mysqli_num_rows($result);
        //$delayedBooks = array();
        ?>

        <div style="overflow:auto;">
            <table style="width:100%">
                <caption>Member Details & Previous Records</caption>
                <tr>
                    <th>Member ID</th>
                    <th>Name with Initials</th>
                    <th>Member Type</th>
                    <th colspan="6">Books to be returned</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p><b>No.</b></p></td>
                    <td><p><b>Accession No</b></p></td>
                    <td><p><b>Title</b></p></form></td>
                    <td><p><b>Date of Borrowal</b></p></td>
                    <td><p><b>Date to be Returned</b></p></td>
                    <td><p><b>Status</b></p></td>
                </tr>
                <tr>

                    <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->id?></td>
                    <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->member_name?></td>
                    <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->member_type?></td>
                    <?php
                    //$count = 0;
                    for($i=0;$i<$numOfRows;$i++){
                        ?><td><?php echo ($i+1)."." ?></td><?php
                        foreach (mysqli_fetch_assoc($result) as $key=>$value) {
                            if($key == 'date_to_be_returned') {
                                //$return_date = strtotime($value);
                                if (date("Y-m-d") > date("Y-m-d", strtotime($value))) {
                                    //$count = $count+1;
                                    $start = strtotime($value);
                                    $end = time();
                                    $noOfDays = ceil(abs($end - $start) / 86400);
                                    $fine = $noOfDays -2;
                                    ?><td><p style="color: red"><?php echo $value ."    Expired"."<br />"."Fine : "."Rs.".$fine.".00" ?></p></td><?php
                                }if (date("Y-m-d") <= date("Y-m-d", strtotime($value))) {
                                    ?><td><?php echo $value ."    Not Expired" ?></td><?php
                                }
                            }elseif($key == 'book_id'){
                                ?><td><form action="returnBook.php" method="post">
                                    <input type="checkbox" name="bookIds[]" value=<?php echo $value ?> required/><?php echo $value ?>

                                </td>
                            <?php } else{
                            ?><td><?php echo $value ?></td>
                        <?php
                        }}?>
                 </tr><?php
                    }
                    ?>

            </table>
        </div>
        <button class="returnBTN" type="submit" name="returnBTN">Return Book/Books</button></form>
        <form class="clicks" action="issueBook.php" method="post">
            <button class="cancelbtn" type="button" onclick="window.location='Administration Page.php'" name="cancel">Cancel</button>
        </form>


    </body>
    </html>
<?php }$dbObj->closeConnection();} ?>

