<?php

require('headers.php');
require('functions.php');

//createUser(getDbconnect(), "maija", "mehiläinen", "maijam", "maijam");

if(checkUser(getDbconnect(), "maijam", "maijam")){
    $_SESSION["user"] = "maijam";
    echo "oikein";
}else{
    echo "väärin";
}

?>