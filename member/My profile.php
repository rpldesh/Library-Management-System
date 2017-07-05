
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
                    <label><b>Username</b></label>
                    <input type="text" name="uname" Placeholder="Enter the username"/>
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
                    <label><b>Username</b></label>
                    <input type="text" name="uname" Placeholder="Enter the username"/>
                    <label><b>Current E-mail address</b></label>
                    <input type="text" name="curEmail" Placeholder="Enter your current Email"/>
                    <label><b>New E-mail address</b></label>
                    <input type="text" name="newEmail" Placeholder="Enter your new E-mail"/>
                    <label><b>Confirm new E-mail address</b></label>
                    <input type="text" name="ConNewEmail" Placeholder="Re enter your new E-mail"/>
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
                    <label><b>Username</b></label>
                    <input type="text" name="uname" Placeholder="Enter the username" />
                    <label><b>Current address</b></label>
                    <textarea name="curAdd" cols="40" rows="6" ></textarea>
                    <label><b>New Address</b></label>
                    <textarea name="newAdd" cols="40" rows="6" ></textarea>
                    <button name="save" class="Submitbtn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
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






