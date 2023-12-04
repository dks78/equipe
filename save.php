<?php
// $password=$_POST['password'];
// $email=$_POST['email'];
// $password = password_hash($password , PASSWORD_BCRYPT);
// $pdo = new \PDO('mysql:host=127.0.0.1;dbname=car_rental', 'root', 'Caraboumga1.');
// $query = "INSERT INTO customers (password, email) VALUES (:password,:email)";
// $statement = $pdo->prepare($query);
// $statement->bindValue(':email', $email, \PDO::PARAM_STR);
// $statement->bindValue(':password', $password, \PDO::PARAM_STR);
// $statement->execute();
// header("location:login.php");
//?>

<?php


class Database {
    private $pdo;
    public function __construct($host, $dbname, $username, $password) {
        $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function insertCustomer($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO customers (password, email) VALUES (:password, :email)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword, \PDO::PARAM_STR);
        $statement->execute();
    }
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Utilisation de la classe Database
try {
    $database = new Database('127.0.0.1', 'car_rental', 'root', 'Caraboumga1.');

    if (isset($_POST['password']) && isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $database->insertCustomer($email, $password);

        header("Location:login.php");
        exit();
    }
} catch (\PDOException $e) {
    die("Erreur de base de données: " . $e->getMessage());
}
?>
