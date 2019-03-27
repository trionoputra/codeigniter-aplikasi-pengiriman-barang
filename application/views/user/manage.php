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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("user/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_user; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_user" class="col-sm-2 control-label">ID User</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_user" placeholder="select user" name="id_user" value="<?php echo $data->id_user == "" ? $data->autocode : $data->id_user; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">Username</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="username"  name="username" placeholder="input username" value="<?php echo $data->username; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-4">
								  <input type="password" class="form-control" id="password" placeholder="input password" name="password" value="">
								</div>
							</div>
							<div class="form-group">
								<label for="level" class="col-sm-2 control-label">Level</label>
								<div class="col-sm-4">
								   <select class="form-control" name="level" required="required">
									   <option value="1" <?php echo $data->level == "1" ? ' selected' : '';?> >Administrator</option>
									   <option value="2" <?php echo $data->level == "2" ? ' selected' : '';?> >Finance</option>
									   <option value="3" <?php echo $data->level == "3" ? ' selected' : '';?> >Staff Gudang</option>									   
									</select>
								</div>
							</div>
						</div>
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("user")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>