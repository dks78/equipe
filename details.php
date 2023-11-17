<?php
include("./includes/header.php");

// Проверяем, есть ли car_id в запросе GET
if (isset($_GET['car_id'])) {
    // Получаем значение car_id
    $carId = $_GET['car_id'];

    // Подготавливаем SQL-запрос с плейсхолдером для безопасного использования в запросе
    $singleCarQuery = $pdo->prepare('SELECT * FROM cars WHERE id = :carId');

    // Привязываем значение carId к плейсхолдеру
    $singleCarQuery->bindParam(':carId', $carId, PDO::PARAM_INT);

    // Выполняем запрос
    $singleCarQuery->execute();

    // Получаем результаты
    $results = $singleCarQuery->fetchAll(PDO::FETCH_ASSOC);

    // Проверяем, есть ли результаты
    if ($results) {
        // Выводим результаты через HTML
        foreach ($results as $result) {?>
            <img  style="width: 18rem; height:13rem;" lass="card-img-top" src="./assets/images/<?= $result['img'];
            ?>" alt="Card image cap">;
            
            <?php
            echo '<h5 class="card-title"><a href="details.php">' . $result['name'] . '</a></h5>';
            echo '<p>' . $result['description'] . '</p>';
            echo '<p>Hourly Price: $' . $result['hour_price'] . '</p>';
            echo '<p>Daily Price: $' . $result['day_price'] . '</p>';
            echo '<p>Monthly Price: $' . $result['month_price'] . '</p>';
            echo '<p>Availability: ' . ($result['available'] ? 'Yes' : 'No') . '</p>';
        }
    } else {
        // Если результаты отсутствуют
        echo "No results found for Car ID: $carId";
    }
} else {
    // Если car_id отсутствует в запросе, обработайте это по вашему усмотрению
    echo "Car ID is missing in the GET request.";
}
?>
