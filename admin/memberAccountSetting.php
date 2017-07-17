<?php
include("../database.php");
include("../table.php");
include("../member.php");
include("../login.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root', '', 'lms_db');
session_start();
$m = new member();
$result = $m->load($dbObj, $_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Detail Settings</title>
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
                <li><a href="Administration%20Page.php?id=back">HOME</a></li>

            </ul>
        </nav>
    </div>
</header>
            <table >
                <caption>Member Details Settings</caption>
                <tr>
                    <th>Member ID</th>
                    <td><?php echo $_SESSION['id']?></td>

                </tr>
                <tr>
                    <th>Name with initials</th>
                    <td><div id="div_name"> <?php echo $m->member_name?> </div> <br/>
                        <button id="b1" type='submit' onclick="show('one')">Edit</button>
                        <br />

                            <form  class="change_form" id="one" method="post" action=""  autocomplete="off">
                                <input type="text" name="m_name" id="mm_name" value="<?php echo $_SESSION['name']?>" required/>
                                <button class="saveBtn" name="save_name" type="submit" >Save Changes</button>
                                <button class="cancelBtn" onclick="hide('one')" name="cancel" type="button" >Cancel</button>

                            </form>

                        </td>
                </tr>

                <tr>
                    <th>Full name</th>
                    <td><div id="div_fullname"><?php echo  $_SESSION['fname']?></div><br />
                        <button id="b2" onclick="show('two')">Edit</button>
                        <br />

                    <form class="change_form" id="two" method="post" action=""  autocomplete="off">

                        <input type="text" name="m_fullname" id="mm_fullname" value="<?php echo  $_SESSION['fname']?>" required/>
                        <button class="saveBtn" name="save_fullname" type="submit" >Save Changes</button>
                        <button class="cancelBtn" onclick="hide('two')" name="cancel" type="button" >Cancel</button>

                    </form>


                    </td>
                </tr>

                <tr>
                    <th>Member type</th>
                    <td ><div id="div_mType"> <?php echo $_SESSION['type']?> </div><br />
                        <button id="b3" onclick="show('three')">Edit</button>
                        <br />
                       <form class="change_form" id="three" method="post" action=""  autocomplete="off">

                            <select id="membertype" name="m_type" id="mm_type"><br />
                                <option value="Internal Student(1st year)">Internal Student(1st year)</option>
                                <option value="Internal Student(2nd year)">Internal Student(2nd year)</option>
                                <option value="Internship Student">Internship Student</option>
                                <option value="Academic Staff">Academic Staff</option>
                                <option value="Clerical Staff">Clerical Staff</option>
                                <option value="Minor Staff">Minor Staff</option>
                                <option value="Secondment Staff">On-Secondment Staff</option>
                                <option value="Temporary Staff">Temporary Staff</option></select>
                            <button class="saveBtn" name="save_type" type="submit" >Save Changes</button>
                            <button class="cancelBtn" onclick="hide('three')" name="cancel" type="button" >Cancel</button>

                        </form>


                    </td>
                </tr>

                <tr>
                    <th>Date of admission</th>
                    <td><div id="div_DOA"><?php echo $_SESSION['adddate']?></div><br />
                        <button id="b4" onclick="show('four')">Edit</button>
                        <br />

                        <form class="change_form" id="four"   method="post" action=""  autocomplete="off">

                            <input type="date" name="m_addmision_date" id="m_DOA" value="<?php echo $_SESSION['adddate']?>" required/>
                            <button class="saveBtn" name="save_add_date" type="submit" >Save Changes</button>
                            <button class="cancelBtn" onclick="hide('four')" name="cancel" type="button" >Cancel</button>

                        </form>



                    </td>
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
                <tr>
                    <th>Reset Password</th>
                    <td>
                    <form method="post" action="">
                        <button name="clearPsw" type="submit">Clear Password</button>
                    </form>
                    </td>
            </tr>
            </table>


</body>
</html>
<?php
$message='';
if(isset($_POST['clearPsw'])){
    $login=new login();
    $login->load($dbObj,$_SESSION['id']);
    $defPsw=$_SESSION['id'];
    $encodedpsw=md5("$defPsw");
    $login->password=$encodedpsw;
    $login->update($dbObj);
    $message="successfully changed. $defPsw is the new password";?>
    <style>div.alert{display:inline-block;}</style>
    <div id="resetpsw" class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong>&times;</strong></span>
    <?php  echo $message; ?>



    </div>
    <?php

}
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


else if(isset($_POST['save_fullname'])){
    $m->member_fullname=$_POST['m_fullname'];
    $_SESSION['fname']=$_POST['m_fullname'];
    $m->update($dbObj);
    $text='"'.$m->member_fullname.'"';
    ?>
    <script type="text/javascript"> document.getElementById("div_fullname").innerHTML=<?php echo $text;?></script>

    <script type="text/javascript"> document.getElementById("mm_fullname").value= <?php echo $text;?>
    </script>

<?php }

else if(isset($_POST['save_type'])){
    $m->member_type=$_POST['m_type'];
    $_SESSION['type']=$_POST['m_type'];
    $m->update($dbObj);
    $text='"'.$m->member_type.'"';
    ?>
    <script type="text/javascript"> document.getElementById("div_mType").innerHTML=<?php echo $text;?></script>

    <script type="text/javascript"> document.getElementById("mm_type").value= <?php echo $text;?>
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

else if(isset($_POST['save_add_date'])){
    if(date("m-d-Y") < date("m-d-Y",strtotime($_POST['m_addmision_date']))){
        $message= "Invalid Date";
    }else{
    $m->addmission_date=$_POST['m_addmision_date'];
    $_SESSION['adddate']=$_POST['m_addmision_date'];
    $m->update($dbObj);
    $text='"'.$m->addmission_date.'"';
    ?>
<div id="invaldate" class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong>&times;</strong></span>
    <?php  echo $message; ?>
    <script type="text/javascript"> document.getElementById("div_DOA").innerHTML=<?php echo $text;?></script>

    <script type="text/javascript"> document.getElementById("m_DOA").value= <?php echo $text;?>
    </script>

<?php }}

$dbObj->closeConnection();
?>
