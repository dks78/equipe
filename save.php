<?php
$password=$_POST['password'];
$email=$_POST['email'];
$password = password_hash($password , PASSWORD_BCRYPT);
$pdo = new \PDO('mysql:host=127.0.0.1;dbname=car_rental', 'root', 'Caraboumga1.');
$query = "INSERT INTO customers (password, email) VALUES (:password,:email)";
$statement = $pdo->prepare($query);
$statement->bindValue(':email', $email, \PDO::PARAM_STR);
$statement->bindValue(':password', $password, \PDO::PARAM_STR);
$statement->execute();
header("location:login.php");
?>