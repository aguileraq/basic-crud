<?php
	class MY_Controller extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
		}

		public function loadAdminTemplate($view,$data=array())
		{
			$this->load->view("admin/header",$data);
			$this->load->view($view,$data);
			$this->load->view("admin/footer");
		}
		
		public function loadPublicTemplate($view,$data=array())
		{
			$this->load->view("public/header",$data);
			$this->load->view($view,$data);
			$this->load->view("public/footer");
		}
	}