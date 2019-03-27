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
					<form  class="form-horizontal" method="post" action="<?php echo site_url("barang/save")?>"  >
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data->id_barang; ?>" >
						<div class="box-body">
							<div class="form-group">
								<label for="id_barang" class="col-sm-2 control-label">ID Barang</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="id_barang"  name="id_barang" value="<?php echo $data->id_barang == "" ? $data->autocode : $data->id_barang; ?>"  readonly   >
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="nama"  name="nama" placeholder="input nama" value="<?php echo $data->nama; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="id_kategori" class="col-sm-2 control-label">Kategori</label>
								<div class="col-sm-3">
								   <select class="form-control" name="id_kategori">
									  <?php foreach ($kategori as $kt):?>
									  <option value="<?php echo $kt['id_kategori'];?>" <?php echo $data->id_kategori == $kt['id_kategori'] ? ' selected' : '';?> ><?php echo $kt['nama']?></option>
									  <?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="del_no" class="col-sm-2 control-label">Del No</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control"  required="required" id="del_no"  name="del_no" placeholder="input del no" value="<?php echo $data->del_no; ?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="satuan" class="col-sm-2 control-label">Satuan</label>
								<div class="col-sm-3">
									<select class="form-control" name="satuan">
										<option value="SATUAN 1" >SATUAN 1</option>
										<option value="SATUAN 2" >SATUAN 2</option>
										<option value="SATUAN 3" >SATUAN 3</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" name="action" value="save">save</button>
							<button type="submit" class="btn btn-success" name="action" value="saveexit">save & exit</button>
							<button type="reset" class="btn btn-warning">reset</button>
							<a  href="<?php echo site_url("barang")?>" class="btn btn-danger">cancel</a>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</section>
</div>