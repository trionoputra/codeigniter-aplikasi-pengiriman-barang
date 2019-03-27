<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
	
	<script src="<?php echo base_url('assets/template/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
</head>
  <body class="hold-transition skin-blue layout-boxed sidebar-mini">
    <div class="wrapper">
	  <?php echo $this->load->view($layout);?>
    </div>
  </body>
</html>

