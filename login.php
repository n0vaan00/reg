<?php
require('headers.php');
require('functions.php');

try {
    $dbcon = new PDO('mysql:host=localhost;dbname=n0vaan00', 'root', '');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//avaa yhteyden
    createTable($dbcon);
//valitsee käyttäjätunnuksen
    $username = "anuvay";
    $sql= "SELECT firstname FROM user WHERE username=:username";

    $prepared= $dbcon->prepare($sql);
    $prepared->bindParam(':username', $username);

    $prepared->execute();

//tulostaa etunimen//
    foreach($prepared as $row){
        echo $row['firstname'];
    }

}catch(PDOException $e) {
    echo '<br>'.$e->getMessage();
}


?>