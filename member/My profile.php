
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
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
        <h3>Click on the buttons to change your settings</h3>
        <button class="tablinks" onclick="ClickOption(event, 'Password')" id="defaultOpen">Password</button>
        <button class="tablinks" onclick="ClickOption(event, 'E-mail')">E-mail</button>
        <button class="tablinks" onclick="ClickOption(event, 'Address')">Address</button>
    </div>


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
                    <input type="password" name="ConNewPsw" Placeholder="Re enter your new password"/>
                    <button name="save" class="Submitbtn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="E-mail" class="tabcontent">
        <div class="Password">
            <form  method="POST" action="" autocomplete="off">
                <div class="container">
                    <h1>Change the E-mail</h1><hr />
                    <label><b>Current E-mail address</b></label>
                    <input type="text" name="curEmail" Placeholder="Enter your current Email"/>
                    <label><b>New E-mail address</b></label>
                    <input type="text" name="newEmail" Placeholder="Enter your new E-mail"/>
                    <button name="save" class="Submitbtn" type="submit">Save Changes</button>
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
                    <button name="save" class="Submitbtn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <?php

    include("../database.php");
    include("../member.php");
    include("../table.php");
    $dbObj= database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $m= new member();
    $sql = "Select id,category_no,title,author,book_type,book_status from books where $value = '$input' ";

    ?>
    <div class="tableMyProf">
        <table class =MyprofTable">
            <th align="center" class ="tableCaption" colspan="2"><h1>My Profile Details</h1> </th>
            <tr>
                <th>Member ID</th>
                <td>150377G</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>A.S.Madhushanki</td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td>Ariyasinghage shalika madhushanki</td>
            </tr>
            <tr>
                <th>Member Type</th>
                <td>Student</td>
            </tr>
            <tr>
                <th>Joined Date</th>
                <td>2015.11.22</td>
            </tr>
            <tr>
                <th>Addmission Date</th>
                <td>2015.09.25</td>
            </tr>
            <tr>
                <th>Permanent Address</th>
                <td>No:07,"Shoba", Bemmulla</td>
            </tr>
            <tr>
                <th>Current Address</th>
                <td>No.124u,sdhdj ,Moratuwa</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>shali.madhushanki@gmail.com</td>
            </tr>
            <tr>
                <th>Contact No.</th>
                <td>0717377514</td>
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






