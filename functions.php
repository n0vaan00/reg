<?php

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