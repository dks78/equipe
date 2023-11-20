<?php
require('../configs/database.php');
include("../includes/header.php");

if (!$_SESSION['customer_logged']){
    header('location: login.php');
}

else {
    if (isset($_POST['edit']))
   
    $id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $singleCarQuery = $pdo->prepare('SELECT * FROM orders WHERE id = :id');

    // Привязываем значение carId к плейсхолдеру
    $singleCarQuery->bindParam(':id', $id, PDO::PARAM_INT);

    // Выполняем запрос
    $singleCarQuery->execute();

    // Получаем результаты
    $savedOrder = $singleCarQuery->fetch(PDO::FETCH_ASSOC);

    var_dump($savedOrder);

}
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Booking Form</title>
    <style>
        .container {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #4ab994;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">


<form action="update_order.php" method="post">
    <label for="start-date">Start Date:</label>
    <input type="date" id="start-date" name="start_date" value="<?php echo $savedOrder['start_date']; ?>" required>

    <label for="end-date">End Date:</label>
    <input type="date" id="end-date" name="end_date" value="<?php echo $savedOrder['end_date']; ?>" required>

    <div>
        <input type="checkbox" id="insurance" name="insurance" value="<?php echo $savedOrder['insurance']; ?>" >
        <label for="insurance">Insurance</label>
    </div>

    <div>
        <input type="checkbox" id="agree" name="agree" value="yes" required>
        <label for="agree">Agree to Terms and Conditions</label>
    </div>

    <input type='hidden' value="<?= $id ?>" name="id" id="id" />



    <button type="submit" name="edit" value="edit">Book</button>
</form>
</div>
</body>
</html>
