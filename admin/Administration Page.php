<?php session_start();
$session_value=(isset($_SESSION['adminType']))?$_SESSION['adminType']:'';
$welcomeMsg="";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration Page</title>
		<link rel = "stylesheet" href ="css/Administration Page.css"/>
        <style> div.alert{display: none;}</style>
        <script type="text/javascript">
            <!--
            function allowLibrarianClerk() {
                var adminType= "<?php echo $session_value; ?>";
                if(adminType == "clerk" || adminType == "librarian"){
                    return true;
                }else{
                    alert("The area you are trying to enter is restricted to your admin type");
                    return false;
                }
            }
            function allowLibrarianOnly() {
                var adminType= "<?php echo $session_value; ?>";
                if(adminType == "librarian"){
                    return true;
                }else{
                    alert("The area you are trying to enter is restricted to your admin type");
                    return false;
                }
            }
            function allowLibrarianAudit() {
                var adminType= "<?php echo $session_value; ?>";
                if(adminType == "librarian" || adminType == "audit"){
                    return true;
                }else{
                    alert("The area you are trying to enter is restricted to your admin type");
                    return false;
                }
            }
            //-->
        </script>

	</head>
<body>
	<header>
        <div class="head_top"><img class="siyanelogo" src="images/siyane_logo.jpg"/>
	<div class="logo_name">
		<h1>LIBRARY</h1>
		<h3>Siyane National College Of Education<br />Veyangoda</h3>
	</div>
	</div>
	<div class="bgimage">
	<nav>
		<ul>
<<<<<<< HEAD

			<li><a href="adminDetailSettings.php">Admin Profile</a></li>
=======
            <li><a href="#">HOME</a></li>
            <li><a href="#">Admin Profile</a></li>
>>>>>>> 3bd620eaba1b7bcd91c6677726617bf7a43d7cdd

            <?php
            if(!empty($_SESSION['username'])){ ?>
                <li class="logout" ><a href="Admin%20Login.php?id=adminLogout" id="adminLogout">LOGOUT</a></li>
            <?php } ?>

        </ul>
	</nav>
	</div>
	</header>
		<article>
            <?php
            if(!empty($_SESSION['username'])){
                $welcomeMsg= " Welcome to Siyane National College of Education Library Administration Page ".$_SESSION['adminName']."...!!!";
            }
            ?>
            <p class="WelMsg"><?php echo $welcomeMsg;?></p>

            <div class="linkbox" id="addbook"><span><strong>Add Book</strong><br /><br /></span>
                <a href="AddBook.php" onclick="return allowLibrarianOnly()"><img src="images/addbook.png" align="center"/></a></div><br />

            <div class="linkbox" id="issuebk"><span><strong>Issue Book</strong><br /><br /></span>
                <a  href="configure_id_for_issue.php" onclick="return allowLibrarianClerk();"><img src="images/issuebk.png" align="center"/></a>></div><br />

            <div class="linkbox" id="addmember"><span><strong>Add Member</strong><br /><br /></span>
                <a href="AddMember.php" onclick="return allowLibrarianOnly()"><img src="images/addmember.png" align="center"/></a></div><br />

            <div class="linkbox" id="returnbk"><span><strong>Return Book</strong><br /><br /></span>
                <a href="config_id_for_return.php" onclick="return allowLibrarianClerk();"><img src="images/returnbk.png" align="center"/></a></div><br />

            <div class="linkbox" id="renew"><span><strong>Renew Book</strong><br /><br /></span>
                <a href="configure_id_for_renew.php" onclick="return allowLibrarianClerk();"><img src="images/renew.png" align="center"/></a></div><br />

            <div class="linkbox" id="viewcatelog"><span><strong>View Catelog</strong><br /><br /></span>
                <a href="ViewCatalog.php"><img src="images/searchbk.png" align="center"/></a></div><br />

            <div class="linkbox" id="generatereport"><span><strong>Generate report</strong><br /></span>
                <a href="generateReport.php" onclick="return allowLibrarianAudit()"><img src="images/report-icon.png" align="center"/></a></div><br />

            <div class="linkbox" id="UaccSettings"><span><strong>User Account Settings</strong><br /></span>
                <a href="configure_id_for_usersettings.php" onclick="return allowLibrarianOnly()"><img src="images/useraccount.jpg" align="center"/></a></div><br />

            <div class="linkbox" id="AddnewAdmins"><span><strong>Add New Admin</strong><br /></span>
                <a href="addNewAdminPage.php" onclick="return allowLibrarianOnly()"><img src="images/addAdmin.jpg" align="center"/></a></div><br />

            <div class="linkbox" id="prevRecods"><span><strong>Previous Records</strong><br /></span>
                <a href="AdminPreviousRecords.php"><img src="images/bookmark.png" align="center"/></a></div><br />


            <div class="slideshow-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 6</div>
                    <img src="Images/1.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 6</div>
                    <img src="Images/2.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 6</div>
                    <img src="Images/3.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">4 / 6</div>
                    <img src="Images/4.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">5 / 6</div>
                    <img src="Images/5.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">6 / 6</div>
                    <img src="Images/6.jpg" style="width:100%">
                </div>
                <div style="text-align:center">
                    <br /><br />
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
            <br>

            <script>
                var slideIndex = 0;
                showSlides();

                function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    slideIndex++;
                    if (slideIndex> slides.length) {slideIndex = 1}
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 2000); // Change image every 2 seconds
                }
            </script>




        </article>
	</body>
</html>