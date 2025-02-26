<?php

$host = 
$sName = "mariadb";
$uName = "root";
$pass = "mariadb";
$db_name = "simple_crud_app";

try {
    $conn = new PDO(
        "mysql:host=$sName;dbname=$db_name",
        $uName,
        $pass
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}

//1. check db connection, something is wrong with the values in db vs. dockerfile probably

//2. go through the landing pages and make them connect - then troubleshoot and proceed with the backend

//3. go to the gym loser