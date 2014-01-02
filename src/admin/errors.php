<?php
session_start();
header("Cache-control: private"); // IE 6 Fix

if (isset($_GET['error'])) {
	switch($_GET['error']) {
		case '1': $error_msg = 'Registration is currently disabled. Please try back later.'; break;
		case '2': $error_msg = 'Sign In is currently disabled. Please try back later.'; break;
		case '3': $error_msg = 'Re-enter Email is incorrect. Please try again.'; break;
		case '4': $error_msg = 'An account already exists with this Email Address. Please try again.'; break;
		case '5': $error_msg = 'Incorrect Login Credentials. Please try again.'; break;
		case '6': $error_msg = 'Registration is incomplete. Please try again.'; break;
	}
}
?>