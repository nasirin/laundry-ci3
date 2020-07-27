<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- icon tab -->
  <link rel="icon" type="image/png" href="<?= base_url()?>assets/img/laundryLogo.png">
  <title>Ship Laundry</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/login/')?>css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/login/')?>css/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg">
                <div class="p-5 ">
                  <!-- alert -->
                  <div class="login" data-login="<?= $this->session->flashdata('error')?>">
                  </div>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Ship Laundry</h1>
                  </div>
                  <form class="user" action="<?= site_url('auth/login')?>" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Show Password</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" name="login">
                    Login
                    </button>        
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= site_url('auth/login_member')?>">Login member</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/login/')?>js/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/login/')?>js/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/login/')?>js/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/login/')?>js/js-sb2/sb-admin-2.min.js"></script>
  <!-- sweetalert2 -->
  <script src="<?= base_url('assets/login/js/'); ?>sweetalert2/sweetalert2.all.min.js"></script>
  <script src="<?= base_url('assets/login/js/'); ?>myscript/myscript-login.js"></script>
  
  <!-- show password -->
  <script>
    $(document).ready(function(){
      $('#customCheck').click(function(){
        if($(this).is(':checked')){
          $('#password').attr('type','text');
        }else{
          $('#password').attr('type','password');
        }
      });
    });
  </script>
</body>

</html>
