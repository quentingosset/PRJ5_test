<?php

function dbConnect(
    $serverName="localhost",
    $dbName="ecole",
    $userName  ="root",
    $password  ="") {
        $conn = new PDO( "mysql:host=$serverName;dbname=$dbName;charset=utf8", 
        $userName, $password);
    return $conn;
} 