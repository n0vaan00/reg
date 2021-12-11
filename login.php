<?php

require('headers.php');
require('functions.php');


if(checkUser(getDbconnect(), $username, $password)){
    header("Location: index.php");
}else{
    echo "Salasana väärin";
}

?>