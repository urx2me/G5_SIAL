<?php
/*
Template Name: Logout
*/
session_start();
session_unset();
session_destroy();
wp_logout(); // WordPress logout function
header("Location: " . home_url());
exit;
?>
