<?php

# Checking if client have send both a value for username and password
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: ../login.php?error=unset');
    die();
}

# Replaces any special characters to html version, avoid any attempts of XSS
$identifiant = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

# Checking if value are set before even checking their content
if (empty($identifiant) || empty($password)) {
    header('Location: ../login.php?error=empty');
    die();
}

$query_count_attempts = "
    select count(*) 
    from secure_login.connexions c
    inner join secure_login.users u on c.user_id = u.id
     
    where u.id = ? 
      -- reset connection attempts count every hours
    and hour(conn_time) = hour(now())
    and logged = 0;
";

include "connexion.php";

$cursor = $connexion->prepare($query_count_attempts);
$cursor->bindValue(1, $identifiant);
$cursor->execute();

$result = $cursor->fetch(PDO::FETCH_NUM);

if ($result[0] > 3) {
    header('Location: ../login.php?error=2many');
    die();
}

$query_hash = "
    select authentication_string as 'hash'
    from secure_login.users u
    
    where u.uid = ?;
";

$cursor = $connexion->prepare($query_hash);
$cursor->bindValue(1, $identifiant);
$cursor->execute();
$result = $cursor->fetch(PDO::FETCH_ASSOC);

# If array is empty, then user don't exist
if (empty($result)) {
    header('Location: ../login.php?error=incorrect');
    die();
}

$query_add_attempt = "
   insert into secure_login.connexions(user_id, conn_time, logged) 
   values ((select id from secure_login.users u where u.uid = ?), now(), ?)
";
$cursor = $connexion->prepare($query_add_attempt);
$cursor->bindValue(1, $identifiant);

# checking the hash
if ($result['hash'] !== hash('sha512', $password)) {
    $cursor->bindValue(2, 0);
    $cursor->execute();

    header('Location: ../login.php?error=incorrect');
    die();
}

$cursor->bindValue(2, 1);
$cursor->execute();

# Successfully passed all protection

session_start();
# Adding token for future preventing possible CSRF breach
# random_bytes is PHP 7.0+
try {
    $_SESSION['CSRF_TOKEN'] = hash('sha256', bin2hex(random_bytes(32)));

} catch (Exception $e) {
    # if CSRF cant be generated for any reason, kill the connexion
    session_destroy();
    header('Location: ../login.php?error=unexpected');
    die();
}

header('Location: ../logged.php');
die();
