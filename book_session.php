<?php

class book_session extends table
{
    var $id=null;
    var $book_id=null;
    var $member_id=null;
    var $date_of_borrowal=null;
    var $date_to_be_returned=null;
    var $date_of_returned=null;
    var $session_status=null;
    var $table="book_sessions";

}
?>