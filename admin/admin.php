<?php

/**
 * Created by PhpStorm.
 * User: DiniX
 * Date: 29-Jun-17
 * Time: 12:58 AM
 */
class admin extends table
{
    var $table = "admins";
    var $id = null;
    var $admin_name = null;
    var $admin_type = null;
    var $username = null;
    var $password = null;
    var $join_date = null;
    var $last_login_date = null;
    var $state = null;

    public function __construct()
    {
    }
}

?>