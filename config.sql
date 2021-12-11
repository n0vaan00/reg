drop database if exists n0vaan00;
create database n0vaan00;
use n0vaan00;

CREATE TABLE IF NOT EXISTS user (
            firstname varchar(50) NOT NULL,
            lastname varchar(50) NOT NULL,
            username varchar(50) NOT NULL,
            password varchar(200) NOT NULL,
            PRIMARY KEY (username)
            )

CREATE TABLE IF NOT EXISTS contact (
            username varchar(50) NOT NULL,
            email varchar(100),
            phone varchar(20)
            )

ALTER TABLE contact ADD FOREIGN KEY (username) REFERENCES user(username);

INSERT INTO user VALUES ('Anu', 'Väyrynen', 'anuvay', 'anuvay');
INSERT INTO contact VALUES ('anuvay','n0vaan00@students.oamk.fi', '050 123 456 78');