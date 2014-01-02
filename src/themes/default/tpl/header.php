<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?= $meta_description ?>" />
<meta name="keywords" content="<?= $meta_keywords ?>" />
<title><?= $meta_title ?></title>
<link rel="stylesheet" type="text/css" href="<?= $absolute_url.$theme_path ?>/css/styles.css" />
<script type="text/javascript" src="<?= $absolute_url.$theme_path ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?= $absolute_url.$theme_path ?>/js/scripts.js"></script>
</head>
<body>
<div id="container">
	<div id="header">
    	<div class="logo"><a href="<?= $absolute_url ?>"><img src="<?= $absolute_url.$theme_path ?>/images/logo.jpg" border="0" alt="<?= $site_name ?>" title="<?= $site_name ?>" /></a></div>
        <div class="header_links">
        	<ul>
            	<li><a href="<?= $absolute_url ?>" class="lvl1">Home</a></li>
                <li><a href="<?= $absolute_url ?>!u/<?= $_SESSION['user']['folder'] != '' ? $_SESSION['user']['folder'] : '' ?>" class="lvl1">Profile</a></li>
                <li>
                	<a href="<?= $absolute_url ?>admin.php?uid=<?= $secure_uid ?>" class="lvl1">Account</a>
                    <div class="menu">
                    	<?php if (isset($_SESSION['user']['id'])) { ?>
                    	<a href="<?= $absolute_url ?>settings.php">Account Settings</a>
                        <a href="<?= $absolute_url ?>privacy.php">Privacy Settings</a>
                        <a href="<?= $absolute_url ?>dispatcher.php?logout=true">Logout</a>
                        <div class="sep"></div>
						<? } ?>
                        <a href="<?= $absolute_url ?>help.php">Help</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="body">