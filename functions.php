<?php

function checkUser(PDO $dbcon, $username, $password){
        try{
            $sql = "SELECT * FROM user WHERE username=?";
            $prepare = $dbcon->prepare($sql);
            $prepare->execute(array($username));

            $rows = $prepare->fetchAll();

            foreach($rows as $row){
                $pw = $row["password"];
                if(password_verify($password, $pw)){
                    return true;
                }
            }        
            return false;
            
        }catch(PDOException $e) {
            echo '<br>'.$e->getMessage();
        }
}

function createUser(PDO $dbcon, $firstnamer, $lastnamer, $usernamer, $passwordr){
        try{
    //     $json = json_decode(file_get_contents('php://input'));
    // //sanitoi data
    //     $firstnamer = filter_var($json->firstnamer, FILTER_SANITIZE_STRING);
    //     $lastnamer = filter_var($json->lastnamer, FILTER_SANITIZE_STRING);
    //     $usernamer = filter_var($json->usernamer, FILTER_SANITIZE_STRING);
    //     $passwordr = filter_var($json->passwordr, FILTER_SANITIZE_STRING);
    //hash salasana
        $hash = password_hash($passwordr, PASSWORD_DEFAULT);

    //lisää tiedot
        $sql= "INSERT IGNORE INTO user VALUES(?,?,?,?)";
    //valmistellaan komento
        $prepared= $dbcon->prepare($sql);
    //suoritetaan komento
        $prepared->execute(array($firstnamer, $lastnamer, $usernamer, $hash));
    
        }catch(PDOException $e) {
            echo '<br>'.$e->getMessage();
        }
}

function getDbconnect(){
    try {
        $dbcon = new PDO('mysql:host=localhost;dbname=n0vaan00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //avaa yhteyden
        createTable($dbcon);
    }catch(PDOException $e) {
        echo '<br>'.$e->getMessage();
    }
    return $dbcon;
}

function createTable($con){
        $sql = "CREATE TABLE IF NOT EXISTS user(
            firstname varchar(50) NOT NULL,
            lastname varchar(50) NOT NULL,
            username varchar(50) NOT NULL,
            password varchar(50) NOT NULL,
            PRIMARY KEY (username)
            )";

        $sql_add = "INSERT IGNORE INTO user VALUES ('Anu', 'Väyrynen', 'anuvay', 'anuvay')";
        
        $con->exec($sql);  
        $con->exec($sql_add);
}

?>