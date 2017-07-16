<?php session_start(); ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Create/Disable Admin Account</title>
        <link rel = "stylesheet" href ="css/addNewAdminPageStyle.css"/>
        <link rel = "stylesheet" href ="css/AddBook.css"/>
        <style>div.alert{display:none;}</style>
    </head>
<body>
    <header>
        <div class="head_top">
            <div class="logo_name"><img class="siyanelogo" src="images/siyane_logo.jpg">

                <h1>LIBRARY</h1>
                <h3>Siyane National College of Education</br>Veyangoda</h3>

            </div>
        </div>
        <div class="bgimage">
            <nav>
                <ul>
                    <li><a href="Administration Page.php">HOME</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php
/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 14-Jul-17
 * Time: 1:02 PM
 */
include("../database.php");
include("../table.php");
include("admin.php");
$dbObj = database::getInstance();
$dbObj->connect('localhost','root','','lms_db');
$message = "";
$admin = new admin();

if(isset($_POST["entered"])){
    $username = $_POST["uName"];
    $sql = "Select * FROM admins WHERE username COLLATE Latin1_general_cs = '$username' LIMIT 1";
    $result = $admin->featuredLoad($dbObj, $sql);
    if (mysqli_num_rows($result) == 0){
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "Username does not exist..!!";
    }else if($_SESSION['username'] == $_POST["uName"]){
        ?> <style>div.alert{display:inline-block;}</style><?php
        $message = "You cannot disable your own account. Please seek assistance from another librarian account holder ..!!";
    }
    else if(mysqli_num_rows($result)==1) {
        foreach (mysqli_fetch_assoc($result) as $key => $value) {
            $admin->$key = $value;
        }
        $_SESSION["adminID"] = $admin->id;
        ?>
        <div class="Password">
            <form method="POST" action="" autocomplete="off">
                <div class="container">
                    <h1>Disable Admin Account</h1>
                    <hr/>
                    <label><b>Admin Name</b></label>
                    <input type="text" name="adName"  value="<?php echo $admin->admin_name; ?>" readonly/>
                    <label><b>Admin Type</b></label>
                    <input type="text" name="adType"  value="<?php echo $admin->admin_type; ?>" readonly/>
                    <label><b>Admin Username</b></label>
                    <input type="text" name="adUName"  value="<?php echo $admin->username; ?>" readonly/>
                    <label><b>Date Joined</b></label>
                    <input type="text" name="adJoinDate"  value="<?php echo $admin->join_date; ?>" readonly/>
                    <label><b>Account Status</b></label>
                    <input type="text" name="adStatus"  value="<?php echo $admin->admin_status; ?>" readonly/>
                    <button name="disable" class="Submitbtn" type="submit">Disable Account</button>
                </div>
            </form>
        </div>
        <?php
    }
}

if(isset($_POST["disable"])){
    $admin->load($dbObj, $_SESSION["adminID"]);
    $admin->admin_status = "restricted";
    $admin->update($dbObj);
    ?>
    <style>div.alert {
            display: inline-block;
        }</style><?php
    $message = "Admin disabled successfully..!!";
}

?>
    <div class="alert">
        <span class="closebtn" onclick="window.location='addNewAdminPage.php';">&times;</span>
        <?php echo $message;?>
    </div>
    <?php $dbObj->closeConnection(); ?>
</body>
</html>
