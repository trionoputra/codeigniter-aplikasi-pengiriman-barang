<?php
class Ajax extends Admin_Controller {
	
	public function getTableBarang()
	{
		$this->load->model("barang_model");
		
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		$filter->barang = $this->input->get('barang');
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 10;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->barang_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		$content = "<table class='table table-striped'>
						<thead>
						   <tr>
								<th>ID BARANG</th>
								<th>NAMA</th>
								<th>KATEGORI</th>
								<th>KETERANGAN</th>
								<th>Action</th>
							  </tr>
						</thead>
						<tbody>";
		
		if(sizeof($data['data']) == 0)
		{
			$content .= "<tr><td colspan='6'><h3>data tidak tersedia</h3></td></tr>";
		}
		else
		{
			foreach($data['data'] as $dt)
			{
				
				$content .= "<tr>
								<td>".$dt['id_barang']."</td>
								<td>".$dt['nama']."</td>
								<td>".$dt['kategori']."</td>
								<td>".$dt['keterangan']."</td>";

				$content .="<td><button type='button' class='btn btn-success btn-sm' href='#' onClick='pilih(&quot;".$dt['id_barang']."&quot;,&quot;".$dt['nama']."&quot;,&quot;".$dt['kategori']."&quot;,&quot;".$dt['satuan']."&quot;)' data-dismiss='modal'>pilih</button></td>";				
				$content  .= "</tr>";
			}
		}
		
		$content .= "</tbody></table>";
		
		$link = "";
		
		if($total > $limit)
		{
			$link .="<ul class='pagination'>";
			for($i=0;$i < $total/$limit;$i++)
			{
				if($page == $i+1)		
					$link .="<li class='active'><a>".($i+1)."</a></li>";
				else
					$link .="<li><a href='#' onclick='getBarang(".($i+1).")'>".($i+1)."</a></li>";
			}
			
			$link .="</ul>";
		}
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("ajax/getTableBarang?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		echo $content.($this->pagination->create_links());
	}
	
	public function getTablePelanggan()
	{
		$this->load->model("pelanggan_model");
		
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
			
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 10;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		
		list($data['data'],$total) = $this->pelanggan_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		$content = "<table class='table table-striped'>
						<thead>
						   <tr>
								<th>ID PELANGGAN</th>
								<th>NAMA</th>
								<th>ALAMAT</th>
								<th>TELEPON</th>
								<th>Action</th>
							  </tr>
						</thead>
						<tbody>";
		
		if(sizeof($data['data']) == 0)
		{
			$content .= "<tr><td colspan='5'><h3>data tidak tersedia</h3></td></tr>";
		}
		else
		{
			foreach($data['data'] as $dt)
			{
				
				$content .= "<tr>
								<td>".$dt['id_pelanggan']."</td>
								<td>".$dt['nama']."</td>
								<td>".$dt['alamat']."</td>
								<td>".$dt['telepon']."</td>";

				$content .="<td><button type='button' class='btn btn-success btn-sm' href='#' onClick='pilih(&quot;".$dt['id_pelanggan']."&quot;,&quot;".$dt['nama']."&quot;,&quot;".$dt['alamat']."&quot;)' data-dismiss='modal'>pilih</button></td>";
				
				
				$content  .= "</tr>";
			}
		}
		
		$content .= "</tbody></table>";
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("ajax/getTablePelanggan?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		echo $content.($this->pagination->create_links());
		
	}
	
	public function getTableKurir()
	{
		$this->load->model("kurir_model");
		
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 10;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		
		list($data['data'],$total) = $this->kurir_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		$content = "<table class='table table-striped'>
						<thead>
						   <tr>
								<th>ID KURIR</th>
								<th>NAMA</th>
								<th>JENIS KELAMIN</th>
								<th>TELEPON</th>
								<th>ALAMAT</th>
								<th>Action</th>
							  </tr>
						</thead>
						<tbody>";
		
		if(sizeof($data['data']) == 0)
		{
			$content .= "<tr><td colspan='6'><h3>data tidak tersedia</h3></td></tr>";
		}
		else
		{
			foreach($data['data'] as $dt)
			{
				
				$content .= "<tr>
								<td>".$dt['id_kurir']."</td>
								<td>".$dt['nama']."</td>
								<td>".$dt['jenis_kelamin']."</td>
								<td>".$dt['telepon']."</td>
								<td>".$dt['alamat']."</td>";

				
				$content .="<td><button type='button' class='btn btn-success btn-sm' href='#' onClick='pilih(&quot;".$dt['id_kurir']."&quot;,&quot;".$dt['nama']."&quot;)' data-dismiss='modal'>pilih</button></td>";
				
				
				$content  .= "</tr>";
			}
		}
		
		$content .= "</tbody></table>";
		
		$link = "";
		
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("ajax/getTableKurir?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		echo $content.($this->pagination->create_links());
		
	}
	
}	