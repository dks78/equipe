<?php

require('../configs/database.php');


if (isset($_POST['submit'])) {
    
    var_dump( $pdo);
    $error = false;
    $error_email = '';
    $error_password = '';

    //ours variables

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    //Check if all field are not empty

    if (!empty($email) and !empty($password) and !empty($confirmPassword)) {

        //check if the entered email is not exist in database

        $checkEmailExist = $pdo->prepare('SELECT email from admins where email = ?');

        $checkEmailExist->execute(array($email));
        $results = $checkEmailExist->fetch(PDO::FETCH_ASSOC);
        var_dump( $results);

        if ($results) {
            $error = true;
            $error_email = 'Email already taken';
        } else {

            if ($password == $confirmPassword) {

                //Save the Admin

                $saveAdmin =  $pdo->prepare('INSERT INTO admins(email, password) VALUES(?,?)');
                $saveAdmin->execute(array($email, sha1($password)));

                if ($saveAdmin) {
                    header('location: index.php');
                    exit;
                } else {
                    $error = true;
                    $error_email = 'Error when creatind your account';
                }
            } else {
                $error = true;
                $error_password = 'Password and confirm password are not match';
            }
        }
    } else {
        $error = true;
        $error_email = 'Email required';
        $error_password = 'Password required';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../assets/css/login.css">
    <title>PHP rental project</title>
</head>
<body>
    <h1>Register as Admin</h1>
    <form action="" method="post">
    <?php

if (isset($error)) { ?>
    <div class="row">
        <div class="error"><?= $error_email ?></div>
        <div class="error"><?= $error_password ?></div>
    </div>
<?php }

?>    

        <div class="row">
        <label for="email"> Email </label>
        <input type="email" name="email" autocomplete="off"
        placeholder="email@example.com">
        </div>
        <div class="row">   
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <div class="row">   
        <label for="confirmPassword">Confirm password</label>
            <input type="password" name="confirmPassword">
        </div>
        <button type="submit" name='submit'> Register as admin</button>
        <div class="links">
            <div class="link">
                <a href="../../index.php">Back to login</a>
            </div>

        </div>
    </form>
</body>
</html>