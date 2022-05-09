<?php
session_start();

session_unset();
session_destroy();
$msg="Please login to continue!";
header("location: login.php?msg=".$msg);
exit;
?>