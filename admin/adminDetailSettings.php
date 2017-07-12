<?php
include("../database.php");
include("../table.php");
include("admin.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root', '', 'lms_db');
session_start();
$login= new login();
$login->load($dbObj, $_SESSION['id']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Admin Details</title>
    <link rel = "stylesheet" href ="css/memberSetting.css"/>

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
                <li><a href="Administration%20Page.php?id==back">HOME</a></li>
                <li><a href="#">ADMIN PROFILE</a></li>
                <li class="logout"><a href="../index.php">LOGOUT</a></li>
            </ul>
        </nav>
    </div>
</header>
<table >
    <caption>Admin Details Settings</caption>
    <tr>
        <th>username</th>
        <td><?php echo  $_SESSION['username']?></td>

    </tr>
    <tr>
        <th>Name with initials</th>
        <td><div id="div_name"> <?php echo $_SESSION['adminName']?> </div> <br/>
            <button id="b1" type='submit' onclick="show('one')">Edit</button>
            <br />

            <form  class="change_form" id="one" method="post" action=""  autocomplete="off">
                <input type="text" name="m_name" id="mm_name" value="<?php echo $_SESSION['adminName']?>" required/>
                <button class="saveBtn" name="save_name" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('one')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>
    </tr>


    <tr>
        <th>Admin type</th>
        <td><?php echo  $_SESSION['adminType']?></td>
    </tr>

    <tr>
        <th>Admin status</th>
        <td><?php echo  $_SESSION['adminStatus']?></td>
    </tr>

    <tr>
        <th>Joined date</th>
        <td><?php echo  $_SESSION['add_date']?></td>
    </tr>

    <tr>
        <th>Member status</th>
        <td><div id="div_status"><?php echo $_SESSION['status']?></div><br />
            <button id="b5" onclick="show('five')">Edit</button>
            <br />

            <form class="change_form" id="five" method="post" action=""  autocomplete="off">

                <select id="memberstatus" name="m_status" id="mm_status"><br />
                    <option value="active">active</option>
                    <option value="restricted">restricted</option></select>
                <button class="saveBtn" name="save_status" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('five')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>

    </tr>

</table>

</body>
</html>
<?php
if(isset($_POST['save_name'])){
    $m->member_name=$_POST['m_name'];
    $_SESSION['name']=$_POST['m_name'];
    $m->update($dbObj);
    $text='"'.$m->member_name.'"';
    ?>
    <script type="text/javascript"> document.getElementById("div_name").innerHTML=<?php echo $text;?></script>

    <script type="text/javascript"> document.getElementById("mm_name").value= <?php echo $text;?>
    </script>

<?php }


else if(isset($_POST['save_status'])){
    $m->member_status=$_POST['m_status'];
    $_SESSION['status']=$_POST['m_status'];
    $m->update($dbObj);
    $text='"'.$m->member_status.'"';
    ?>
    <script type="text/javascript"> document.getElementById("div_status").innerHTML=<?php echo $text;?></script>

    <script type="text/javascript"> document.getElementById("mm_status").value= <?php echo $text;?>
    </script>






<?php }
if(isset($_GET['id']) && $_GET['id']=='back' ){
    session_destroy();
}
?>
