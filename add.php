<?php
require('headers.php');
require('functions.php');

$json = json_decode(file_get_contents('php://input'));
$firstname = filter_var($json->firstname, FILTER_SANITIZE_STRING);
$lastname = filter_var($json->lastname, FILTER_SANITIZE_STRING);
$username = filter_var($json->username, FILTER_SANITIZE_STRING);
$password = filter_var($json->password, FILTER_SANITIZE_STRING);

try {
    $dbcon = new PDO('mysql:host=localhost;dbname=n0vaan00', 'root', '');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//lisää tiedot
    $sql= "INSERT INTO user VALUES(?,?,?,?)";

    $prepared= $dbcon->prepare($sql);

    $prepared->execute(array($firstname, $lastname, $username, $password));

//tulostaa etunimen//
    foreach($prepared as $row){
        echo $row['firstname'];
    }

}catch(PDOException $e) {
    echo '<br>'.$e->getMessage();
}


?>