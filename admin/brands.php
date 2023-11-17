<?php

session_start();

if (!$_SESSION['admin_logged']) {
    header('location: registration.php');
}


?>

<?php include('./includes/header.php') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



<div class="modal" tabindex="-1" role="dialog" id="brandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='modal-title'>Add new car</h5>
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
                    <h4 class="page-title">Brand</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <div class="d-md-flex">
                        <ol class="breadcrumb ms-auto">
                            <li><a href="#" class="fw-normal"></a></li>
                        </ol>
                        <div class="btn btn-danger  d-none d-md-block pull-right ms-3 
                        hidden-xs hidden-sm waves-effect waves-light
                         text-white open-car-modal">Add new brand</div>
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

<?php include('./includes/footer.php') ?>


<script>
    //initialize jquery
    $(document).ready(function(){

        //check if we press on open modal buttton
       
        $('.open-brand-modal').click(function(){
            $('#modal-title').text('Add new Brand for cars')
            $('#brandModal').modal('show');
        });

    });
</script>