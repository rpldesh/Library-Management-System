
<!DOCTYPE html>
<html>
<head>
    <title>ID configuration for changeDetails</title>
    <link rel = "stylesheet" href ="css/configure_id.css"/>
</head>
<body>
<header>
    <script type="text/javascript">
        function validate(){

            var missingField=false;
            var strFields="";
            if(id_config.memberID.value==""){
                missingField=true;
                strFields+="Plese enter a member ID";
            }
            if(missingField){
                alert("Sorry! You must provide following fields to continue:\n"+strFields);
                return false;
            }
            return true;
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
                <li><a href="#">ADMIN PROFILE</a></li>
                <li class="logout"><a href="../index.php">LOGOUT</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="idconfigureform">
    <form name="id_config" align="center" method="POST" action="" autocomplete="off">
        <div class="container">

            <label for="memberId"><b>Enter Member ID:</b></label><br />
            <input id="memberId" name="memberID" type="text"  required autofocus/><br />

            <button class="Submitbtn" name="submitID" type="submit" onclick="validate()">Submit</button>
            <button class="cancelbtn" onclick="window.location='Administration Page.php'" name="cancel" type="button" >Cancel</button>
        </div>
    </form>
</div>
</body>
</html>

<?php
session_start();
include("../database.php");
include("../table.php");
include("../member.php");
include("../book.php");
include("../book_session.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root', '', 'lms_db');

if(isset($_POST['submitID'])) {
    $_SESSION['id']= $_POST["memberID"];
    $m = new member();
    $result = $m->load($dbObj, $_SESSION['id']);
    if(!$result){?>
       <div class = "MessageBox"><?php echo "Member does not exist..Incorrect Member ID!!" ?><a href="configure_id_for_usersettings.php"><img class="closeIcon" src="images/closebtn.png"/></a></div>

    <?php }
    else{
    $_SESSION['name'] = $m->member_name;
    $_SESSION['fname'] = $m->member_fullname;
    $_SESSION['type'] = $m->member_type;
    $_SESSION['status'] = $m->member_status;
    $_SESSION['adddate'] = $m->join_date;
    header("Location:memberAccountSetting.php");}}
?>