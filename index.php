<?php 

require('./configs/database.php');
include("./includes/header.php");


$fetchCars = $pdo->prepare('SELECT * from cars');


$fetchCars->execute();
$results = $fetchCars->fetchAll(PDO::FETCH_ASSOC);
displayCars($results);
$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$filteredBooks = filterCars($pdo, $searchTerm);


function filterCars(PDO $pdo, string $searchTerm): array
{
    $result = [];

    try {
        $sql = "SELECT * from cars
                
                WHERE name LIKE :searchTerm ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        $errorInfo = $stmt->errorInfo();
        if ($errorInfo[0] !== PDO::ERR_NONE) {
            echo "Ошибка при выполнении запроса: " . $errorInfo[2];
            return $result;
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results= $result;
        var_dump($result);
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }

    return $results;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href='./assets/admins/bootstrap/dist/css/bootstrap.min.css' defer> -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

   <link rel="stylesheet" href='./assets/styles_main.css' defer> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <title>Online car rental</title>
</head>
<body>

<div>
  <form method="get" action="" class="d-flex ms-auto" style="width: 18rem; margin-bottom:2rem; margin-right:5rem";>
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
    <button class="btn btn-outline-success" style='background-color: white;' type="submit">Search</button>
  </form>
</div>





<!-- content -->
<div class="container text-center" style="width: 100%;" >
  <div class="row align-items-start" style="width: 100%;">


<?php
function displayCars(array $results): void
{
foreach($results as $result){?>
<div class=class="col" style="width: 18rem; margin-left:1.5rem; margin-bottom:2rem;" >
<div class="card" style="width: 18rem;">
  <img  style="width: 18rem; height:13rem;" lass="card-img-top" src="./assets/images/<?= $result['img'];
  ?>" alt="Card image cap">

  <div class="card-body">
  <h5 class="card-title"><a href="customer/details.php?car_id=<?=$result['id'] ?>
  "><?php echo $result['name']; ?></a></h5>

    <div style="height:6rem; margin-bottom:.5rem;"> 
    <p class="card-text"> <?php echo $result['description'];
   
   ?></p>
      
    </div>
    <p class="card-text"><?php if($result['available'] !== 0) {echo "car is available for booking";
    }?>
    <small class="text-muted">

    </small></p>
    <a href="customer/booking.php?car_id=<?=$result['id'] ?>"
    class="btn btn-primary" style="background-color:rgb(74, 185, 148);"> Book</a>

  </div>
</div>

</div>
<?php
}}
?>


</div>

</div>
</body>
</html>