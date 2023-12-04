<!DOCTYPE html>
<!-- ... (Ваш заголовок и стилиx) ... -->
<body>
    <div>
        <form method="get" action="" class="d-flex ms-auto" style="width: 18rem; margin-bottom:2rem; margin-right:5rem";>
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"
                id="search">
            <button class="btn btn-outline-success" style='background-color: white;' type="submit">Search</button>
        </form>
    </div>
    <!-- content -->
    <div class="container text-center" style="width: 100%;">
    <div class="row align-items-start" style="width: 100%;">
    <?php
    class CarView
    {
    public function displayCars(array $results): void
    {
        
        foreach ($results as $result) {
            ?>
            <div class="col" style="width: 18rem; margin-left:1.5rem; margin-bottom:2rem;">
                <div class="card" style="width: 18rem;">
                    <img style="width: 18rem; height:13rem;" class="card-img-top"
                        src="./assets/images/<?= $result['img']; ?>" alt="Card image cap">

                    <div class="card-body">
                        <h5 class="card-title"><a href="customer/details.php?car_id=<?= $result['id'] ?>">
                                <?php echo $result['name']; ?></a></h5>

                        <div style="height:6rem; margin-bottom:.5rem;">
                            <p class="card-text"> <?php echo $result['description']; ?></p>

                        </div>
                        <p class="card-text"><?php if ($result['available'] !== 0) {
                                                    echo "car is available for booking";
                                                } ?>
                            <small class="text-muted">

                            </small></p>
                        <a href="customer/booking.php?car_id=<?= $result['id'] ?>"
                            class="btn btn-primary" style="background-color:rgb(74, 185, 148);"> Book</a>
                    </div>
                </div>

            </div>
        <?php
        }
    }
}  
