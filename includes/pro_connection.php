<?php

/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:host=localhost;dbname=u599732049_w3lab;charset=UTF8';
$user = 'u599732049_w3lab';
$password = 'Ho@1234567890';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //echo "Connected successfully"; 

} catch (PDOException $e) {
   echo 'Connection failed: ' . $e->getMessage();
}


    
