<?php
session_start();
$_SESSION=array();
session_destroy();
setcookie("email", "", time()-3600);
setcookie("password", "", time()-3600);
header('location: login_page.php')
?>
