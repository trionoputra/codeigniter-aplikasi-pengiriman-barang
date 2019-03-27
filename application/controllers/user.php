<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("user_model");
		$this->cekLoginStatus("admin",true);
    }
	
	public function index()
	{
		$data['title'] = "DATA USER";
		$data['layout'] = "user/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->user_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("user?");
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
		$data['title'] = "FORM USER";
		$data['layout'] = "user/manage";

		$data['data'] = new StdClass();
		$data['data']->id_user = "";
		$data['data']->username = "";
		$data['data']->level = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->user_model->get_by("id_user",$id,true);
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
			
			if(!empty($post['id_user']))
				$data['id_user'] = $post['id_user'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['username']))
				$data['username'] = $post['username'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
			if(!empty($post['level']))
				$data['level'] = $post['level'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
			if(!empty($post['password']))
			  $data['password'] = md5($post['password']);
			else
			{
				if(empty($id))
					$error[] = "password tidak boleh kosong";
			}
			
			if(empty($error))
			{
				
				if(empty($id))
				{
					$cek = $this->user_model->get_by("id_user",$post['id_user']);
					if(!empty($cek))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->user_model->get_by("username",$post['username']);
					if(!empty($cek))
						$error[] = "username sudah terdaftar"; 
				}
				else
				{
					$cek = $this->user_model->cekName($id,$post['username']);
					if(!empty($cek))
						$error[] = "username sudah terdaftar";
				}
			}
			
			if(empty($error))
			{
				$save = $this->user_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("user/manage/".$id);
				else
					redirect("user");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("user/manage/".$id);
			}
		}
		else
		  redirect("user");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->user_model->get_by("id_user",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("user");
			}
			else
			{
				if($this->session->userdata('isLogin1') == $id)
				{
					$this->session->set_flashdata('admin_save_error', "user sedang digunakan");
					redirect("user");
				}
				else
				{
					$this->user_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("user");
				}
			}
		}
		else
			redirect("user");
	}
	
	public function generate_code()
	{
		$prefix = "USR";
		$code = "01";
		
		$last = $this->user_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_user,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		
		return $prefix.$code;
	}
	
	
}
