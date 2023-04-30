<?php

include_once('custom/globals-without-login.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rubay Wines | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css?ver=<?php echo CURRENT_VERSION;?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css?ver=<?php echo CURRENT_VERSION;?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css?ver=<?php echo CURRENT_VERSION;?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Rubay</b> Wines
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->

      <form action="process/login_process.php" method="post">
		<input type="hidden" name="mode" value="login">

        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email/Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          	<?php
          	if($_SESSION['login_error']!="")
          	{
          	?>
	          	<div class="color-palette-set">
	              <div class="bg-danger disabled color-palette"><span><?php echo $_SESSION['login_error'];?></span></div>
	            </div>
          	<?php          		
          	}
          	?>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js?ver=<?php echo CURRENT_VERSION;?>"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js?ver=<?php echo CURRENT_VERSION;?>"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js?ver=<?php echo CURRENT_VERSION;?>"></script>
</body>
</html>
