<?php
session_start();
if (!$_SESSION['admin_logged']){
    header('location: admin_registr.php');
}
echo 'Admin with email:' .$_SESSION['admin_email'];
?>

<a href='logout.php'>Logout admin</a>