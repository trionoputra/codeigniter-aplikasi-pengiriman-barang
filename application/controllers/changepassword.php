<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Changepassword extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("user_model");
    }
	
	public function index()
	{
		$data['title'] = "Change Password";
		$data['layout'] = "changepassword/index";
		
		
		$data['data'] = new StdClass();
		
		$user =  $this->user_model->get_by("id_user",$this->session->userdata('isLogin1'),true);
		$data['data']->username = $user->username;
		
		$this->load->view('template',$data);
	}
	
	public function save()
	{
		$data = array();
		$post = $this->input->post();
		
		if($post)
		{
			$error = array();
			$id = $this->session->userdata('isLogin1');
			
			if(!empty($post['username']))
				$data['username'] = $post['username'];
			else
				$error[] = "username tidak boleh kosong";
			
			if(!empty($post['passwordold']) || !empty($post['password']))
			{
				if(empty($post['passwordold']))
						$error[] = "password lama tidak boleh kosong";
			
				if(!empty($post['password']))
					$data['password'] = md5($post['password']);
				else
					$error[] = "password baru tidak boleh kosong"; 
			}
			
			if(empty($error) && (!empty($post['passwordold']) || !empty($post['password'])))
			{
				$user =  $this->user_model->get_by("id_user",$id,true);
				if($user->password != md5($post['passwordold']))
					$error[] = "password lama tidak benar";
			}
			
			if(empty($error))
			{
				$cek = $this->user_model->cekName($id,$post['username']);
					if(!empty($cek))
						$error[] = "username sudah terdaftar";
			}
		
			if(empty($error))
			{
				
				$save = $this->user_model->save($id,$data,false);
				$this->session->set_userdata('username',$data['username']);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				redirect("changepassword");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("changepassword");
			}
		}
		else
		  redirect("changepassword");
	}
}
