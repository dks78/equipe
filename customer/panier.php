<?php

require('../configs/database.php');
include("../includes/header.php");

if (!$_SESSION['customer_logged']){
    header('location: login.php');
}

if (isset($_SESSION['customer_id'])) {
    
    $customer_id = $_SESSION['customer_id'];

    $ordersQuery = $pdo->prepare('SELECT * FROM orders WHERE user_id = :customer_id');

    $ordersQuery->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);

    $ordersQuery->execute();

    $results = $ordersQuery->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        forEach($results as $result) {
          
            if ($result) {
                echo  "Name: " . $result['car_name'] . ", Price: " . $result['price'] . "<br>";
                echo  "Days: " . $result['days'] . ", insurance: " . $result['insurance'] . "<br>";
                   // Add a form with a delete button for each result
            echo '<form action="delete_order.php" method="post">';
            echo '<input type="hidden" name="order_id" value="' . $result['id'] . '">';
            echo '<input type="submit" name="delete" value="Delete">';
            echo '</form>';
            echo "<br>";
             // Add an edit button linking to an edit_order.php page
             echo '<form action="edit_order.php" method="post">';
             echo '<input type="hidden" name="order_id" value="' . $result['id'] . '">';
             echo '<input type="submit" name="edit" value="Edit">';
             echo '</form>';
 
            echo "<br><br>";
                } else {
                  
                    echo "No results found for Car ID:";
                }
        }
       
        } else {

            echo "No results found for this user";
        }
  
    }
?>

