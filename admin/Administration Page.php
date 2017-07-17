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
                    alert("The area you are trying to enter is restricted to your admin type.\nPlease login as a valid admin.");
                    return false;
                }
            }
            function allowLibrarianOnly() {
                var adminType= "<?php echo $session_value; ?>";
                if(adminType == "librarian"){
                    return true;
                }else{
                    alert("The area you are trying to enter is restricted to your admin type.\nPlease login as a valid admin.");
                    return false;
                }
            }
            function allowLibrarianAudit() {
                var adminType= "<?php echo $session_value; ?>";
                if(adminType == "librarian" || adminType == "audit"){
                    return true;
                }else{
                    alert("The area you are trying to enter is restricted to your admin type.\nPlease login as a valid admin.");
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
        <?php
        if(!empty($_SESSION['username'])){
            $welcomeMsg= " Welcome to Siyane National College of Education Library Administration Page ".$_SESSION['adminName']."...!!!";
        }
        ?>
        <div class="slideText">
            <marquee behavior="scroll" direction="left"><p class="WelMsg"><?php echo $welcomeMsg;?></p></marquee>
        </div>
	<nav>
		<ul>



			<li><a href="adminDetailSettings.php">ADMIN PROFILE</a></li>



            <?php
            if(!empty($_SESSION['username'])){ ?>
                <li class="logout" ><a href="Admin%20Login.php?id=adminLogout" id="adminLogout">LOGOUT</a></li>
            <?php } ?>

        </ul>
	</nav>
	</div>
	</header>
		<article>

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

            <div class="linkbox" id="viewcatelog"><span><strong>View Catalog</strong><br /><br /></span>
                <a href="ViewCatalog.php"><img src="images/searchbk.png" align="center"/></a></div><br />

            <div class="linkbox" id="generatereport"><span><strong>Generate report</strong><br /></span>
                <a href="generateReport.php" onclick="return allowLibrarianAudit()"><img src="images/report-icon.png" align="center"/></a></div><br />

            <div class="linkbox" id="UaccSettings"><span><strong>User Account Settings</strong><br /></span>
                <a href="configure_id_for_usersettings.php" onclick="return allowLibrarianOnly()"><img src="images/useraccount.jpg" align="center"/></a></div><br />

            <div class="linkbox" id="AddnewAdmins"><span><strong>Add/Remove Admin</strong><br /></span>
                <a href="addNewAdminPage.php" onclick="return allowLibrarianOnly()"><img src="images/addAdmin.jpg" align="center"/></a></div><br />

            <div class="linkbox" id="prevRecods"><span><strong>Previous Records</strong><br /></span>
                <a href="AdminPreviousRecords.php"><img src="images/bookmark.png" align="center"/></a></div><br />


            <div class="slideshow-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 7</div>
                    <img src="images/1slide.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 7</div>
                    <img src="images/2slide.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 7</div>
                    <img src="images/3slide.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">4 / 7</div>
                    <img src="images/4slide.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">5 / 7</div>
                    <img src="images/5slide.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">6 / 7</div>
                    <img src="images/6slide.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <div class="numbertext">7 / 7</div>
                    <img src="images/7slide.jpg" style="width:100%">
                </div>

                <div style="text-align:center">
                    <br /><br />
                    <span class="dot"></span>
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
                    setTimeout(showSlides, 2000); // Changes image every 2 seconds
                }
            </script>
        </article>

    <div class="para1"><h2 class="heading">Our Mission</h2>
        Our mission is to provide proper guidance to the prospective teachers through devoted service to build up
        physically and mentally sound, professionally competent, well-disciplined, committed Science, Mathematics, and Technical
        studies teachers by pre-service teacher education.</div>
    <div class="para2"><h2 class="heading">Our Vision</h2>
        Our vision is to develop Siyane National College of Education into an outstanding teacher education
        institute which provides excellent Science, Mathematics and Technical Studies teachers to the schools of Sri Lanka.<br /><br />
    </div>

<?php
if(isset($_GET['id']) && $_GET['id']=='back' ) {
    if (isset($_SESSION['id'])) {$_SESSION['id'] = '';}
    if (isset($_SESSION['member_name'])) {$_SESSION['member_name'] = '';}
    if (isset($_SESSION['member_type'])) {$_SESSION['member_type'] = '';}
    if (isset($_SESSION['book_id'])) {$_SESSION['book_id'] = '';}
    if (isset($_SESSION['title'])) {$_SESSION['title'] = '';}
    if (isset($_SESSION['book_type'])) {$_SESSION['book_type'] = '';}
    if (isset($_SESSION['ID'])) {$_SESSION['ID'] = '';}
    if (isset($_SESSION['Name'])) {$_SESSION['Name'] = '';}
    if (isset($_SESSION['bookIds'])) {$_SESSION['bookIds'] = '';}
    if (isset($_SESSION['name'])) {$_SESSION['name'] = '';}
    if (isset($_SESSION['fname'])) {$_SESSION['fname'] = '';}
    if (isset($_SESSION['type'])) {$_SESSION['type'] = '';}
    if (isset($_SESSION['status'])) {$_SESSION['status'] = '';}
    if (isset($_SESSION['adddate'])) {$_SESSION['adddate'] = '';}

}
elseif(isset($_GET['id']) && $_GET['id']=='backFromReturn') {
    if(isset($_SESSION['idForReturn'])){$_SESSION['idForReturn']='';}
    if(isset($_SESSION["bookIDs"])){$_SESSION["bookIDs"]='';}
}




?>
<footer>
    <p style="text-align: center;">Copyright @ 2017 Library, Siyane National College of Education, Paththalagedara, Veyangoda, Sri Lanka<br />
        Designed by <img src="../Images/Solutia_logo.png" width="140px" height="80px"/></p>
</footer>
</body>
</html>