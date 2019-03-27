<?php
class Admin_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->cekLogin();
    }
	
	private function cekLogin(){
        if(!$this->session->userdata('isLogin1')){
            redirect('login');
        }
    }
	
	public function cekLoginStatus($form = "admin",$isRedirect = false){
		$status = false; 
	
        if($this->getStatus() === false){
            $status =  false;
        }
		else
		{
			if($form == "admin" && $this->getStatus() == "1")
				$status =  true;
			else if ($form == "finance" && ( $this->getStatus() == "2" || $this->getStatus() == "1" ))
				$status =  true;
			else if ($form == "staff gudang" && ( $this->getStatus() == "3" || $this->getStatus() == "1" ) )
				$status =  true;
		}
		if($status)
		{
			return $status;
		}
		else
		{
			if($isRedirect)
			{
				redirect('dashboard');
			}
			else
				return $status;
		}	
    }
	
	public function getStatus()
	{
		return $this->session->userdata('loginstatus');
	}
	public function getLoginName()
	{
		return $this->session->userdata('username');
	}
	
	public function getLoginID()
	{
		return $this->session->userdata('isLogin1');
	}
}