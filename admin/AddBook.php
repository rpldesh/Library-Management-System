


<!DOCTYPE html>
<html>
<head>
    <title>Add Book Page</title>
    <link rel = "stylesheet" href ="AddBook.css"/>
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
                    <li><a href="Administration Page.html">HOME</a></li>
                    <li><a href="#">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="../mainpage.html">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
</header>

<div class="addbkform">
    <form  method="POST" action="afterAddBook.php" autocomplete="off">
        <div class="container">
            <h1>Book Registration Form</h1><hr />
            <label for="AccNo"><b>Accession Number</b></label><br />
            <input id="AccNo" name="accNo" type="text" placeholder="Enter Accession Number" required autofocus/><br />
            <label for="title"><b>Titile</b></label><br />
            <input id="title" name="title" type="text" placeholder="Enter Title" required autofocus/><br />
            <label for="bktype"><b>Book Type</b></label><br />
            <select id="bktype" name="Bktype" required><br />
                <option value="borrowable" >Borrowable</option><option value="reference" >Reference</option></select>
            <label for="autname"><b>Author</b></label><br />
            <input id="autname" name="AutName" type="text" placeholder="Enter Author" required/><br />
            <label for="isbn"><b>ISBN</b></label><br />
            <input id="isbn" name="isbn" type="text" placeholder="Enter Accession Number" required autofocus/><br />
            <label for="NoP"><b>No Of Pages</b></label><br />
            <input id="NoP" name="NoOfPg" type="number" placeholder="Enter No Of Pages" required/><br />
            <label for="price"><b>Price</b></label><br />
            <input id ="price" name="Price" type="text" placeholder="Enter the Price" required/><br />
            <label for="catno"><b>Category Number</b></label><br />
            <input id="catno" name="CatNo" type="text" placeholder="Enter Category No" required/><br />
            <label for="pubName"><b>Publisher Name</b></label><br />
            <input id="pubName" name="Pubname" type="text" placeholder="Enter Publisher Name" required/><br />
            <label for="dop"><b>Date of Publication</b></label><br />
            <input id="dop" name="DOP" type="date"/><br />
            <label for="pop"><b>Place Of Publication</b></label><br />
            <input id="pop" name="POP" type="text" placeholder="Enter place Of Publication" /><br />
            <label for="remarks"><b>Remarks</b></label><br />
            <textarea id="remarks" name="Remarks" cols="40" rows="6" required></textarea><br />
            <button name="save" class="Submitbtn" type="submit">Submit</button>
            <button name="cancel" class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>
</div>

<!--this line is for messeage box -->

</body>
</html>
