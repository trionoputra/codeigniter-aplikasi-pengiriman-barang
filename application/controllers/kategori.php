<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kategori extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("kategori_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA KATEGORI";
		$data['layout'] = "kategori/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->kategori_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("kategori?");
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
		$data['title'] = "FORM KATEGORI";
		$data['layout'] = "kategori/manage";

		$data['data'] = new StdClass();
		$data['data']->id_kategori = "";
		$data['data']->nama = "";
		$data['data']->keterangan = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->kategori_model->get_by("id_kategori",$id,true);
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
			
			if(!empty($post['id_kategori']))
				$data['id_kategori'] = $post['id_kategori'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama']))
				$data['nama'] = $post['nama'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
			if(!empty($post['keterangan']))
				$data['keterangan'] = $post['keterangan'];
			else
				$error[] = "keterangan tidak boleh kosong"; 
		
			if(empty($error))
			{
				if(empty($id))
				{
					$cekkategori = $this->kategori_model->get_by("id_kategori",$post['id_kategori']);
					if(!empty($cekkategori))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->kategori_model->get_by("nama",$post['nama']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar"; 
				}
				else
				{
					$cek = $this->kategori_model->cekName($id,$post['nama']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->kategori_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("kategori/manage/".$id);
				else
					redirect("kategori");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("kategori/manage/".$id);
			}
		}
		else
		  redirect("kategori");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->kategori_model->get_by("id_kategori",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("kategori");
			}
			else
			{
				$cek = $this->kategori_model->cekAvalaible($id);
				if(!empty($cek))
				{
					$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
					redirect("kategori");
				}
				else
				{
					$this->kategori_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("kategori");
				}
			}
		}
		else
			redirect("kategori");
	}
	
	public function generate_code()
	{
		$prefix = "KTG";
		$code = "01";
		
		$last = $this->kategori_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_kategori,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
