<?php
session_start();
require('headers.php');
require('functions.php');

if(checkUser(getDbconnect(), "maijam", "maijam")){
    $_SESSION["user"] = "maijam";
    echo "oikein";
}else{
    echo "väärin";
}


?>