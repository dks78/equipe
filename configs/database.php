<?php 


//$databaseConnexion= new PDO('mysql:host=127.0.0.1;dbname=car_rental', 'root', '');
function connect_bd(): PDO
{
    $host = "localhost:3308";
    $dbname = "car_rental";
    $username = "root";
    $password = "password";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Ошибка подключения: " . $e->getMessage();
        return null;
    }
}

connect_bd()
?>
