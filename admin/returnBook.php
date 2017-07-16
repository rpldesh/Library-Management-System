<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Books Returned</title>
    <link rel="stylesheet" href="css/returnPage.css"/>
    <style>div.alertMsg{display: none;}</style>
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
                    <li><a href="Administration%20Page.php?id=backFromReturn">HOME</a></li>
                </ul>
            </nav>
        </div>
</header>

    <style>div.alertMsg {
            display: inline-block;
        }</style><?php
    $msg = "Returned successfully..!!";


?>
<div class="alertMsg">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong><a class="closeIcon" style="text-decoration: none; color: white" href="Administration%20Page.php?id=backFromReturn">&times;</a></strong></span>
    <?php  echo $msg;?>

</div>
</body>
</html>
