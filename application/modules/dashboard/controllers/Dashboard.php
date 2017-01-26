<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array("form_validation","session"));
    }
    
    public function index()
    {
        if( $this->session->userdata("login","administrador") )
        {
            $data['title'] = 'Panel |  ';
            $data['active_class'] = TRUE;
            //$data['username'] = $this->session->flashdata("logged");
            $this->loadAdminTemplate('dashboard',$data);
        }
        else
        {
            redirect(base_url("admin"), "refresh");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("admin"), "refresh");
    }
}