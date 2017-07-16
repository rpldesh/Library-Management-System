<!DOCTYPE html>
<html>
<head>
    <title>Add Member page</title>
    <link rel = "stylesheet" href ="css/AddMember.css"/>
    <style> div.alert{display: none;}</style>


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
                <li><a href="Administration%20Page.php">HOME</a></li>
            </ul>
        </nav>
    </div>

</header>

<?php
/**
 * Created by PhpStorm.
 * User: Dell-PC
 * Date: 7/4/2017
 * Time: 7:20 AM
 */
include("../database.php");
include("../table.php");
include("../member.php");
include ("../login.php");

$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root','','lms_db');
$msg="";

if(isset($_POST['submit'])){
            $_SESSION['indicator']='done';
            $_SESSION['displayMessage']='on';
            $msg= "Member Added Successfully ";
            $id=$_POST['memberID'];
            $member_name=$_POST['Name'];
            $member_fullname=$_POST['fullName'];
            $member_type=$_POST['type'];
            $join_date=date("Y-m-d");
            $addmission_date=$_POST['DOA'];
            $permanent_address=$_POST['permanentaddress'];
            $current_address=$_POST['currentaddress'];
            $member_email=$_POST['email'];
            $contact_no=$_POST['contactNo'];
            $member_status="active";
            $tempmember = new member();
            $result1 = $tempmember->load($dbObj, $id);
            $defaltPsw=$_POST['memberID'];
            $encDefPsw=md5("$defaltPsw");
            if ($result1) {
                ?> <style>div.alert{display:inline-block;}</style><?php
                $msg = "Username already exists. Please select another username..!!";
            }

            else if (date("Y-m-d") < date("Y-m-d",strtotime($addmission_date))){
                ?> <style>div.alert{display:inline-block;}</style><?php
                $msg= "Invalid Date";
            }

            else if(!is_numeric($contact_no)||!(strlen($contact_no)==10)){
                ?> <style>div.alert{display:inline-block;}</style><?php
                $msg="Invalid Contact Number";

            }
            else{
                $member = new member();
                $login = new login();
                $logindata=array("id"=>$id, "password"=>$encDefPsw);
                $data = array("id" => $id, "member_name" => $member_name, "member_fullname" => $member_fullname, "member_type" => $member_type, "join_date" => $join_date, "addmission_date" => $addmission_date, "permanent_address" => $permanent_address, "current_address" => $current_address, "member_email" => $member_email, "contact_no" => $contact_no, "member_status" => $member_status);
                $member->bind($data);
                $login->bind($logindata);
                $member->insert($dbObj);
                $login->insert($dbObj);
                $msg = "Member added successfully.!";
                ?> <style>div.alert{display:inline-block;}</style><?php
                $_POST=array();

            }
        }
?>

<div class="addbkform">
    <form id="AddMemForm" align="center" method="POST" action="AddMember.php" autocomplete="off">
        <div class="container">
            <h1>Member Registration Application</h1><hr />
            <label for="id"><b>Member ID</b></label><br />
            <input id="id" name="memberID" type="text" placeholder="Enter Member ID" value="<?php if (isset($_POST['memberID'])) echo $_POST['memberID']; ?>" required autofocus/><br />
            <label for="memberName"><b>Name with initials</b></label><br />
            <input id="memberName" name="Name" type="text" placeholder="Enter Name with initials" value="<?php if (isset($_POST['Name'])) echo $_POST['Name']; ?>" required autofocus/><br/>
            <label for="memberFullName"><b>Full Name</b></label><br />
            <input id="memberFullName" name="fullName" type="text" placeholder="Enter Full Name" value="<?php if (isset($_POST['fullName'])) echo $_POST['fullName']; ?>" autofocus/><br>
            <label for="membertype"><b>Member Type</b></label><br />
            <select id="membertype" name="type" required > <br />
                <option value="Internal Student(1st year)">Internal Student(1st year)</option>
                <option value="Internal Student(2nd year)">Internal Student(2nd year)</option>
                <option value="Internship Student">Internship Student</option>
                <option value="Academic Staff">Academic Staff</option>
                <option value="Clerical Staff">Clerical Staff</option>
                <option value="Minor Staff">Minor Staff</option>
                <option value="Secondment Staff">On-Secondment Staff</option>
                <option value="Temporary Staff">Temporary Staff</option></select>
            <label for="doa"><b>Date of Addmission</b></label><br />
            <input id="doa" name="DOA" type="date" value="<?php if (isset($_POST['DOA'])) echo $_POST['DOA']; ?>"/><br />
            <label for="permanentAddress"><b>Permanent Address</b></label><br />
            <input id="permanentAddress" name="permanentaddress" type="text" placeholder="Enter Permanent Address" value="<?php if (isset($_POST['permanentaddress'])) echo $_POST['permanentaddress']; ?>" required/><br />
            <label for="currentAddress"><b>Current Address</b></label><br />
            <input id="currentAddress" name="currentaddress" type="text" placeholder="Enter Current Address" value="<?php if (isset($_POST['currentaddress'])) echo $_POST['currentaddress']; ?>" required/><br />
            <label for="Email"><b>E-mail Address</b></label><br />
            <input id="Email" name="email" type="text" placeholder="xxxx@example.com " value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /><br />
            <label for="phone"><b>Contact Number</b></label><br />
            <input id="phome" name="contactNo" type="text" placeholder="0xxxxxxxxx " value="<?php if (isset($_POST['contactNo'])) echo $_POST['contactNo']; ?>" required/><br />
            <button name="submit" type="submit">Submit</button>
            <button onclick="window.location='Administration page.php'" class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>
</div>

<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"><strong>&times;</strong></span>
    <?php  echo $msg ;?>
</div>


</body>
</html>

