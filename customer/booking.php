<?php

require('../configs/database.php');
include("../includes/header.php");

if (!$_SESSION['customer_logged']){
    header('location: login.php');
}
// Проверяем, есть ли car_id в запросе GET
if (isset($_GET['car_id'])) {
    // Получаем значение car_id
    $carId = $_GET['car_id'];

    // Подготавливаемvar SQL-запрос с плейсхолдером для безопасного использования в запросе
    $singleCarQuery = $pdo->prepare('SELECT * FROM cars WHERE id = :carId');

    // Привязываем значение carId к плейсхолдеру
    $singleCarQuery->bindParam(':carId', $carId, PDO::PARAM_INT);

    // Выполняем запрос
    $singleCarQuery->execute();

    // Получаем результаты
    $result = $singleCarQuery->fetch(PDO::FETCH_ASSOC);

    // Проверяем, есть ли результаты
    if ($result) {
        echo '<h5 class="card-title"><a href="details.php">' . $result['name'] . '</a></h5>';
            echo '<p>Daily Price: $' . $result['day_price'] . '</p>';
            echo '<p>Monthly Price: $' . $result['month_price'] . '</p>';
            echo '<p>Availability: ' . ($result['available'] ? 'Yes' : 'No') . '</p>';
            echo '<p>Insurance 15$ a day</p>';
    } else {
        // Если результаты отсутствуют
        echo "No results found for Car ID: $carId";
    }
} else {
    // Если car_id отсутствует в запросе, обработайте это по вашему усмотрению
    echo "Car ID is missing in the GET request.";
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


<form action="order.php" method="post">
    <label for="start-date">Start Date:</label>
    <input type="date" id="start-date" name="start_date" required>

    <label for="end-date">End Date:</label>
    <input type="date" id="end-date" name="end_date" required>

    <div>
        <input type="checkbox" id="insurance" name="insurance" value="yes" >
        <label for="insurance">Insurance</label>
    </div>

    <div>
        <input type="checkbox" id="agree" name="agree" value="yes" required>
        <label for="agree">Agree to Terms and Conditions</label>
    </div>

    <input type='hidden' value="<?= $result['name'] ?>" name="car_name" id="car_name" />
    <input type='hidden' value="<?= $result['day_price'] ?>" name="day_price" id="day_price" />
    <input type='hidden' value="<?= $result['month_price'] ?>" name="month_price" id="month_price" />
    <input type='hidden' value="<?= $result['available'] ?>" name="available" id="available" />
    <input type='hidden' value="<?= $carId ?>" name="carId" id="carId" />


    <button type="submit">Book</button>
</form>
</div>
</body>
</html>
