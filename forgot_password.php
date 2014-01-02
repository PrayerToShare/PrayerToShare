<?php
include('admin/admin.php');
?>
<?php 
include($theme_path.'/tpl/header.php');
?>
    	<div class="login_register">
        	<div class="login retrieve_password">
            	<h2 class="box_headline"><?= $password_headline ?></h2>
                <div class="login_form">
<?php
include($theme_path.'/tpl/password_form.php');
?>
                </div>
            </div>
        </div>
<?php
include($theme_path.'/tpl/footer.php');
?>
