<?php
require('../configs/database.php');
include("../includes/header.php");


    $name = $_POST['car_name'];
    $day_price  = $_POST['day_price'];
    $month_price  = $_POST['month_price'];
    $day_price  = $_POST['day_price'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $insurance = $_POST['insurance'];
    $car_id = $_POST['carId'];

    // var_dump($car_id);

    $customer_id = $_SESSION['customer_id'];



    // Create DateTime objects
$start_datetime = new DateTime($start_date);
$end_datetime = new DateTime($end_date);

// Calculate the difference
$interval = $start_datetime->diff($end_datetime);

// Get the difference in days
$days_difference = $interval->days;

// Now $days_difference contains the number of days between start_date and end_date
echo "Number of days between start and end date: $days_difference";

if ($days_difference >= 30) {
    if($insurance){
        $full_months = floor($days_difference / 30);
       
        var_dump( $day_price);
        $remaining_days = $days_difference % 30;
        
        $price = ($full_months * $month_price) + ($remaining_days * $day_price)+ ($days_difference *15);
        echo "case1:  $price ";
    }
    else {
        $full_months = floor($days_difference / 30);
       
        $remaining_days = $days_difference % 30;
        
        $price = ($full_months * $month_price) + ($remaining_days * $day_price);
        echo "case2:  $price ";

    }
}
 else {
    if ($insurance) {
     $price =  $day_price*$days_difference + ($days_difference *15);
     echo "case3:  $price ";
    }
else {
    $price =  $day_price*$days_difference;
    echo "case4:  $price ";
}
 }


 $query = "INSERT INTO orders (car_name, start_date, end_date, insurance, price, days, user_id,  car_id)
    VALUES (:car_name, :start_date, :end_date, :insurance, :price, :days, :user_id, :car_id)";

$statement = $pdo->prepare($query);
$statement->bindValue(':car_name', $name, \PDO::PARAM_STR);
$statement->bindValue(':car_id', $car_id, \PDO::PARAM_STR);


$statement->bindValue(':start_date', $start_date, \PDO::PARAM_STR);
$statement->bindValue(':end_date', $end_date, \PDO::PARAM_STR);

$statement->bindValue(':user_id', $customer_id, \PDO::PARAM_INT);
$statement->bindValue(':insurance', $insurance, \PDO::PARAM_BOOL);
$statement->bindValue(':price', $price, \PDO::PARAM_INT);
$statement->bindValue(':days', $days_difference, \PDO::PARAM_INT);
$statement->execute();
    
  
      
   


   




?>