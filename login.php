<?php
session_start();

if (isset($_POST['valid_connection'])) {
    if (
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password'])
    ) {
        $useremail = $_POST['email'];
        $password = $_POST['password'];
        $pdo = new \PDO('mysql:host=localhost;dbname=car_rental', 'root', 'Caraboumga1.');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT id, password FROM customers WHERE email = :email';
        $req = $pdo->prepare($sql);
        $req->bindParam(':email', $useremail, \PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch(\PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result['password'])) {
            // Connexion réussie, enregistrez l'ID de l'utilisateur dans la session
            $_SESSION['customer_id'] = $result['id'];
            $_SESSION['customer_email'] = $useremail; // Stockez d'autres informations de session si nécessaire
            header("Location: index.php");
            exit();
        } else {
            // Mot de passe incorrect
            $error_message = 'Erreur de connexion. Veuillez vérifier vos identifiants.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Car rental Project</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <h1>Login To Your Dashboard</h1>
    <form method="post">
        <?php
        if (isset($error_message) && !empty($error_message)) {
            echo '<div style="color: red;">' . $error_message . '</div>';
        }
        ?>
        <div class="row">
            <label for="email">Email</label>
            <input type="email" name="email" autocomplete="off" placeholder="email@example.com">
        </div>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div style="display: flex; color:#8086a9;">
            <input type="checkbox" name="log_admin">
            <label for="">Log as admin</label>
        </div>
        <div style="display: flex; color:#8086a9;">
            <div class="links">
                <a href="inscription.php" class="link">Create an account</a>
                <a href="/views/admin/registration" class="link">Admin account</a>
            </div>
        </div>
        <button type="submit" name="valid_connection">Login</button>
    </form>
</body>
</html>