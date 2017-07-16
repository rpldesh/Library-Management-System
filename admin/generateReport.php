<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 07-Jul-17
 * Time: 12:12 PM
 */

?>

<!DOCTYPE html>
<html>
<head>
    <title>Generate Book Circulation Report</title>
    <link rel = "stylesheet" href ="css/config_if_for_return.css"/>
    <script type="text/javascript">
        <!--
        function validateDates() {
           if(dateEntry.startDate.value > dateEntry.finishDate.value){
               alert("Invalid time period selected..!!");
               return false;
           }else{
               return true;
           }
        }
        //-->
    </script>
</head>
<body>
<header>

    <div class="head_top">
        <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

            <h1>LIBRARY</h1>
            <h3>Siyane National College of Education</br>Veyangoda</h3>

        </div>
    </div>
    <article class="backgroundimage">
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration%20Page.php">HOME</a></li>
                </ul>
            </nav>
        </div>
</header>

<div class="idconfigureform">
    <form class="Form" name="dateEntry" id="dateEntry" align="center" method="POST" action="reportGenerator.php" onsubmit="return validateDates()" autocomplete="off">
        <div class="container">
            <h1 align="center">Generate Books Circulation Report</h1><hr />
            <label class="date" for="startDate"><b>From :</b></label><br />
            <input id="startDate" name="startDate" type="date"  required autofocus/><br />
            <label class="date" for="finishDate"><b>To :</b></label><br />
            <input id="finishDate" name="finishDate" type="date"  required autofocus/><br />
            <button class="Submitbtn" name="generate" type="submit" >Generate Report</button>
            <button class="cancelbtn" onclick="window.location='Administration Page.php'" name="cancel" type="button" >Cancel</button>
        </div>
    </form>
</div>


</article>

</body>
</html>



