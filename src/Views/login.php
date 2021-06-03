<form method="post" action="<?= SITE . '/User/process_login' ?> ">
    <label for="username">
        <input id="username" name="username" type="text" required>
    </label>

    <label for="password">
        <input id="password" name="password" type="password" required>
    </label>

    <input type="submit" value="Login">
</form>
