<?php
session_start();
header("Cache-control: private"); // IE 6 Fix

function insertUser ($first_name, $last_name, $email, $password, $folder) {
	$sql = "INSERT INTO `users` (first_name, last_name, email, password, flags, per_page, folder) VALUES ('{$first_name}','{$last_name}','{$email}','{$password}',0,10,'{$folder}')";
	if ($r = mysql_query($sql))
		return true;
	else
		return false;
}

function updateUser ($first_name, $last_name, $email, $password) {
	//$sql = 'INSERT INTO `users` VALUES (null,{$first_name},{$last_name},{$email},{$password})';
	if ($r = mysql_query($sql))
		return true;
	else
		return false;
}


?>