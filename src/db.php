<?php

$host = "mariadb";
$sName = "mariadb";
$uName = "mariadb";
$pass = "mariadb";
$db_name = "db";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $uName, $pass);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there's an error, show it
    die("Connection failed: " . $e->getMessage());
}
?>
