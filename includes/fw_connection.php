<?php

/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:host=localhost;dbname=u725001497_fw;charset=UTF8';
$user = 'u725001497_fw';
$password = 'k2583110';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
   //$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


   //echo "Connected successfully"; 

} catch (PDOException $e) {
   echo 'Connection failed: ' . $e->getMessage();
}


    
