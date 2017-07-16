<!DOCTYPE html>
<html>
<head>
    <title>Library-Home</title>
    <link rel = "stylesheet" href ="css/mainpage.css"/>
    <style>img.warImg{display:none;}</style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="Images/siyane_logo.jpg"/>
            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education<br />Veyangoda</h3>
        </div>
    </div>
    <div class="bgimage">
        <nav>
            <ul class="navbar">
                <li><a href="#">HOME</a></li>
                <li class="adminprof"><a href="admin/Admin%20Login.php">ADMIN LOGIN</a></li>
            </ul>
        </nav>
    </div>
</header>
<article class="whitebg">
    <?php
    include("database.php");
    include("table.php");
    include("login.php");
    include ("member.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $msg='';


    if(isset($_POST["SubmitBotton"])) {
        if (empty($_POST['uname']) || empty($_POST['Psw'])) {

            $msg= " Invalid login. Try again..!";
        } else {
            $user_name = $_POST['uname'];
            $password = $_POST['Psw'];
            $enPass = md5("$password");
            $login = new login();
            $result = $login->load($dbObj,$user_name);
            $numOfRows = mysqli_num_rows($dbObj->getResult());
            $m= new member();
            $sql= "Select member_status from members WHERE id= '$user_name' ";
            $resultStatus = $login->featuredLoad($dbObj,$sql);
            $mem_status=mysqli_fetch_row($resultStatus)[0];
            $lst_login_date=date('Y-m-d');


            if ($numOfRows == 1 && $login->password==$enPass && $mem_status=="active" && $login->id==$user_name) {
                session_start();
                $login->last_login_date=$lst_login_date;
                $login->update($dbObj);
                $_SESSION['id'] =$user_name;
                header("Location:member/Member Page.php");
            } else {
                ?>
                <style>img.warImg{display: inline-block;}</style>
                <?php
                $msg= " Invalid login. Try again..!";
            }
        }
    }?>

    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 7</div>
            <img src="Images/1slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 7</div>
            <img src="Images/2slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 7</div>
            <img src="Images/3slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">4 / 7</div>
            <img src="Images/4slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">5 / 7</div>
            <img src="Images/5slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">6 / 7</div>
            <img src="Images/6slide.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <div class="numbertext">7 / 7</div>
            <img src="Images/7slide.jpg" style="width:100%">
        </div>

        <div style="text-align:center">
            <br />
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
    <br>



    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex> slides.length) {slideIndex = 1}
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>


    <form class="memberLoginForm" method="POST" action="index.php" autocomplete="off">

        <h2 align="center">User Login</h2>
        <div class="imgcontainer"><img src="Images/login-bg.png" alt="" class="loginimge"/></div>
        <div class="container">
            <span class="warningMsg"><img class="warImg" src="Images/warning.gif" height="25px" width="25px"/><?php echo $msg ; ?></span><br />
            <label for="user"><b>Username</b></label><br />
            <input id="user" name="uname" type="text" placeholder="Enter Username" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" required autofocus/><br />
            <label for="psw"><b>Password</b></label><br />
            <input id="psw" name="Psw" type="password" placeholder="Enter Password" required/><br />
            <button class="subBtn" name="SubmitBotton" type="submit">Login</button>
            <button class="cancelbtn" type="button">Cancel</button>
        </div>
    </form>


    <section class="linkarea">
        <h3>Quick Links</h3>
        <a class="sncoelink" href="http://www.siyanencoe.sch.lk/" target="_blank" >SNCoE Website</a><hr />
        <div class="stretch"><strong>Contact Information</strong> <br />
            <p class="hidden">This text is hidden.</p>
            <b>President :</b> <i class="TPnumber">+94333832157</i><br />
            <b>Vice President (Administration) :</b> <i class="TPnumber">+94332287213</i><br />
            <b>Vice President (Academic) :</b><i class="TPnumber"> +94333832156</i><br />
            <b>Registrar :</b><i class="TPnumber"> +94332287587</i><br />
            <b>Fax :</b> <i class="TPnumber">+94332287213</i>
        </div>
    </section>

    <div class="About"><h3>LIBRARY HOURS</h3>
        Monday to Friday     9.00a.m. to  4.00p.m.<br /><br /><br />
        <strong>"Let knowledge grow from more<br /> to more and thus be human life enriched." </strong> <br />
        <span class="ency">-Encyclopedia Britannica-</span>
    </div>

    <div class="para1"><h2 class="heading">Our Mission</h2>
        Our mission is to provide proper guidance to the prospective teachers through devoted service to build up
        physically and mentally sound, professionally competent, well-disciplined, committed Science, Mathematics, and Technical
        studies teachers by pre-service teacher education.</div>
    <div class="para2"><h2 class="heading">Our Vision</h2>
        Our vision is to develop Siyane National College of Education into an outstanding teacher education
        institute which provides excellent Science, Mathematics and Technical Studies teachers to the schools of Sri Lanka.<br /><br />
        </div>


</article>

<footer>
<p style="text-align:center;" >Copyright @ 2017 Library, Siyane National College of Education, Paththalagedara, Veyangoda, Sri Lanka.
    <br />Designed by <img src="Images/Solutia_logo.png" width="130px" height="80px"/></p>
</footer>
</body>
</html>
