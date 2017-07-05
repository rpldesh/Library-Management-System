<?php
session_start();
if (isset($_POST['Issue'])) {
   $id= $_SESSION['id'];
   $member_name= $_SESSION['member_name'];

}

?>


<!DOCTYPE html >
<html >
<head >
    <title > Issue Book </title >
    <link rel = "stylesheet" href = "issueBook.css" />
</head >
<body >
<header >
    <div class="head_top" >
        <div class="logo_name" ><img class="siyanelogo" src = "images/siyane_logo.jpg" >

            <h1 > LIBRARY</h1 >
            <h3 > Siyane National College of Education < br />Veyangoda </h3 >

        </div >
    </div >
    <article class="backgroundimage" >
        <div class="bgimage" >
            <nav >
                <ul >
                    <li ><a href = "Administration Page.php" > HOME</a ></li >
                    <li ><a href = "#" > ADMIN PROFILE </a ></li >
                    <li class="logout" ><a href = "../mainpage.php" > LOGOUT</a ></li >
                </ul >
            </nav >
        </div >
</header >

<div class="bookIssuingForm" >
    <form align = "center" method = "POST" action = "" autocomplete = "off" >
        <div class="container" >
            <h1 > Book Issuing Form </h1 ><hr />
            <label for="memberID" ><b > Member ID </b ></label ><br />
            <h4><?php echo $id ?></h4></br>

            <label for="memberName" ><b > Name with initials </b ></label ><br />
            <h4><?php echo  $member_name?></h4></br>

            <label for="accessionNo" ><b > Accession No </b ></label ><br />
            <input name = "accessionNo" type = "text" placeholder = "Enter Accession No" required /><br />

            <button class="checkbtn" onclick = "window.location=''" name = "checkbtn" type = "submit" > Check</button >

            <label for="bookTitle" ><b > Book Title </b ></label ><br />
            <input name = "bookTitle" type = "text" placeholder = "" required /><br />

            <label for="date" ><b > Date to be Returned </b ></label ><br />
            <input id = "date" name = "DoR" type = "date" /><br />

            <button class="Submitbtn" name = "submit" type = "submit" > Issue</button >
            <button class="cancelbtn" onclick = "window.location='Administration Page.php'" name = "cancelBtn" type = "button" > Cancel</button >
        </div >
    </form >
</div >


</article >

</body >
</html >


