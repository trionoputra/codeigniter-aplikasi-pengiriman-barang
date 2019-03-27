<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kurir extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("kurir_model");
		$this->cekLoginStatus("admin",true);
    }
	
	public function index()
	{
		$data['title'] = "DATA KURIR";
		$data['layout'] = "kurir/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->kurir_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("kurir?");
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
		$data['title'] = "FORM KURIR";
		$data['layout'] = "kurir/manage";

		$data['data'] = new StdClass();
		$data['data']->id_kurir = "";
		$data['data']->nama = "";
		$data['data']->telepon = "";
		$data['data']->jenis_kelamin = "";
		$data['data']->alamat = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->kurir_model->get_by("id_kurir",$id,true);
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
			
			if(!empty($post['id_kurir']))
				$data['id_kurir'] = $post['id_kurir'];
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
			
			if(!empty($post['jenis_kelamin']))
				$data['jenis_kelamin'] = $post['jenis_kelamin'];
			else
				$error[] = "jenis kelamin tidak boleh kosong"; 
			
			if(!empty($post['alamat']))
				$data['alamat'] = $post['alamat'];
			else
				$error[] = "alamat tidak boleh kosong"; 
			
			if(empty($id))
			{
				if(!empty($post['password']))
					$data['password'] = md5($post['password']);
				else
					$error[] = "password tidak boleh kosong";
			}
			else
			{
				if(!empty($post['password']))
					$data['password'] = md5($post['password']);
			}
			
			if(empty($error))
			{
				if(empty($id))
				{
					$cekkurir = $this->kurir_model->get_by("id_kurir",$post['id_kurir']);
					if(!empty($cekkurir))
						$error[] = "id sudah terdaftar"; 
				}
			}
			
			if(empty($error))
			{
				$save = $this->kurir_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("kurir/manage/".$id);
				else
					redirect("kurir");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("kurir/manage/".$id);
			}
		}
		else
		  redirect("kurir");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->kurir_model->get_by("id_kurir",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("kurir");
			}
			else
			{
				$cek = $this->kurir_model->cekAvalaible($id);
				if(!empty($cek))
				{
					$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
					redirect("kurir");
				}
				else
				{
					$this->kurir_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("kurir");
				}
			}
		}
		else
			redirect("kurir");
	}
	
	public function generate_code()
	{
		$prefix = "KRR";
		$code = "01";
		
		$last = $this->kurir_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_kurir,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
