<?php
	require APPPATH.'/libraries/REST_Controller.php';
	class Mobile extends REST_Controller
	{		
		public function authenticate()
		{
		   	$this->load->model('kurir_model');
			$get = $this->input->get("auth");
			if($get)
			{
				$dec = explode("|",base64_decode($get));
				
				$userid = $dec[0];
				$password = $dec[1];
				$user = $this->kurir_model->authenticate($userid,md5($password));
				
				if($user)
				{
					echo $this->respon($user);
				}
				else
					echo $this->respon("invalid username or password");
				
			}
			else
				echo $this->respon("method not allowed",false);
		}
		
		public function gettransaksi()
		{
		    $this->load->model("pemesanan_model");
			
			$filter = new StdClass();
			$filter->id_sales = trim($this->input->get('data'));
			
			$orderBy = "id_pesanan";
			$orderType = "desc";
			$page = $this->input->get('page');
			
			$limit = 0;
			if(!$page)
				$page = 1;
			
			$offset = ($page-1) * $limit;
			list($data['data'],$total) = $this->pemesanan_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
			
			echo $this->respon($data['data']);
		}
		
		
		public function change()
		{
		   	$this->load->model('sales_model');
			$get = $this->input->get("data");
			if($get)
			{
				$dec = explode("|",$this->decrypt($get));
				
				$id = $dec['0'];
				$dt['password'] = md5($dec['2']);
				$cek = $this->sales_model->cekPassword($id,md5($dec['1']));
				
				if(empty($cek))
				{
					echo $this->respon("password lama salah");
					exit;
				}
				else
				{
					$this->sales_model->save($id,$dt,false);	
				}
				echo $this->respon("success");	
				
			}
			else
				echo $this->respon("method not allowed",false);
		}
		
	}