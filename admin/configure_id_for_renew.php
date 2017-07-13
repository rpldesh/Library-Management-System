<?php
session_start();
if(!isset($_POST["submitID"])){ ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>ID configuration for Renewal</title>
        <link rel = "stylesheet" href ="css/configure_id.css"/>
    </head>
    <body>
    <header>
        <script type="text/javascript">
            function validate(){
                var missingField=false;
                var strFields="";
                if(id_config.memberID.value==""){
                    missingField=true;
                    strFields+="Plese enter a member ID";
                }
                if(missingField){
                    alert("Sorry! You must provide following fields to continue:\n"+strFields);
                    return false;
                }
                return true;
            }
        </script>
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
                        <li><a href="Administration Page.php">HOME</a></li>

                    </ul>
                </nav>
            </div>
    </header>

    <div class="idconfigureform">
        <form name="id_config"class="Form" align="center" method="POST" action="" autocomplete="off">
            <div class="container">

                <label for="memberId"><b>Enter Member ID:</b></label></br>
                <input id="memberId" name="memberID" type="text"  required autofocus/></br >

                <button class="Submitbtn" name="submitID" type="submit" onclick="validate()">Submit</button>
                <button class="cancelbtn" onclick="window.location='Administration Page.php'" name="cancel" type="button" >Cancel</button>
            </div>
        </form>
    </div>


    </article>

    </body>
    </html>

<?php }

if(isset($_POST["submitID"])){
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include("../book_session.php");
    include ("calculateFine.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $message='';
    $member = new member();
    $loadResult = $member->load($dbObj,$_POST["memberID"]);
    $_SESSION['ID'] = $member->id;
    $_SESSION['Name'] = $member->member_name;
    ?>
    <!DOCTYPE HTML>
    <head>
        <title>Books to be Returned</title>
        <link rel="stylesheet" href="css/renewPage.css"/>
    </head>
    <form>

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
                        <li><a href="Administration%20Page.php">HOME</a></li>

                    </ul>
                </nav>
            </div>
    </header>


    <?php if(!$loadResult){
        $message="Member does not exist..!!";?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a href="configure_id_for_renew.php">&times;</a></strong></span>
            <?php  echo $message;?>

        </div>
    <?php }
    else {
        $sql = "Select book_id,book_title,date_of_borrowal,date_to_be_returned,session_status from book_sessions where member_id = '$member->id' and session_status != 'returned'";
        $bkSession = new book_session();
        $result = $bkSession->featuredLoad($dbObj,$sql);
        $numOfRows = mysqli_num_rows($result);
        ?>

        <div style="overflow:auto;">
            <table style="width:100%">
                <caption>Member Details & Previous Records</caption>
                <tr>
                    <th>Member ID</th>
                    <th>Name with Initials</th>
                    <th>Member Type</th>
                    <th colspan="7">Books to be returned</th>
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
        <td><p><b>Selection</b></p></td>

        </tr>
        <tr>

        <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->id?></td>
        <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->member_name?></td>
        <td rowspan="<?php echo $numOfRows?>"> <?php echo $member->member_type?></td>
        <?php

        for($i=0;$i<$numOfRows;$i++) {
            $book_id=null;
            $allowed=true;
            ?>
            <td><?php echo ($i + 1) . "." ?></td><?php
            foreach (mysqli_fetch_assoc($result) as $key => $value) {
                if ($key == 'date_to_be_returned') {
                    if (date("Y-m-d") > date("Y-m-d", strtotime($value))) {
                        $allowed = false;
                        $fine = calculateFine($value);
                        ?>
                        <td><p
                            style="color: red"><?php echo $value . "    Expired" . "</br>" . "Fine : " . $fine  ?></p>
                        </td><?php
                    } elseif (date("Y-m-d") <= date("Y-m-d", strtotime($value))) {
                        ?>
                        <td><?php echo $value . "    Not Expired" ?></td><?php
                    }
                } elseif ($key == 'date_of_borrowal') {
                    if (date("Y-m-d") == date("Y-m-d", strtotime($value))) {
                        $allowed = false; ?>
                        <td><p style="color: Green"><?php echo date("Y-m-d", strtotime($value)) ?></p></td><?php
                    } else {
                        ?>
                        <td><?php echo date("Y-m-d", strtotime($value)) ?></td>><?php
                    }
                } elseif ($key == 'session_status') {
                    if ($value == "extended") {
                        $allowed = false; ?>
                        <td><p style="color:red"><?php echo $value ?></p></td><?php
                    } else {
                        ?>
                        <td><?php echo $value ?></td><?php
                    }
                } elseif($key=='book_id'){
                    $book_id=$value
                    ?>
                    <td><?php echo $value ?></td>
                    <?php
                }
                else{
                    ?>
                    <td><?php echo $value ?></td>
                    <?php
                }

            }
            if ($allowed) {
                    ?>
                    <td>
                    <form action="renewBook.php" method="post">
                        <input type="checkbox" name="bookIds[]" value="<?php echo $book_id?>"/><?php echo "Allowed" ?>
                    </td><?php
            } else {
                    ?>
                    <td><?php echo "Not Allowed"?></td>
                    <?php
            }

            ?>
            </tr><?php
        }
?>

        </table>
        </div>

            <button class="renewBTN" type="submit" name="renewBTN">Renew Book/Books</button>
            <button class="cancelbtn" type="button" onclick="window.location='Administration Page.php'" name="cancel">Cancel</button>



        </body>
        </html>
    <?php }$dbObj->closeConnection();
    } ?>

