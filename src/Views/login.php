<?php
/* @var array $params */
?>

<form method="post" action="<?= SITE . '/User/process_login' ?> ">
    <label for="username">
        <input id="username" name="username" type="text" required>
    </label>

    <label for="password">
        <input id="password" name="password" type="password" required>
    </label>

    <input type="submit" value="Login">
</form>

<?php if ($params['error']): ?>
    <p>
        <?php
        switch ($params['error']) {
            case 'empty':
                echo 'Please enter your username and password';
                break;

            case 'invalid':
                echo 'Invalid username or password';
                break;

            default:
                echo 'Unknown error';
        }
        ?>
    </p>
<?php endif; ?>