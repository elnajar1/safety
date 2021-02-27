<?php

/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:host=localhost:3306;dbname=w3lab;charset=UTF8';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //echo "Connected successfully"; 

} catch (PDOException $e) {
   echo 'Connection failed: ' . $e->getMessage();
}


    
