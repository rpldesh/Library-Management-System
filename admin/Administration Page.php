<?php session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration Page</title>
		<link rel = "stylesheet" href ="css/Administration Page.css"/>

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


			<li><a href="">HOME</a></li>
			<li><a href="adminDetailSettings.php">Admin Profile</a></li>

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
            echo " Welcome to Siyane National College of Education Library Administration Page ".$_SESSION['adminName']."...!!!";
            }
            ?>

            <div class="linkbox" id="addbook"><span><strong>Add Book</strong><br /><br /></span>
                <a href="AddBook.php"><img src="images/addbook.png" align="center"/></a></div><br />

            <div class="linkbox" id="issuebk"><span><strong>Issue Book</strong><br /><br /></span>
                <a  href="configure_id_for_issue.php"><img src="images/issuebk.png" align="center"/></a>></div><br />

            <div class="linkbox" id="addmember"><span><strong>Add Member</strong><br /><br /></span>
                <a href="AddMember.php"><img src="images/addmember.png" align="center"/></a></div><br />

            <div class="linkbox" id="returnbk"><span><strong>Return Book</strong><br /><br /></span>
                <a href="config_id_for_return.php"><img src="images/returnbk.png" align="center"/></a></div><br />

            <div class="linkbox" id="renew"><span><strong>Renew Book</strong><br /><br /></span>
                <a href="configure_id_for_renew.php" ><img src="images/renew.png" align="center"/></a></div><br />

            <div class="linkbox" id="viewcatelog"><span><strong>View Catelog</strong><br /><br /></span>
                <a href="ViewCatalog.php"><img src="images/searchbk.png" align="center"/></a></div><br />

            <div class="linkbox" id="generatereport"><span><strong>Generate report</strong><br /></span>
                <a href="generateReport.php"><img src="images/report-icon.png" align="center"/></a></div><br />

            <div class="linkbox" id="UaccSettings"><span><strong>User Account Settings</strong><br /></span>
                <a href="configure_id_for_usersettings.php"><img src="images/useraccount.jpg" align="center"/></a></div><br />

            <div class="linkbox" id="AddnewAdmins"><span><strong>Add New Admin</strong><br /></span>
                <a href="addNewAdminPage.php"><img src="images/addAdmin.jpg" align="center"/></a></div><br />

            <div class="linkbox" id="prevRecods"><span><strong>Previous Records</strong><br /></span>
                <a href="AdminPreviousRecords.php"><img src="images/bookmark.png" align="center"/></a></div><br />

	
	<div class="slideshow "></div>
	</article>
	</body>
</html>