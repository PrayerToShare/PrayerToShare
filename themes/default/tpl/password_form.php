<form method="post" action="dispatcher.php">
    <label for="email">Email</label>
    <input type="text" name="email" class="login_input" tabindex="1" />
    <input type="submit" name="submit" value="<?= $password_submit ?>" class="login_submit" tabindex="3" />
    <input type="hidden" name="pts_action" value="retrieve_password" />
</form>