<?php

session_start();

if (!$_SESSION['admin_logged']) {
    header('location: registration.php');
}


?>

<?php include('./includes/header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/admins/css/style.min.css">
  <title>PHP Car rental Project</title>
</head>
<body>

<div class="modal" tabindex="-1" role="dialog" id="carsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new car</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


        <div class="page-breadcrumb bg-white">

            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Cars</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <div class="d-md-flex">
                        <ol class="breadcrumb ms-auto">
                            <li><a href="#" class="fw-normal"></a></li>
                        </ol>
                        <div class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs 
                        hidden-sm waves-effect waves-light text-white open-car-modal">Add new car</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">Blank Page</h3>
                    </div>
                </div>
            </div>
 
        </div>
</body>
</html>
<?php include('./includes/footer.php') ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"> </script>
<script>
    //initialize jquery
    $(document).ready(function(){

        //check if we press on open modal buttton

        $('.open-car-modal').click(function(){
            $('#carsModal').modal('show');
        });

    });
</script>