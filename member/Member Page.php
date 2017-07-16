<?php session_start();
$welcomeMsg='';?>
<!DOCTYPE html>
<html>
<head>
    <title>Member Page</title>
    <link rel = "stylesheet" href ="css/Member Page.css"/>
</head>
<body>
<header>
    <div class="head_top"><img class="siyanelogo" src="images/siyane_logo.jpg">
        <div class="logo_name">
            <h1>LIBRARY</h1>
            <h3>Siyane National College Of Education<br />Veyangoda</h3>
        </div>
    </div>

    <?php

    include("../database.php");
    include("../table.php");
    include("../member.php");
    $dbObj=database::getInstance();
    $dbObj->connect('localhost','root','','lms_db');
    $m=new member();

    $mem_id=$_SESSION['id'];
    $sql= "Select member_name from members where id ='$mem_id' ";
    $result=$m->featuredLoad($dbObj,$sql);
    $name=mysqli_fetch_row($result)[0];

    if(!empty($_SESSION['id'])){
        $welcomeMsg=" Hi ".$name."...!!!  Welcome to Siyane National College of Education Library Page.";}
    ?>

    <div class="slideText">
        <marquee behavior="scroll" direction="left"><p class="WelMsg"><?php echo $welcomeMsg;?></p></marquee>
            </div>

    <div class="bgimage">
        <nav>
            <ul>
                <li><a href="Member Page.php">HOME</a></li>
                <li id="logout" class="logout"><a href="../index.php">LOGOUT</a></li>

            </ul>
        </nav>
    </div>
</header>
<article>

    <div class="linkbox" id="myProfile"><span><strong>My Profile</strong><br /><br /></span>

        <a href="My%20profile.php"><img src="images/useraccount.jpg" align="center"/></a></div><br />

    <div class="linkbox" id="searchbk"><span><strong>Search Books</strong><br /><br /></span>
        <a  href="Search%20Book.php"><img src="images/searchbook.jpg" align="center"/></a></div><br />

    <div class="linkbox" id="prevRecords"><span><strong>Previous Records</strong><br /></span>
        <a href="Previous%20Records.php"><img src="images/bookmark.png" align="center"/></a></div><br />



    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 7</div>
            <img src="images/1slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 7</div>
            <img src="images/2slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 7</div>
            <img src="images/3slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">4 / 7</div>
            <img src="images/4slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">5 / 7</div>
            <img src="images/5slide.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">6 / 7</div>
            <img src="images/6slide.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <div class="numbertext">7 / 7</div>
            <img src="images/7slide.jpg" style="width:100%">
        </div>

        <div style="text-align:center">
            <br /><br />
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

    <div class="About"><strong>"Let knowledge grow from more to more and thus be human life enriched." </strong> <br />
        <span class="ency">"Encyclopaedia Britannica"</span></div>

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
    <p style="text-align: center;">Copyright @ 2017 Library, Siyane National College of Education, Paththalagedara, Veyangoda, Sri Lanka<br />
        Designed by <img src="../Images/Solutia_logo.png" width="140px" height="80px"/></p>
</footer>

</body>
</html>
<?php
if (isset($_GET['id']) && $_GET['id']=="logout"){
    $_SESSION['user']='';
    session_destroy();
}
?>