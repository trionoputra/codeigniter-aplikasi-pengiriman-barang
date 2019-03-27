<?php 
	$CI =& get_instance();
?>
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
	
	<link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/iCheck/all.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/skins/_all-skins.min.css')?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/AdminLTE.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
	
	
	<script src="<?php echo base_url('assets/template/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
		
	<script src="<?php echo base_url('assets/template/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/template/plugins/select2/select2.full.min.js')?>"></script>
	<script src="<?php echo base_url('assets/template/plugins/iCheck/icheck.min.js')?>"></script>
	<script src="<?php echo base_url('assets/template/plugins/fastclick/fastclick.min.js')?>"></script>
    <script src="<?php echo base_url('assets/template/dist/js/app.min.js')?>"></script>
</head>
  <body class="hold-transition skin-blue layout-boxed sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <span class="logo-mini"><b>KRM</b></span>
          <span class="logo-lg"><b>PENGIRIMAN</b></span>
        </a>
		
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('assets/template/dist/img/avatar5.png')?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $CI->getLoginName();?></span>
                </a>
              </li>
			  <li>
                <a href="<?php echo site_url('login/logout')?>" ><i class="glyphicon glyphicon-log-out"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('assets/template/dist/img/avatar5.png')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $CI->getLoginName();?></p>
			  <span class="hidden-xs"><?php echo $CI->getLoginID();?></span>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="<?php echo site_url()?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa pull-right"></i>
              </a>
            </li>
			<?php if($CI->getStatus() == '1'): ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li ><a href="<?php echo site_url('kategori')?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
				<li ><a href="<?php echo site_url('barang')?>"><i class="fa fa-circle-o"></i> Barang</a></li>
				<li ><a href="<?php echo site_url('kurir')?>"><i class="fa fa-circle-o"></i> Kurir</a></li>
				<li ><a href="<?php echo site_url('pelanggan')?>"><i class="fa fa-circle-o"></i> Pelanggan</a></li>
				<li ><a href="<?php echo site_url('user')?>"><i class="fa fa-circle-o"></i> User</a></li>
              </ul>
            </li>
			<?php endif; ?>
			<?php if($CI->getStatus() == '3' || $CI->getStatus() == '1'): ?>
			<li>
              <a href="<?php echo site_url('pengiriman')?>">
                <i class="fa fa-file-text"></i> <span>Pengiriman</span> <i class="fa pull-right"></i>
              </a>
            </li>
			<?php endif; ?>
			<?php if($CI->getStatus() == '2' || $CI->getStatus() == '1'): ?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i> <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li ><a href="<?php echo site_url('pengiriman/rekap')?>"><i class="fa fa-circle-o"></i> Laporan Pengiriman</a></li>
              </ul>
            </li>
			<?php endif; ?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li ><a href="<?php echo site_url('changepassword')?>"><i class="fa fa-circle-o"></i> Ganti Password</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>
	
	  <?php echo $this->load->view($layout);?>
	  <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
  </body>
</html>

