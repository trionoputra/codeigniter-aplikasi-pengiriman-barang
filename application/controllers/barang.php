<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("barang_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA BARANG";
		$data['layout'] = "barang/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->barang_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("barang?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		$this->load->view('template',$data);
	}
	
	public function manage($id = "")
	{
		$data['title'] = "FORM BARANG";
		$data['layout'] = "barang/manage";

		$data['data'] = new StdClass();
		$data['data']->id_barang = "";
		$data['data']->nama = "";
		$data['data']->id_kategori = "";
		$data['data']->satuan = "";
		$data['data']->del_no = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->barang_model->get_by("id_barang",$id,true);
			if(!empty($dt))
				$data['data'] = $dt;
		}
		$this->load->model("kategori_model");
		list($data['kategori'],$total) = $this->kategori_model->getAll(null,null,null,null,null);
		
		$this->load->view('template',$data);
	}
	
	public function save()
	{
		$data = array();
		$post = $this->input->post();
		
		if($post)
		{
			$error = array();
			$id = $post['id'];
			
			if(!empty($post['id_barang']))
				$data['id_barang'] = $post['id_barang'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama']))
				$data['nama'] = $post['nama'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
			if(!empty($post['id_kategori']))
				$data['id_kategori'] = $post['id_kategori'];
			else
				$error[] = "kategori tidak boleh kosong"; 
			
			if(!empty($post['satuan']))
				$data['satuan'] = $post['satuan'];
			else
				$error[] = "satuan tidak boleh kosong"; 
			
			if(!empty($post['del_no']))
				$data['del_no'] = $post['del_no'];
			else
				$error[] = "del no tidak boleh kosong"; 
		
			if(empty($error))
			{
				if(empty($id))
				{
					$cekbarang = $this->barang_model->get_by("id_barang",$post['id_barang']);
					if(!empty($cekbarang))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->barang_model->get_by("b.nama",$post['nama']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar"; 
				}
				else
				{
					$cek = $this->barang_model->cekName($id,$post['nama']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->barang_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("barang/manage/".$id);
				else
					redirect("barang");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("barang/manage/".$id);
			}
		}
		else
		  redirect("barang");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->barang_model->get_by("id_barang",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("barang");
			}
			else
			{
				$cek = $this->barang_model->cekAvalaible($id);
				if(!empty($cek))
				{
					$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
					redirect("barang");
				}
				else
				{
					$this->barang_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("barang");
				}
			}
		}
		else
			redirect("barang");
	}
	
	public function generate_code()
	{
		$prefix = "BRG";
		$code = "0001";
		
		$last = $this->barang_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_barang,3,4) +1;
			$code = str_pad($number, 4, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
