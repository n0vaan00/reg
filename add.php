<?php
require('headers.php');
require('functions.php');

createUser(getDbconnect(), $firstname, $lastname, $email, $phone, $username, $password);


?>