<?php

session_start();
require('headers.php');
require('functions.php');


if( isset($_SERVER['PHP_AUTH_USER']) ){
if(checkUser(getDbconnect(), $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])){
        echo 'Salasana oikein';
}else {
        echo 'Väärin meni'
        header('HTTP/1.1 401');
exit;
}
}


?>