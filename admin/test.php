<?php
include("../database.php");
include("../table.php");
include("admin.php");
$dbObj=database::getInstance();
$dbObj->connect('localhost','root','','lms_db');

if(isset($_POST["login"])) {
    if (empty($_POST['uname']) || empty($_POST['psw'])) {
        echo "Username or password is invalid";
    } else {
        $username = $_POST['uname'];
        $password = $_POST['psw'];
        $encriptedPwd = md5("$password");
        $admin = new admin();
        $sql = "Select * from admins where username = $username";
        echo $sql."<br />";
        $result = $admin->featuredLoad($dbObj, $sql);
        $numOfRows = mysqli_num_rows($result);
        if ($numOfRows == 1) {
            foreach (mysqli_fetch_assoc($result) as $key => $value) {
                if ($key == 'id') {
                    continue;
                }
                $admin->$key = $value;
                echo $admin->$key . "<br />";
            }
            /*if($admin->admin_status != "allowed"){
                $message = "Your account is not valid anymore..!";
            }
            elseif($admin->pwd != $encriptedPwd  ){
                $message = "Incorrect password..!";
            }
            else {
                session_start();
                $admin->last_login_date = date("Y-m-d");
                $login->update($dbObj);
                $_SESSION['id'] = $user_name;
                header("Location:member/Member Page.php");
            }*/
        }
    }
}
?>