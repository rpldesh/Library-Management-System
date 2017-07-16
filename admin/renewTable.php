<!DOCTYPE HTML>
<html>
<head>
    <title>Books to be Returned</title>
    <link rel="stylesheet" href="css/renewPage.css"/>
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
                        <li><a href="Administration%20Page.php?id=back">HOME</a></li>

                    </ul>
                </nav>
            </div>
    </header>

    <?php
    session_start();
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include("../book_session.php");
    include ("calculateFine.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $message='';
    $member = new member();
    $loadResult = $member->load($dbObj,$_SESSION['ID']);
    $_SESSION['ID'] = $member->id;
    $_SESSION['Name'] = $member->member_name;
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
                <td><p><b>Title</b></p></body></td>
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
                <td><?php echo date("Y-m-d", strtotime($value)) ?></td><?php
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
        <form action="" method="post">
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
<button class="cancelbtn" type="button" onclick="window.location='Administration Page.php?id=back'" name="cancel">Cancel</button>



</body>
</html>
<?php

if(isset($_POST["renewBTN"])) {
    if (!isset($_POST["bookIds"])) {
        $message = "Please select at least one book to proceed";
        ?>
        <style>div.alert {
                display: inline-block;
            }</style>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closbtnlink" href="renewTable.php">&times;</a></strong></span>
            <?php echo $message; ?>

        </div>
        <?php
    } else {
        $bookIds = $_POST["bookIds"];
        $_SESSION['bookIds'] = $bookIds;
        header("Location:renewBook.php");
    }
}
$dbObj->closeConnection();
?>

