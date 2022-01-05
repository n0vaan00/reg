<?php
session_start();
require('headers.php');
require('functions.php');

if(isset($_SESSION["user"])){
    echo "Olet kirjautunut tunnuksella " . $_SESSION["user"];
    exit;
}
echo "nope";
header('HTTP/1.1 401');
?>