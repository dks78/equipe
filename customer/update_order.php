<?php
require('../configs/database.php');
include("../includes/header.php");

if (!$_SESSION['customer_logged']) {
    header('location: login.php');
} else {

    if (isset($_POST['edit'])) {
        var_dump($_POST);
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $insurance = $_POST['insurance'];
        $id = $_POST['id'];

        $singleCarQuery = $pdo->prepare('SELECT * FROM orders WHERE id = :id');
        $singleCarQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $singleCarQuery->execute();

        $result = $singleCarQuery->fetch(PDO::FETCH_ASSOC);

        var_dump($result);

        $name = $result['car_name'];
        $day_price = $result['day_price'];
        $month_price = $result['month_price'];

        $start_datetime = new DateTime($start_date);
        $end_datetime = new DateTime($end_date);

        // Calculate the difference
        $interval = $start_datetime->diff($end_datetime);

        // Get the difference in days
        $days_difference = $interval->days;

        // Now $days_difference contains the number of days between start_date and end_date
        echo "Number of days between start and end date: $days_difference";

        if ($days_difference >= 30) {
            if ($insurance) {
                $full_months = floor($days_difference / 30);
                var_dump($day_price);
                $remaining_days = $days_difference % 30;
                $price = ($full_months * $month_price) + ($remaining_days * $day_price) + ($days_difference * 15);
                echo "case1:  $price ";
            } else {
                $full_months = floor($days_difference / 30);
                $remaining_days = $days_difference % 30;
                $price = ($full_months * $month_price) + ($remaining_days * $day_price);
                echo "case2:  $price ";
            }
        } else {
            if ($insurance) {
                $price = $day_price * $days_difference + ($days_difference * 15);
                echo "case3:  $price ";
            } else {
                $price = $day_price * $days_difference;
                echo "case4:  $price ";
            }
        }

        $query = "UPDATE orders SET start_date=:start_date, end_date=:end_date, insurance=:insurance, price=:price, days=:days WHERE id=$id";

        $statement = $pdo->prepare($query);

    
        $statement->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $statement->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $statement->bindValue(':insurance', $insurance, PDO::PARAM_BOOL);
        $statement->bindValue(':price', $price, PDO::PARAM_INT);
        $statement->bindValue(':days', $days_difference, PDO::PARAM_INT);
        $statement->execute();

        var_dump('success');
    }
}
?>
