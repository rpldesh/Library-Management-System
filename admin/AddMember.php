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

$dbObj = database::getInstance();
$dbObj->connect('localhost', 'root','','lms_db');

if (isset($_POST['submit'])){
    $msg= "Member Added Sucessfully ";
    $id=$_POST['memberID'];
    $member_name=$_POST['Name'];
    $member_fullname=$_POST['fullName'];
    $member_type=$_POST['type'];
    $join_date=time();
    $addmission_date=$_POST['DOA'];
    $permanent_address=$_POST['permanentaddress'];
    $current_address=$_POST['currentaddress'];
    $member_email=$_POST['email'];
    $contact_no=$_POST['contactNo'];
    $member_status="active";
    $member= new member();
    $data= array("id"=>$id, "member_name"=>$member_name, "member_fullname"=>$member_fullname, "member_type"=>$member_type,"join_date"=>$join_date,"addmission_date"=>$addmission_date, "permanent_address"=>$permanent_address, "current_address"=>$current_address,"member_email"=>$member_email,"contact_no"=>$contact_no,"member_status"=>$member_status);
    $member->bind($data);
    $member->insert($dbObj);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Member page</title>
    <link rel = "stylesheet" href ="css/AddMember.css"/>
    <style> div.MessageBox{display: none;}</style>


</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="../images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education<br />Veyangoda</h3>



        </div>
    </div>
    <article class="backgroundimage">

        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="Administration%20Page.html">ADMIN PROFILE</a></li>
                    <li class="logout"><a href="#">LOGOUT</a></li>
                </ul>
            </nav>
        </div>
    </article>
</header>

<div class="addbkform">
    <form align="center" method="POST" action="" autocomplete="off">
        <div class="container">
            <h1>Member Registration Application</h1><hr />
            <label for="id"><b>Member ID</b></label><br />
            <input id="id" name="memberID" type="text" placeholder="Enter Member ID" required autofocus/><br />
            <label for="memberName"><b>Name with initials</b></label><br />
            <input id="memberName" name="Name" type="text" placeholder="Enter Name with initials" required autofocus/><br/>
            <label for="memberFullName"><b>Full Name</b></label><br />
            <input id="memberFullName" name="fullName" type="text" placeholder="Enter Full Name" required autofocus/><br>
            <label for="membertype"><b>Member Type</b></label><br />
            <select id="membertype" name="type" required><br />
                <option value="internalStudent">Internal Student</option>
                <option value="internshipStudent">Internship Student</option>
                <option value="academicStaff">Academic Staff</option>
                <option value="non-academicStaff">Non-Academic Staff</option>
                <option value="temporaryStaff">Temporary Staff</option>
                <option value="secondmentStaff">On-Secondment Staff</option></select>
            <label for="doa"><b>Date of Addmission</b></label><br />
            <input id="doa" name="DOA" type="date"/><br />
            <label for="permanentAddress"><b>Permanent Address</b></label><br />
            <input id="permanentAddress" name="permanentaddress" type="text" placeholder="Enter Permanent Address" required/><br />
            <label for="currentAddress"><b>Current Address</b></label><br />
            <input id="currentAddress" name="currentaddress" type="text" placeholder="Enter Current Address" required/><br />
            <label for="Email"><b>E-mail Address</b></label><br />
            <input id="Email" name="email" type="text" placeholder="Enter E-mail Address " required/><br />
            <label for="phone"><b>Contact Number</b></label><br />
            <input id="phome" name="contactNo" type="text" placeholder="Enter Contact Number " required/><br />
            <button name="submit" type="submit">Submit</button>
            <button class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>
</div>


<div class = "MessageBox">
    <?php if (isset($_POST['submit'])){ ?>
    <style> div.MessageBox{display:inline-block ;}</style>
    <?php } ?>
    <?php echo $msg ?><span class="closebtn" onclick="this.parentElement.style.display='none';"> <button type="button">Close</button> </span></div>

</article>
</body>
</html>

