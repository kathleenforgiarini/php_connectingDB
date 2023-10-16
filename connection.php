<?php
require_once 'dbconfig.php';

if(!mysqli_connect_errno()){    
    // processing : redirection database manipulation page
    header("location:manipulateDatabase.php");
}
else {
    // processing : redirection to the error page
    header("location:errorDatabase.php");
}