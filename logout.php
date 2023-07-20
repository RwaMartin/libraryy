<?php
//initialize the seesion

session_start();

// unset all of the seesion variables

$_SESSION = array();

// Destroy the session

session_destroy();

// rediect to login page

header("location: index.php");
exit;