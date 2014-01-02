<?php
include('admin/admin.php');
session_start();
header("Cache-control: private"); // IE 6 Fix

if (isset($_POST['pts_action'])) {
	$pts_action = $_POST['pts_action'];
	switch ($pts_action) {
		case 'log_in':
			if (!$site_live) {
				header("Location: ".$absolute_url."?error=2");
			}
			else if ($_POST['email'] != '' && $_POST['password'] != '') {
				$sql = "SELECT * FROM `users` WHERE email='".$_POST['email']."' AND password='".md5($_POST['password'])."'";
				$r = mysql_query($sql);
				$row = mysql_fetch_array($r);
				$_SESSION['user'] = $row;
				
				if (mysql_num_rows($r) == 0)
					header("Location: ".$absolute_url."?error=5");
				else
					header("Location: ".$absolute_url);
			}
			else 
				header("Location: ".$absolute_url."?error=5");
		break;
		
		case 'register':
			$validemail = preg_match('/^[A-z0-9_\-\.]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $_POST['email']);
		
			if (!$site_live || $debug_mode) {
				header("Location: ".$absolute_url."?error=1");
			}
			else if ($_POST['email'] != '' && $_POST['emailconfirm'] != '' && $_POST['fname'] != '' && $_POST['lname'] != '' && $_POST['password'] != '') {
				if ($_POST['email'] == $_POST['emailconfirm'] && $validemail) {
					$sql = 'SELECT * FROM `users` WHERE email="'.$_POST['email'].'"';
					$r = mysql_query($sql);
					$cnt = mysql_num_rows($r);

					if ($cnt == 0) {
						insertUser(mysql_real_escape_string($_POST['fname']), mysql_real_escape_string($_POST['lname']), mysql_real_escape_string($_POST['email']), md5(mysql_real_escape_string($_POST['password'])), '');	
						/** Get SESSION Information **/
						$sql2 = "SELECT * FROM users WHERE email='".mysql_real_escape_string($_POST['email'])."' AND password='".mysql_real_escape_string(md5($_POST['password']))."'";
						$r2 = mysql_query($sql2);
						$row = mysql_fetch_array($r2);
						$_SESSION["user"] = $row;
						/** Assign Folder **/
						$folder = preg_replace('/\//','',stripslashes(htmlspecialchars(crypt(md5(mysql_real_escape_string($_POST['email'])),md5(rand(0,9))))));
						$nsql = "UPDATE users SET folder='".$folder."' WHERE id=".mysql_real_escape_string($_SESSION["user"]["id"]);
						mysql_query($nsql);
						$_SESSION["user"]["folder"] = $folder;
						/** Create Folder and Index Page **/
						mkdir("./!u/".$folder, 0777);
						$h = @fopen("./!u/".$folder."/index.php", 'w');
						fwrite($h,'<?php chdir("../../"); include_once("admin/admin.php"); $gval = "'.$folder.'"; include_once("profile.php"); ?>');
						fclose($h);
						header("Location: ".$absolute_url);
					} 
					else {
						header("Location: ".$absolute_url."?error=4");
					}
				} else {
					header("Location: ".$absolute_url."?error=3");
				}
			} else {
				header("Location: ".$absolute_url."?error=6");
			}
		break;
		
		case 'retrieve_password':
			
			header("Location: ".$absolute_url);
		break;
		
	}
}

if (isset($_GET['logout'])) {
	session_unset($_SESSION['user']);
	header("Location: ".$absolute_url);
}
?>