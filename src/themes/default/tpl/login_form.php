<form method="post" action="<?= $absolute_url ?>dispatcher.php">
    <label for="email">Email</label>
    <input type="text" name="email" class="login_input" tabindex="1" />
    <label for="password">Password</label>
    <input type="password" name="password" class="login_input" tabindex="2" />
    <input type="submit" name="submit" value="<?= $login_submit ?>" class="login_submit" tabindex="3" />
    <input type="hidden" name="pts_action" value="log_in" />
</form>