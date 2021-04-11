drop user if exists 'secure_login'@'localhost';
create user 'secure_login'@'localhost' identified by ?;
-- Use a strong password here, and replace it on build/includes/connexion.php

grant select on secure_login.users to 'secure_login'@'localhost';
grant select, insert on secure_login.connexions to 'secure_login'@'localhost';
flush privileges;