<?php
include "database.php";

$database->create_table("users","user_id serial PRIMARY KEY, Prenom VARCHAR ( 50 ) NOT NULL, nom varchar(100) not null, password VARCHAR ( 50 ) NOT NULL, email VARCHAR ( 255 ) UNIQUE NOT NULL, created_on TIMESTAMP NOT NULL, last_login TIMESTAMP");

print("table crée");