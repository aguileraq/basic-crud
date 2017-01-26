<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array("form_validation","session"));
        $this->load->model("Auth_model", "auth_model");
	}

	public function index()
	{
		if( $this->session->userdata("login","administrador") )
        {
            redirect(base_url("admin/panel"), "refresh");
        }
        else
        {
            $data['title'] = 'Formulario de Acceso';
            $data['attributes'] = array('role' => 'form');
			echo $this->blade->view()->make('index')->with($data)->render();
        }
        $this->output->enable_profiler(TRUE);
	}

	public function process_login()
    {
        if( $this->input->post() )
        {
            $this->auth_model->setUsername($this->input->post("login_username"));
            $this->auth_model->setPassword($this->input->post("login_password"));

            if( $this->auth_model->login() === TRUE )
            {
                /*$this->session->set_flashdata(
                    array(
                        "id"        =>      $user->id,
                        "username"  =>      $user->username
                    )
                );
                var_dump($user);
                var_dump($this->session);*/
                $username  = $this->session->userdata('username');
                setFlash("admin_logged", $username);
                redirect(base_url("admin/panel"), "refresh");
            }
            else
            {
                setFlash("error_login", "Usuario o Contraseña incorrecta" );
                redirect(base_url("admin"), "refresh");
            }
        }
    }
}