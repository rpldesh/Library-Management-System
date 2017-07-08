<?php
    include("../database.php");
    include("../table.php");
    include("../member.php");
    include ("../login.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>My Profile Page</title>
		<link rel="stylesheet" href="css/My%20profile.css"/>

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
			<li><a href="Member%20Page.html">HOME</a></li>
			<li class="logout"><a href="#">LOGOUT</a></li>
		</ul>
	</nav>
	</div>
	</header>




    <div class="tab">
        <div class="ChangeSettings">

            <button class="tablinks" onclick="ClickOption(event, 'tableMyProf')" id="defaultOpen">My Profile</button>

            <h3>Click on the buttons to change your settings</h3>
            <button class="tablinks" onclick="ClickOption(event, 'Password')">Password</button>
            <button class="tablinks" onclick="ClickOption(event, 'E-mail')">E-mail</button>
            <button class="tablinks" onclick="ClickOption(event, 'Address')">Address</button>
            <button class="tablinks" onclick="ClickOption(event, 'TP')">Telephone No</button>
        </div>
    </div>

    <?php if(!isset($_POST["savePsw"]) )/*{*/ ?>
    <div id="Password" class="tabcontent">
        <div class="Password">
            <form  method="POST" action="" autocomplete="off">
                <div class="container">
                    <h1>Change the Password</h1><hr />
                    <label><b>Current Password</b></label>
                    <input type="password" name="curPsw" Placeholder="Enter your current password"/>
                    <label><b>New Password</b></label>
                    <input type="password" name="newPsw" Placeholder="Enter your new password"/>
                    <label><b>Confirm new password</b></label>
                    <input type="password" name="conNewPsw" Placeholder="Re enter your new password"/>
                    <button name="savePsw" class="Submitbtn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <?php
   // }

    $psw="";
    if (isset($_POST["savePsw"])) {

    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');



    $CurPsw=$_POST["curPsw"];
    $NewPsw=$_POST["newPsw"];
    $ConNewPsw=$_POST["conNewPsw"];
    $login = new login();
    $sql = "Select password from logins where id = 1 ";
    $login->load($dbObj,1);
    $result = $login->featuredLoad($dbObj,$sql);
    $psw=mysqli_fetch_row($result)[0];
    echo $psw;


    if($NewPsw!=$ConNewPsw){
        echo "Your new Password and confirmed password are not matched..!!";
    }

    elseif($CurPsw!=$psw){
        echo "Your current password is incorrect..!!";

    }elseif($CurPsw=$psw){
        $login->password="$NewPsw";
        $login->update($dbObj);
        echo "Your password changed successfully";
    }
    }
?>

    <div id="E-mail" class="tabcontent">
        <div class="Password">
            <form  method="POST" action="" autocomplete="off">
                <div class="container">
                    <h1>Change the E-mail</h1><hr />
                    <label><b>Current E-mail address</b></label>
                    <input type="text" name="curEmail" Placeholder="Enter your current Email"/>
                    <label><b>New E-mail address</b></label>
                    <input type="text" name="newEmail" Placeholder="Enter your new E-mail"/>
                    <button name="saveEmail" class="Submitbtn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="Address" class="tabcontent">
        <div class="Password">
            <form  method="POST" action="" autocomplete="off">
                <div class="container">
                    <h1>Change the Address</h1><hr />
                    <label><b>New Address</b></label>
                    <textarea name="newAdd" cols="40" rows="6" ></textarea>
                    <button name="saveAddress" class="Submitbtn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <?php


    $dbObj= database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    session_start();
    /*$member_id = $_SESSION['id'];*/
    $m= new member();
    $m->load($dbObj, '1');

    /*$sql = "Select id,member_name,member_fullname,member_type,join_date,addmission_date,permanent_address,current_address,member_email,contact_no from members where id = 1 ";
    $result = $m->featuredLoad($dbObj,$sql);*/
    ?>
    <div id="tableMyProf" class="tabcontent">
			<table class =MyprofTable">
				<th align="center" class ="tableCaption" colspan="2"><h1>My Profile Details</h1> </th>
				<tr>
					<th>Member ID</th>
					<td><?php echo $m->id ?></td>
				</tr>
				<tr>
					<th>Name</th>
					<td><?php echo $m->member_name ?></td>
				</tr>
				<tr>
					<th>Full Name</th>
					<td><?php echo $m->member_fullname ?></td>
				</tr>
				<tr>
					<th>Member Type</th>
					<td><?php echo $m->member_type ?></td>
				</tr>
				<tr>
					<th>Joined Date</th>
					<td><?php echo $m->join_date ?></td>
				</tr>
				<tr>
					<th>Addmission Date</th>
					<td><?php echo $m->addmission_date ?></td>
				</tr>
				<tr>
					<th>Permanent Address</th>
					<td><?php echo $m->permanent_address ?></td>
				</tr>
				<tr>
					<th>Current Address</th>
					<td><?php echo $m->current_address ?></td>
				</tr>
				<tr>
					<th>E-mail</th>
					<td><?php echo $m->member_email ?></td>
				</tr>
				<tr>
					<th>Contact No.</th>
					<td><?php echo $m->contact_no ?></td>
				</tr>
			</table>
		</div>



    <script>
        function ClickOption(evt, optionName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(optionName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>



    </body>
    </html>






