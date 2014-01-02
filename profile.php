<?php
include($theme_path.'/tpl/header.php');
$gval = mysql_real_escape_string($gval);
$usersql = "SELECT * FROM users WHERE folder='".$gval."'";

if ($logged_in && $userr = mysql_query($usersql)) {

	$userrow = mysql_fetch_array($userr);
	//include($theme_path.'/tpl/profile.php');
	echo $userrow['first_name'] . ' ' . $userrow['last_name'] . '<br />' . $userrow['email'];

} else {
	if ($error_msg != '') {
?>
		<div class="error_msg"><?= $error_msg ?></div>
<?php
	}
?>
    	<div class="login_register">
        	<div class="login">
            	<h2 class="box_headline"><?= $login_headline ?></h2>
                <div class="login_form">
<?php
include($theme_path.'/tpl/login_form.php');
?>
                </div>
                <div class="forgot_password">
                	<a href="forgot_password.php"><?= $forgot_password ?></a>
                </div>
            </div>
            <div class="register">
            	<h2 class="box_headline"><?= $register_headline ?></h2>
                <div class="login_form">
<?php
include($theme_path.'/tpl/register_form.php');
?>
                </div>
            </div>
        </div>
<?php
}
include($theme_path.'/tpl/footer.php');
?>
