

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ticket Management</title>
<!-- this is to change to logo of the top of the page -->
 <link rel="icon" type="image/png" href="../../../../../../dist/img/tt.jpg" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

@php

    $txt="";

    $txt_Error="";

@endphp

@if(Session::has('success'))

  @php($txt=Session::get('success'))

@endif

 
@if(Session::has('Error'))

  @php($txt_Error=Session::get('Error'))

@endif



<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="../../../../../../dist/img/alias.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity:" .8 width="150" height="150">
      <p class="h3"><br><b>Gestion Des Tickets</b></p>
    </div>
    <div class="card-body">

      <p class="login-box-msg">Démarrez votre session</p>


      <form action="{{route('login_post')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="e-mail" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="mot de passe" name="psw" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <a href="{{route('password_frg')}}">Mot de passe oublié ?</a>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary" style="float: right;">Se connecter</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<style>
  body {
    background-image: linear-gradient(to bottom, #004d99, #ffffff);
}
.button {
  padding: 1px 20px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #007bff;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.button{

  width: 115px;
}
</style>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
 <script>
var valid = "{{$txt}}";

var erreur = "{{$txt_Error}}";

if(valid!=""){

  swal("Opération réussie!", valid, "success");//"success" IS THE IMAGE, "Operation done successfully !" IS THE MESSAGE DISPLAYED , valid
          

}

if(erreur!=""){

   swal("Le mot de passe est incorrect!", valid, "error");

}
     
 </script>
</body>
</html>
