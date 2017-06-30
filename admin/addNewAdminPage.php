
<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
    <link rel = "stylesheet" href ="addNewAdminPageStyle.css"/>
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
                    <li class="logout"><a href="#">LOGOUT</a></li>
                </ul>
            </nav>
        </div
</header>

<div class="adminRegform">
    <form align="center" method="POST" action="" autocomplete="off">
        <div class="container">
            <h1>Admin Registration Form</h1><hr />
            <label for="adminName"><b>Name with initials</b></label><br />
            <input id="adminName" name="adminName" type="text" placeholder="Enter name with initials " required autofocus/><br />
            <label for="adminType"><b>Admin Type</b></label><br />
            <select name="adminType" required<br />
            <option value="selection" >Select admin type</option><option value="librarian" >Librarian</option><option value="clerk" >Clerk</option><option value="audit" >Audit</option></select>
            <label for="AutName"><b>Author</b></label><br />
            <input name="AutName" type="text" placeholder="Enter Author" required/><br />
            <label for="NoOfPg"><b>No Of Pages</b></label><br />
            <input name="NoOfPg" type="text" placeholder="Enter No Of Pages" required/><br />
            <label for="Price"><b>Price</b></label><br />
            <input name="Price" type="text" placeholder="Enter the Price" required/><br />
            <label for="CatNo"><b>Category Number</b></label><br />
            <input name="CatNo" type="text" placeholder="Enter Category No" required/><br />
            <label for="DOP"><b>Date of Publication</b></label><br />
            <input name="DOP" type="date"/><br />
            <label for="POP"><b>Place Of Publication</b></label><br />
            <input name="POP" type="text" placeholder="Enter place Of Publication" /><br />
            <label for="Remarks"><b>Remarks</b></label><br />
            <textarea name="Remarks" clos="40" rows="6" required></textarea><br />
            <button class="Submitbtn"type="submit">Submit</button>
            <button class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>
</div>


</article>

</body>
</html>

<php?

?>
