<?php

function changeData(PDO $dbcon, $username){
    try {
        $json = json_decode(file_get_contents('php://input'));
    //sanitoi data
        
        $phone = filter_var($json->phone, FILTER_SANITIZE_STRING);
        $email = filter_var($json->email, FILTER_SANITIZE_STRING);
        
    
    //lisää tiedot molempiin tauluihin
        $sql2= "INSERT INTO contact VALUES(?,?,?)";

        $prepared2= $dbcon->prepare($sql2);

        $prepared2->execute(array($username, $email, $phone));

    }catch(PDOException $e) {
        echo '<br>'.$e->getMessage();
    }
}

function checkUser(PDO $dbcon, $username, $password){

        //sanitoi data
            $username = filter_var($username, FILTER_SANITIZE_STRING);
            $password = filter_var($password, FILTER_SANITIZE_STRING);
    
    try{
        //tarkista käyttäjän syöttämät tiedot
            $sql = "SELECT password FROM user WHERE username=?";
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
            session_start();
            echo '<br>'.$e->getMessage();
        }
}

function createUser(PDO $dbcon, $firstname, $lastname, $username, $password){
        try {
            $json = json_decode(file_get_contents('php://input'));
        //sanitoi data
            $firstname = filter_var($json->firstname, FILTER_SANITIZE_STRING);
            $lastname = filter_var($json->lastname, FILTER_SANITIZE_STRING);
            $phone = filter_var($json->phone, FILTER_SANITIZE_STRING);
            $email = filter_var($json->email, FILTER_SANITIZE_STRING);
            $username = filter_var($json->username, FILTER_SANITIZE_STRING);
            $password = filter_var($json->password, FILTER_SANITIZE_STRING);
        //hash salasana
            $hash = password_hash($password, PASSWORD_DEFAULT);
        //lisää tiedot molempiin tauluihin
            $sql= "INSERT INTO user VALUES(?,?,?,?)";
            $sql2= "INSERT INTO contact VALUES(?,?,?)";
    
            $prepared= $dbcon->prepare($sql);
            $prepared2= $dbcon->prepare($sql2);
    
            $prepared->execute(array($firstname, $lastname, $username, $hash));
            $prepared2->execute(array($username, $email, $phone));

        }catch(PDOException $e) {
            echo '<br>'.$e->getMessage();
        }
}

function getDbconnect(){
    try {
        $dbcon = new PDO('mysql:host=localhost;dbname=n0vaan00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //luo taulut
         createTable($dbcon);
    }catch(PDOException $e) {
        echo '<br>'.$e->getMessage();
    }
    return $dbcon;
}

function createTable(PDO $dbcon){
        $sql = "CREATE TABLE IF NOT EXISTS user(
            firstname varchar(50) NOT NULL,
            lastname varchar(50) NOT NULL,
            username varchar(50) NOT NULL,
            password varchar(200) NOT NULL,
            PRIMARY KEY (username)
            )";


        $sql_add = "INSERT IGNORE INTO user VALUES ('Anu', 'Väyrynen', 'anuvay', 'anuvay')"; 
        
        $dbcon->exec($sql);
        $dbcon->exec($sql_add);
}
function createTable2(PDO $dbcon){
    $sql2 = "CREATE TABLE IF NOT EXISTS contact (
        username varchar(50) NOT NULL,
        email varchar(100),
        phone varchar(20),
        FOREIGN KEY (username) REFERENCES user(username)
        )";

    $sql_add2 = "INSERT INTO contact VALUES ('anuvay', 'n0vaan00@students.oamk.fi', '050 123 456 78');";
    
    $dbcon->exec($sql2);
    $dbcon->exec($sql_add2);
}

?>