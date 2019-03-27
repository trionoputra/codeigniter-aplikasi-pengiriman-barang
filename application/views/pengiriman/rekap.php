<link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datepicker/datepicker3.css')?>">
<script src="<?php echo base_url('assets/template/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<script>
	$(function(){
		$('#from').datepicker();
		$('#to').datepicker();
	});
</script>
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
					<div class="box-header">
						<div class="filter-wrapper box-tools pull-right">
								<form class="form-horizontal" method="get" action="<?php echo site_url("pengiriman/rekap")?>" id="filter-form">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-5  pull-right">
											<div class="form-action pull-right">
												<button type="submit" class="btn btn-success" name="action" value="excel">Export to Excel</button>
											</div>
										</div>
									</div>
									
								</div>
								<div class="panel-body">
									Periode
									<div class="row">
										<div class="col-md-3">
											<div class="input-group">
											 <div class="input-group-addon">dari</div>
											 <input type="text" class="form-control datepicker" id="from" name="from"  readonly data-date-format="mm/dd/yyyy" value="<?php echo $this->input->get("from") != "" ? date("m/d/Y",strtotime($this->input->get("from"))) : date("m/d/Y",strtotime("-30 days")) ?>">
											  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-group">
											 <div class="input-group-addon">sampai</div>
											<input type="text" class="form-control datepicker" id="to" name="to"  readonly data-date-format="mm/dd/yyyy" value="<?php echo $this->input->get("to") != "" ? date("m/d/Y",strtotime($this->input->get("to"))) : date("m/d/Y") ?>">
											  <div class="input-group-addon glyphicon glyphicon-calendar"></div>
											</div>
										</div>
										<div class="col-sm-3">
										   <select class="form-control input-sm" name="status">
										     <option value="all" <?php echo $this->input->get("status") == "all" ? ' selected' : '';?> >-status-</option>
											  <option value="1" <?php echo $this->input->get("status") == "1" ? ' selected' : '';?> >Dikirim</option>
											  <option value="2" <?php echo $this->input->get("status") == "2" ? ' selected' : '';?> >Diterima</option>
											  <option value="3" <?php echo $this->input->get("status") == "3" ? ' selected' : '';?> >Ditolak</option>
											  <option value="4" <?php echo $this->input->get("status") == "4" ? ' selected' : '';?> >Diterima sebagian</option>
											</select>
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-success" name="cari" value="cari">show</button>
										</div>
									</div>
								</form>
						</div>
					</div>
						<div class="box-body no-padding">
						<table class="table table-striped">
						<thead>
						  <tr>
							<th>ID PENGIRIMAN</th>
							<th>TANGGAL</th>
							<th>PELANGGAN</th>
							<th>KURIR</th>
							<th>PENERIMA</th>
							<th>KETERANGAN</th>
							<th>STATUS</th>
						  </tr>
						</thead>
						<tbody>
						<?php foreach($data as $dt): ?>
						  <tr>
							<td><?php echo $dt['id_pengiriman'];?></td>
							<td><?php echo date("d-m-Y",strtotime($dt['tanggal']));?></td>
							<td><?php echo $dt['pelanggan'];?></td>
							<td><?php echo $dt['kurir'];?></td>
							<td><?php echo $dt['penerima'];?></td>
							<td><?php echo $dt['keterangan'];?></td>
							<?php
							
								$status = "<span class='label label-default'>Dikirim</span>";
								if($dt['status'] == 2)
									$status = "<span class='label label-success'>Diterima</span>";
								else if($dt['status'] == 3)
									$status = "<span class='label label-danger'>Ditolak</span>";
								else if($dt['status'] == 4)
									$status = "<span class='label label-warning'>Diterima sebagian</span>";
							?>
							<td><?php echo $status;?></td>
						  </tr>
						<?php endforeach ?>
						</tbody>
					</table>
					</div>
				
				</div>
			</div>
		</div>
	</section>
</div>