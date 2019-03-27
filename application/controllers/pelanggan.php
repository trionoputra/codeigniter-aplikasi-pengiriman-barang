<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pelanggan extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("pelanggan_model");
		$this->cekLoginStatus("admin",true);
    }
	
	public function index()
	{
		$data['title'] = "DATA PELANGGAN";
		$data['layout'] = "pelanggan/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->pelanggan_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("pelanggan?");
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
		$data['title'] = "FORM PELANGGAN";
		$data['layout'] = "pelanggan/manage";

		$data['data'] = new StdClass();
		$data['data']->id_pelanggan = "";
		$data['data']->nama = "";
		$data['data']->telepon = "";
		$data['data']->alamat = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->pelanggan_model->get_by("id_pelanggan",$id,true);
			if(!empty($dt))
				$data['data'] = $dt;
		}
		
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
			
			if(!empty($post['id_pelanggan']))
				$data['id_pelanggan'] = $post['id_pelanggan'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama']))
				$data['nama'] = $post['nama'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
			if(!empty($post['telepon']))
				$data['telepon'] = $post['telepon'];
			else
				$error[] = "telepon tidak boleh kosong"; 
			
			if(!empty($post['alamat']))
				$data['alamat'] = $post['alamat'];
			else
				$error[] = "alamat tidak boleh kosong"; 
				
			if(empty($error))
			{
				if(empty($id))
				{
					$cekpelanggan = $this->pelanggan_model->get_by("id_pelanggan",$post['id_pelanggan']);
					if(!empty($cekpelanggan))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->pelanggan_model->get_by("nama",$post['nama']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar"; 
				}
				else
				{
					$cek = $this->pelanggan_model->cekName($id,$post['nama']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->pelanggan_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("pelanggan/manage/".$id);
				else
					redirect("pelanggan");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("pelanggan/manage/".$id);
			}
		}
		else
		  redirect("pelanggan");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->pelanggan_model->get_by("id_pelanggan",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("pelanggan");
			}
			else
			{
				$cek = $this->pelanggan_model->cekAvalaible($id);
				if(!empty($cek))
				{
					$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
					redirect("pelanggan");
				}
				else
				{
					$this->pelanggan_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("pelanggan");
				}
			}
		}
		else
			redirect("pelanggan");
	}
	
	public function generate_code()
	{
		$prefix = "CST";
		$code = "0001";
		
		$last = $this->pelanggan_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_pelanggan,3,4) +1;
			$code = str_pad($number, 4, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
