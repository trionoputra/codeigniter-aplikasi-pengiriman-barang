<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bootstrap/css/bootstrap.min.css')?>">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/AdminLTE.min.css')?>">
	
	<script src="<?php echo base_url('assets/template/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
	<script src="<?php echo base_url('assets/template/bootstrap/js/bootstrap.min.js')?>"></script>
	
</head>
 <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>ADMINISTRATOR</b></a>
      </div>
      <div class="login-box-body">
	  <?php
				$msg = $this->session->flashdata('admin_login_msg');
				?>
				<?php if(!empty($msg)): ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $msg;?>
				</div>
		<?php endif; ?>
        <form action="<?php echo site_url("login/auth") ?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name='username' placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name='password'>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
  
</html>