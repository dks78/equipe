<?php 


//$databaseConnexion= new PDO('mysql:host=127.0.0.1;dbname=car_rental', 'root', '');

    $host = "localhost:3308";
    $dbname = "car_rental";
    $username = "root";
    $password = "password";


        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      
?>
