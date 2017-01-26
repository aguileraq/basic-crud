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
            $data['title'] = 'Dashboard |  ';
            //$data['username'] = $this->session->userdata('username');
            $data['username'] = $this->session->flashdata("logged");
            echo $this->blade->view()->make('dashboard')->with($data)->render();
        }
        else
        {
            redirect(base_url("administrator"), "refresh");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("administrator"), "refresh");
    }
}