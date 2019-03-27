<?php 
	$CI =& get_instance();
?>
<div class="content-wrapper master">
	<section class="content-header">
	  <h1>
		<?php echo $title?>
	  </h1>
	</section>
	<?php
		 $msg_err = $this->session->flashdata('admin_save_error');
		 $msg_succes = $this->session->flashdata('admin_save_success');
	?>
	<?php if(!empty($msg_err)): ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong> <?php echo $msg_err;?>
	</div>
	<?php endif; ?>
	<?php if(!empty($msg_succes)): ?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Succes!</strong> <?php echo $msg_succes;?>
	</div>
	<?php endif; ?>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<form  class="form-horizontal" method="post" action="<?php echo site_url("changepassword/save")?>"  >
						<div class="box-body">
							<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Username</label>
					    <div class="col-sm-2">
					      <input type="text" class="form-control"  required="required" id="username" name="username" value="<?php echo $data->username; ?>">
					    </div>
						</div>
						<div class="form-group passwrapper">
							<label for="password" class="col-sm-2 control-label">Password Lama</label>
							<div class="col-sm-3">
							  <input type="password"  class="form-control" id="password" placeholder="input password lama" name="passwordold">
							</div>
						</div>
						<div class="form-group passwrapper">
							<label for="password" class="col-sm-2 control-label">Password Baru</label>
							<div class="col-sm-3">
							  <input type="password"  class="form-control" id="password" placeholder="input password baru" name="password">
							</div>
						</div>
					</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="reset" class="btn btn-warning">reset</button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>