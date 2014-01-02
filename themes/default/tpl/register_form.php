<form method="post" action="<?= $absolute_url ?>dispatcher.php">
    <div class="left">
        <label for="fname">First Name</label>
        <input type="text" name="fname" class="register_input" tabindex="4" />
        <label for="email">Email</label>
        <input type="text" name="email" class="register_input" tabindex="6" />
        <label for="password">Password</label>
        <input type="password" name="password" class="register_input" tabindex="8" />
    </div>
    <div class="right">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" class="register_input" tabindex="5" />
        <label for="emailconfirm">Re-enter Email</label>
        <input type="text" name="emailconfirm" class="register_input" tabindex="7" />
        <input type="submit" name="submit" value="<?= $register_submit ?>" class="login_submit" tabindex="9" />
    </div>
    <input type="hidden" name="pts_action" value="register" />
</form>