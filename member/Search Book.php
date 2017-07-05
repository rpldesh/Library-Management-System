<!DOCTYPE HTML>
<html> 
	<head> 
		<title></title>
		<link rel="stylesheet" href="../admin/css/AddBook.css"/>
		<link rel="stylesheet" href="css/Search Book.css"/>

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
			<li><a href="#">HOME</a></li>
			<li class="logout"><a href="#">LOGOUT</a></li>
		</ul>
	</nav>
	</div>
	</header>
	
	
	
		<div class="searchBook">
			<form  method="POST" action="Search Book Result.html" autocomplete="off">
				<div class="container">
				<h1>Search a Book</h1><hr />
				<label><b>Search by Title</b></label>
				<input type="text" name="searchByTitle" Placeholder="Enter the Name of Title"/>
				<label><b>Search by Author</b></label>
				<input type="text" name="searchByAuthor" Placeholder="Enter the Name of Author"/>
				<button name="save" class="Submitbtn" type="submit">Click Here to Search</button>
				</div>>
			</form>
		</div>
	
	</body>
</html>