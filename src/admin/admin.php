<?php
session_start();
header("Cache-control: private"); // IE 6 Fix
$site_live = true;
$debug_mode = true;

$database_name = 'dnyer11_prayertoshare';
$database_username = 'dnyer11_ptsadmin';
$database_password = 'SjHgHjigysC8';
if ($connect = mysql_connect("localhost",$database_username,$database_password))
	$db = mysql_select_db($database_name, $connect);

include('errors.php');
include('functions.php');

if (isset($_SESSION['user']['id'])) {
	$logged_in = true;
	$secure_uid = md5($_SESSION['user']['id']);
}

$absolute_url = 'http://www.prayer-to-share.com/';
$site_name = 'Prayer To Share';

$meta_title = 'Prayer To Share';
$meta_description = '';
$meta_keywords = '';

$current_theme = 'default';
$theme_path = 'themes/'.$current_theme;

include($theme_path.'/tpl/variables.php');
?>