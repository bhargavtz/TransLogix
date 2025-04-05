<?php
session_start();

$_SESSION = array();
session_destroy();

header('location: ./TransLogix/login.php');
exit;
?>