

<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="Search Book.css"/>

	</head>
	<body>

	<header>
	<div class="head_top">
	<div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

		<h1>LIBRARY</h1>
		<h3>Siyane National College of Education<br />Veyangoda</h3>

	</div>
	</div>
	<div class="bgimage">
	<nav>
		<ul>
			<li><a href="Member%20Page.html">HOME</a></li>
			<li class="logout"><a href="#">LOGOUT</a></li>
		</ul>
	</nav>
	</div>
	</header>



		<div class="searchBook">
			<form  method="POST" action="" autocomplete="off">
				<div class="container">
				<h1>Change the Password</h1><hr />
                    <label><b>Username</b></label>
                    <input type="text" name="uname" Placeholder="Enter the username"/>
                    <label><b>Current Password</b></label>
				    <input type="password" name="curPsw" Placeholder="Enter your current password"/>
				    <label><b>New Password</b></label>
				    <input type="password" name="newPsw" Placeholder="Enter your new password"/>
                    <label><b>Confirm new password</b></label>
                    <input type="password" name="ConNewPsw" Placeholder="Re enter your new password"/>
				    <button name="save" class="Submitbtn" type="submit">Save Changes</button>
				</div>
			</form>
		</div>

	</body>
</html>