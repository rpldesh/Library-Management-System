<?php
include("../database.php");
include("../table.php");
include("admin.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root', '', 'lms_db');
session_start();
$admin= new admin();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Admin Details</title>
    <link rel = "stylesheet" href ="css/memberSetting.css"/>
    <style>div.alert{display:none;}</style>

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

            </ul>
        </nav>
    </div>
</header>
<table >
    <caption>Admin Details Settings</caption>
    <tr>
        <th>Username</th>
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
        <th>Change Password</th>
        <td>
            <button id="b2" onclick="show('two')">Change Password</button>
            <br />
            <form class="change_form" id="two" method="post" action=""  autocomplete="off">
                <label><b>Current Password</b></label>
                <input type="password" name="curPsw" Placeholder="Enter your current password" required/>
                <label><b>New Password</b></label>
                <input type="password" name="newPsw" Placeholder="Enter your new password" required/>
                <label><b>Confirm new password</b></label>
                <input type="password" name="conNewPsw" Placeholder="Re enter your new password" required/>
                <button class="saveBtn" name="save_psw" type="submit" >Save Changes</button>
                <button class="cancelBtn" onclick="hide('two')" name="cancel" type="button" >Cancel</button>

            </form>

        </td>

    </tr>

</table>

</body>
</html>
<?php
$message='';

$admin=new admin();
$admin->load($dbObj,$_SESSION['id']);
$_SESSION['psw']=$admin->pwd;

if(isset($_POST['save_name'])){
    $admin->admin_name=$_POST['m_name'];
    $_SESSION['adminName']=$_POST['m_name'];
    $admin->update($dbObj);
    $text='"'.$admin->admin_name.'"';
    ?>
    <script type="text/javascript"> document.getElementById("div_name").innerHTML=<?php echo $text;?></script>

    <script type="text/javascript"> document.getElementById("mm_name").value= <?php echo $text;?>
    </script>

<?php }


else if(isset($_POST['save_psw'])){
    $logedpsw=$_SESSION['psw'];
    $CurPsw=$_POST["curPsw"];
    $curEncriped=md5("$CurPsw");
    $NewPsw=$_POST["newPsw"];
    $ConNewPsw=$_POST["conNewPsw"];

    if($NewPsw!=$ConNewPsw){
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message= "Your new Password and confirmed password do not match..!!";
        ?>   <style>div.alert{display:inline-block;}</style><?php
    }
    elseif($curEncriped!=$logedpsw){

        ?> <style>div.alert{display:inline-block;}</style><?php
        $message= "Your current password is incorrect..!!";}
        elseif (strlen($NewPsw)>64 or strlen($NewPsw)<8){
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Your password must contain 8-64 characters..!!";
        ?>   <style>div.alert{display:inline-block;}</style><?php
    }elseif($curEncriped==$logedpsw && $NewPsw==$ConNewPsw ){
        $encriptedPsw=md5($NewPsw);
        $uname=$_SESSION['username'];
        $sql = "Update admins set pwd= '$encriptedPsw' where username='$uname'";
        $dbObj->doQuery($sql);
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message=  "Your password changed successfully";
        ?>   <style>div.alert{display:inline-block;}</style><?php
        $_SESSION['psw']=$encriptedPsw;
    }



}


?>

<div class="alert">

    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>


    <?php echo $message;?>
</div>
<?php $dbObj->closeConnection()?>