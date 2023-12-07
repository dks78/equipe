<?php
require('../configs/database.php');
include("../includes/header.php");
class DateCalculator {
    public static function calculateDaysDifference($startDate, $endDate) {
        $startDatetime = new DateTime($startDate);
        $endDatetime = new DateTime($endDate);
        $interval = $startDatetime->diff($endDatetime);
        return $interval->days;
    }
}
class Order {
    private $name;
    private $dayPrice;
    private $monthPrice;
    private $startDatetime;
    private $endDatetime;
    private $insurance;
    private $carId;
    private $customerId;
    public function __construct($name, $dayPrice, $monthPrice, $startDatetime, $endDatetime, $insurance, $carId, $customerId) {
        $this->name = $name;
        $this->dayPrice = $dayPrice;
        $this->monthPrice = $monthPrice;
        $this->startDatetime = new DateTime($startDatetime);
        $this->endDatetime = new DateTime($endDatetime);
        $this->insurance = $insurance;
        $this->carId = $carId;
        $this->customerId = $customerId;
    }
    public function calculatePrice() {
        $daysDifference = DateCalculator::calculateDaysDifference($this->startDatetime->format('Y-m-d'), $this->endDatetime->format('Y-m-d'));
        if ($daysDifference >= 30) {
            if ($this->insurance) {
                $fullMonths = floor($daysDifference / 30);
                $remainingDays = $daysDifference % 30;
                $price = ($fullMonths * $this->monthPrice) + ($remainingDays * $this->dayPrice) + ($daysDifference * 15);
            } else {
                $fullMonths = floor($daysDifference / 30);
                $remainingDays = $daysDifference % 30;
                $price = ($fullMonths * $this->monthPrice) + ($remainingDays * $this->dayPrice);
            }
        } else {
            if ($this->insurance) {
                $price = $this->dayPrice * $daysDifference + ($daysDifference * 15);
            } else {
                $price = $this->dayPrice * $daysDifference;
            }
        }
        return $price;
    }
}
class OrderRepository {
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function insertOrder(Order $order) {
        $query = "INSERT INTO orders (car_name, start_date, end_date, insurance, price, days, user_id, car_id)
        VALUES (:car_name, :start_date, :end_date, :insurance, :price, :days, :user_id, :car_id)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':car_name', $order->getName(), PDO::PARAM_STR);
        $statement->bindValue(':car_id', $order->getCarId(), PDO::PARAM_INT);
        $statement->bindValue(':start_date', $order->getStartDatetime()->format('Y-m-d'), PDO::PARAM_STR);
        $statement->bindValue(':end_date', $order->getEndDatetime()->format('Y-m-d'), PDO::PARAM_STR);
        $statement->bindValue(':user_id', $order->getCustomerId(), PDO::PARAM_INT);
        $statement->bindValue(':insurance', $order->getInsurance(), PDO::PARAM_BOOL);
        $statement->bindValue(':price', $order->calculatePrice(), PDO::PARAM_INT);
        $statement->bindValue(':days', $order->calculateDaysDifference(), PDO::PARAM_INT);
        $statement->execute();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['car_name'];
    $dayPrice = $_POST['day_price'];
    $monthPrice = $_POST['month_price'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $insurance = $_POST['insurance'];
    $car_id = $_POST['carId'];
    $customer_id = $_SESSION['customer_id'];
    $order = new Order($name, $dayPrice, $monthPrice, $start_date, $end_date, $insurance, $car_id, $customer_id);
    $orderRepository = new OrderRepository($pdo);
    $orderRepository->insertOrder($order);
}


// require('../configs/database.php');
// include("../includes/header.php");
// if (!$_SESSION['customer_logged']){
//     header('location: login.php');
// }
// if (isset($_SESSION['customer_id'])) {
//     $customer_id = $_SESSION['customer_id'];
//     $ordersQuery = $pdo->prepare('SELECT * FROM orders WHERE user_id = :customer_id');
//     $ordersQuery->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
//     $ordersQuery->execute();
//     $results = $ordersQuery->fetchAll(PDO::FETCH_ASSOC);

//     if ($results) {
//         echo '<table class="table table-bordered table-striped">';
//         echo '<thead>';
//         echo '<tr>';
//         echo '<th>Name</th>';
//         echo '<th>Price</th>';
//         echo '<th>Days</th>';
//         echo '<th>Insurance</th>';
//         echo '<th>Action</th>';
//         echo '</tr>';
//         echo '</thead>';
//         echo '<tbody>';

//         foreach ($results as $result) {
//             echo '<tr>';
//             echo '<td>' . $result['car_name'] . '</td>';
//             echo '<td>' . $result['price'] . '</td>';
//             echo '<td>' . $result['days'] . '</td>';
//             echo '<td>' . $result['insurance'] . '</td>';
//             echo '<td>';
//             // Add a form with a delete button for each result
//             echo '<form action="delete_order.php" method="post" style="display:inline;">';
//             echo '<input type="hidden" name="order_id" value="' . $result['id'] . '">';
//             echo '<input type="submit" class="btn btn-danger" name="delete" value="Delete">';
//             echo '</form>';

//             // Add an edit button linking to an edit_order.php page
//             echo '<form action="edit_order.php" method="post" style="display:inline;">';
//             echo '<input type="hidden" name="order_id" value="' . $result['id'] . '">';
//             echo '<input type="submit" class="btn btn-warning" name="edit" value="Edit">';
//             echo '</form>';
//             echo '</td>';
//             echo '</tr>';
//         }

//         echo '</tbody>';
//         echo '</table>';
//     } else {
//         echo "No results found for this user";
//     }
// }
// 
 // <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
//     <title>Document</title>
// </head>
// <body>
//     <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
//       <symbol id="check2" viewBox="0 0 16 16">
//         <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
//       </symbol>
//       <symbol id="circle-half" viewBox="0 0 16 16">
//         <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
//       </symbol>
//       <symbol id="moon-stars-fill" viewBox="0 0 16 16">
//         <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
//         <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
//       </symbol>
//       <symbol id="sun-fill" viewBox="0 0 16 16">
//         <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
//       </symbol>
//     </svg>

//     <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
//       <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
//               id="bd-theme"
//               type="button"
//               aria-expanded="false"
//               data-bs-toggle="dropdown"
//               aria-label="Toggle theme (auto)">
//         <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
//         <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
//       </button>
//       <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
//         <li>
//           <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
//             <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
//             Light
//             <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
//           </button>
//         </li>
//         <li>
//           <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
//             <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
//             Dark
//             <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
//           </button>
//         </li>
//         <li>
//           <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
//             <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
//             Auto
//             <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
//           </button>
//         </li>
//       </ul>
//     </div>
// </body>
// </html> -->
?>