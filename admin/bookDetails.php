<?php
include("../database.php");
include("../table.php");
include("../member.php");
include("../book.php");
include("../book_session.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root', '', 'lms_db');
session_start();
$b = new book();
$result = $b->load($dbObj, $_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
    <link rel = "stylesheet" href ="css/memberSetting.css"/>
    <style> .alert{display: none}</style>
</head>

<body>
<header>
    <script type="text/javascript">

        function show(id){
            document.getElementById(id).style.display='inline-block';

        }
        function hide(id){
            document.getElementById(id).style.display='none';
        }

    </script>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education<br />Veyangoda</h3>

        </div>
    </div>

    <div class="bgimage">
        <nav>
            <ul>
                <li><a href="Administration%20Page.php">HOME</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Invalid data. Re-enter Data
</div>

<table >
    <caption>Book Details Settings</caption>
    <tr>
        <th>Book ID</th>
        <td><?php echo $b->id?></td>

    </tr>
    <tr>
        <th>Title</th>
        <td><div id="div_title"><?php echo $b->title?></div><br />
            <button id="b1" type='submit' onclick="show('one')">Edit</button>
            <br />

            <form  class="change_form" name="one" id="one" method="post" action=""  autocomplete="off">
                <input type="text" name="b_title" id="bb_title" value="<?php echo $b->title ?>"/>
                <button class="saveBtn" name="save_title" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('one')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>ISBN</th>
        <td><div id="div_ISBN"><?php echo $b->ISBN?></div><br />
            <button id="b2" type='submit' onclick="show('two')">Edit</button>
            <br />

            <form  class="change_form" id="two" method="post" action=""  autocomplete="off">
                <input type="text" name="b_ISBN" id="bb_ISBN" value="<?php echo $b->ISBN ?>"/>
                <button class="saveBtn" name="save_ISBN" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('two')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Author</th>
        <td><div id="div_author"><?php echo $b->author?></div><br />
            <button id="b3" type='submit' onclick="show('three')">Edit</button>
            <br />

            <form  class="change_form" id="three" method="post" action=""  autocomplete="off">
                <input type="text" name="b_author" id="bb_author" value="<?php echo $b->author ?>"/>
                <button class="saveBtn" name="save_author" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('three')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Categery No</th>
        <td><div id="div_categery" ><?php echo $b->category_no ?> </div><br />
            <button id="b4" type='submit' onclick="show('four')">Edit</button>
            <br />

            <form  class="change_form" id="four" method="post" action=""  autocomplete="off">
                <input type="text" name="b_catagory_no" id="bb_category" value="<?php echo $b->category_no ?>"/>
                <button class="saveBtn" name="save_catno" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('four')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Publisher Name</th>
        <td><?php echo $b->publisher_name?><br />
            <button id="b5" type='submit' onclick="show('five')">Edit</button>
            <br />

            <form  class="change_form" id="five" method="post" action=""  autocomplete="off">
                <input type="text" name="b_publisher_name" value="<?php echo $b->publisher_name ?>"/>
                <button class="saveBtn" name="save_publisher" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('five')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Publisher Address</th>
        <td><?php echo $b->publisher_address?><br />
            <button id="b6" type='submit' onclick="show('six')">Edit</button>
            <br />

            <form  class="change_form" id="six" method="post" action=""  autocomplete="off">
                <input type="text" name="b_publisher_address" value="<?php echo $b->publisher_address ?>"/>
                <button class="saveBtn" name="save_publisher_address" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('six')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Published Date</th>
        <td><?php echo $b->published_date?><br />
            <button id="b7" type='submit' onclick="show('seven')">Edit</button>
            <br />

            <form  class="change_form" id="seven" method="post" action=""  autocomplete="off">
                <input type="date" name="b_published_date" value="<?php echo $b->published_date ?>"/>
                <button class="saveBtn" name="save_published_date" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('seven')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>


    <tr>
        <th>Number of Pages</th>
        <td><?php echo $b->no_pages?><br />
            <button id="b8" type='submit' onclick="show('eight')">Edit</button>
            <br />

            <form  class="change_form" id="eight" method="post" action=""  autocomplete="off">
                <input type="text" name="b_pages" value="<?php echo $b->no_pages ?>"/>
                <button class="saveBtn" name="save_price" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('eight')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Price</th>
        <td><?php echo $b->price?><br />
            <button id="b9" type='submit' onclick="show('nine')">Edit</button>
            <br />

            <form  class="change_form" id="nine" method="post" action=""  autocomplete="off">
                <input type="text" name="b_price" value="<?php echo $b->price ?>"/>
                <button class="saveBtn" name="save_price" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('nine')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Added Date</th>
        <td><?php echo $b->date_added?></td>

    </tr>

    <tr>
        <th>Book Status</th>
        <td><?php echo $b->book_status?><br />
            <button id="b10" type='submit' onclick="show('ten')">Edit</button>
            <br />

            <form  class="change_form" id="ten" method="post" action=""  autocomplete="off">
                <select name="b_status">
                    <option id="available" value="available">Available</option>
                    <option id="not_available" value="not_available">Not Available</option>
                </select>
                <button class="saveBtn" name="save_pages" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('ten')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

    <tr>
        <th>Remarks</th>
        <td><?php echo $b->remarks?><br />
            <button id="b11" type='submit' onclick="show('eleven')">Edit</button>
            <br />

            <form  class="change_form" id="eleven" method="post" action=""  autocomplete="off">
                <textarea type="text" name="b_remarks" value="<?php echo $b->remarks ?>"></textarea>
                <button class="saveBtn" name="save_remarks" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('eleven')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>

</table>

</body>
</html>
<?php

if(isset($_POST['save_title'])){
    $b->title=$_POST['b_title'];
    $b->update($dbObj);
    $text='"'.$b->title.'"';?>
   <script type="text/javascript"> document.getElementById("div_title").innerHTML=<?php echo $text;?>
   </script>

    <script type="text/javascript"> document.getElementById("bb_title").value=<?php echo $text;?>
    </script>

<?php }

else if(isset($_POST['save_ISBN'])){
    $b->ISBN=$_POST['b_ISBN'];
    $b->update($dbObj);
    $text='"'.$b->ISBN.'"';?>
    <script type="text/javascript"> document.getElementById("div_ISBN").innerHTML=<?php echo $text;?>
    </script>

    <script type="text/javascript"> document.getElementById("bb_ISBN").value=<?php echo $text;?>
    </script>

   <?php
}

else if(isset($_POST['save_author'])){
    $b->author=$_POST['b_author'];
    $b->update($dbObj);
}

else if(isset($_POST['save_catno'])){
    $b->category_no=$_POST['b_catagory_no'];
    $b->update($dbObj);
}

else if(isset($_POST['save_publisher'])){
    $b->publisher_name=$_POST['b_publisher_name'];
    $b->update($dbObj);
    header("location: ViewCatalog.php");

}
else if(isset($_POST['save_publisher_address'])){
    $b->publisher_addresso=$_POST['b_publisher_address'];
    $b->update($dbObj);

}
else if(isset($_POST['save_published_date'])){
    $b->published_date=$_POST['b_published_date'];
    $b->update($dbObj);

}

else if(isset($_POST['status'])){
    $b->book_status=$_POST['b_status'];
    $b->update($dbObj);

}
else if(isset($_POST['b_pages'])){
    if(is_numeric($_POST['b_pages'])) {
        if ($_POST['b_pages'] > 0) {
            $b->no_pages = $_POST['b_pages'];
            $b->update($dbObj);
        } else {
            ?>
            <style> .alert {
                    display: inline-block;
                }</style>

        <?php }

    }
}
else if(isset($_POST['b_price'])){
    if(is_numeric($_POST['b_price'])&&($_POST['b_price'] > 0)) {
            $b->price=$_POST['b_price'];
            $b->update($dbObj);
        }
        else {
            ?>
            <style> .alert {
                    display: inline-block;
                }</style>

        <?php }

}

else if(isset($_POST['b_remarks'])){
    $b->remarks=$_POST['b_remarks'];
    $b->update($dbObj);

}

?>
