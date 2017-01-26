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
            $this->loadAdminTemplate("index",$data);
        }
	}

	public function process_login()
    {
        $res = array();
        if( $this->input->is_ajax_request() )
        {
            $this->load->helper("security");
            $this->form_validation->set_rules("login_username", "Correo Electrónico", "required|valid_email|trim|xss_clean");
            $this->form_validation->set_rules("login_password", "Contraseña", "required|trim|xss_clean");
            $this->form_validation->set_message("valid_email", "El campo %s debe de ser valido.");
            $this->form_validation->set_message("required", "El campo %s es requerido.");
            $this->form_validation->set_error_delimiters('','');
            if($this->form_validation->run() === FALSE)
            {
				$data = array(
                    "username" => form_error("login_username"),
                    "password" => form_error("login_password"),
                    "res"           => "error"
                );
            }
            else
            {
                $this->auth_model->setUsername($this->input->post("login_username",TRUE));
                $this->auth_model->setPassword($this->input->post("login_password",TRUE));

                if( $this->auth_model->login() === TRUE )
                {
                    $data = array(
                        "redirect" => base_url('admin/panel'),
                        "res" => "success",
                    );
                    $username = $this->session->userdata('username');
                    $this->session->set_flashdata("admin_logged", $username);
                }
                else
                {
                    $data = array(
                        "message" => "Usuario o Contraseña incorrecta.",
                        "res" => "login_error",
                    );
                }
            }
            echo json_encode($data);
        }
        else
        {
        show_404();
        }   
    }
}