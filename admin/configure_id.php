<!DOCTYPE html>
<html>
<head>
    <title>ID configuration</title>
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
    <form align="center" method="POST" action="testing.php" autocomplete="off">
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

<?php





?>