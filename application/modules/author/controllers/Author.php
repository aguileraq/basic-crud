<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends MY_Controller
{

	public $autoload = array(
        "libraries"     =>  array("form_validation","session"),
        "helper"        =>  array("form","url","security","date")
    );

	public function __construct()
	{
		parent::__construct();
        $this->load->model("category/Categorydata_model", "categorydata_model");
		$this->load->model("Author_model", "author_model");
		$this->load->model('Authordata_model','authordata_model');
	}
    
	public function date_time()
	{
		date_default_timezone_set('America/Mexico_City');
		$date = date('Y-m-d H:i:s');
		return $date;
	}
	
    public function index()
    {
        if( $this->session->userdata("login","administrador") )
        {
            $data['title'] = 'Control Acervo | Autores';
            $data['username'] = $this->session->flashdata("logged");
            $this->loadAdminTemplate('index',$data);
        }
        else
        {
            redirect(base_url("admin"), "refresh");
        }
    }
	
	public function add()
	{
		if( $this->session->userdata("login","administrador") )
        {
            $data['username'] = $this->session->flashdata("logged");
            $data['title'] = 'Control Acervo |  Agregar Autor';
            $data['authors'] = $this->author_model->get_active_authors();
            $this->loadAdminTemplate("add",$data);
        }
        else
        {
            redirect(base_url("admin"), "refresh");
        }

	}
	
	public function add_process()
    {
        if( $this->session->userdata("login","administrador") )
        {
            $data['username'] = $this->session->flashdata("logged");
            $res = array();
            if( $this->input->is_ajax_request() )
            {
                $this->form_validation->set_rules(
                    "author_name",
                    "Nombre de Autor",
                    "required|trim|min_length[6]"
                );
                    
                $this->form_validation->set_message(
                    "required", "El campo %s es requerido"
                );
                    
                $this->form_validation->set_message(
                    "min_length", "El campo %s debe tener al menos %s carácteres"
                    );
                $this->form_validation->set_message(
                    "max_length", "El campo %s no puede tener más de %s carácteres");
                $this->form_validation->set_error_delimiters('','');
                if( $this->form_validation->run() === FALSE )
                {
                    $data = array(
                        "author_name" => form_error("author_name"),
                        "res"           => "error"
                    );
                }
                else
                {
                    $author_data = array(
                        "name"    => ucwords(strtolower($this->input->post("author_name"))),
        	            "active"	=> $this->input->post("author_status"),
        				"created_at" => $this->date_time()
                    );
                	$insertauthor = $this->author_model->add_author($author_data);
                    
                    if($insertauthor)
                    {
                        $data = array(
                            "redirect" => base_url('admin/autores'),
                            "message" => "Registro realizado.",
                            "res" => "success"
                        );
                    }
                    else
                    {
                        $data = array(
                            "message" => "No fue posible realizar el registro.",
                            "res" => "create_error",
                        );
                    }
                }
                echo json_encode($data);
            }
    		elseif( $this->input->post('add_cancel') )
    		{
    			redirect(base_url("admin/autores/"), "refresh");
    		}
            else
            {
                show_404();
            }
        }
        else
        {
            redirect(base_url("admin"), "refresh");  
        }
    }
	
	public function edit()
	{
    	if( $this->session->userdata("login","administrador") )
        {
            $data['username'] = $this->session->flashdata("logged");
        	$data['title'] = 'Libreria |  Editar Categoría';
    		$id = $this->uri->segment(4);
            $data['author'] = $this->author_model->get_author($id);
    		$this->loadAdminTemplate("edit",$data);
        }
        else
        {
            redirect(base_url("admin"), "refresh");  
        }
	}
	
	public function edit_process()
	{
        if( $this->session->userdata("login","administrador") )
        {
            $data['username'] = $this->session->flashdata("logged");
            $res = array();
            if( $this->input->is_ajax_request() )
            {
                $this->form_validation->set_rules(
                    "author_name",
                    "Nombre",
                    "required|trim|min_length[5]"
                );  
                
                $this->form_validation->set_message(
                    "required", "El campo %s es requerido"
                );
                
                $this->form_validation->set_message(
                    "min_length", "El campo %s debe tener al menos %s carácteres"
                );

                $this->form_validation->set_message(
                    "max_length", "El campo %s no puede tener más de %s carácteres"
                );
                $this->form_validation->set_error_delimiters('','');
                if( $this->form_validation->run() === FALSE )
                {
                    $data = array(
                    "author_name" => form_error("author_name"),
                    "res"           => "error"
                    );
                }
                else
                {
    				$id = $this->uri->segment(4);
                    $author_data = array(
    	                "name"	=> ucwords(strtolower($this->input->post('author_name'))),
    	            	"active"	=> $this->input->post("author_status"),
    					"updated_at" => $this->date_time()
                	);
                	$updateauthor = $this->author_model->update_author($id,$author_data);

                    if($updateauthor)
                    {
                        $data = array(
                            "message" => "Registro actualizado.",
                            "redirect" => base_url("admin/autores/"),
                            "res" => "success"
                        );
                    }
                    else
                    {
                        $data = array(
                            "message" => "No fue posible editar el registro..",
                            "res" => "update_error"
                        );
                    }
                }
                echo json_encode($data);
            }
            elseif( $this->input->post('edit_cancel') )
            {
                redirect(base_url("admin/autores/"), "refresh");
            }
            else
            {
                show_404();
            }
        }
        else
        {
            redirect(base_url("admin"), "refresh");  
        }
	}
	
	public function ajax_list()
    {
        if( $this->session->userdata("login","administrador") )
        {    
            $list = $this->authordata_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $author) {
                $no++;
                $table_name = "authors";//name of the table in db.
                $row = array();
    			$row[] = $no;
                $row[] = $author->name;
                $row[] = ($author->active) ? '<span class="label label-success">Activado</span>':'<span class="label label-danger">Desactivado</span>';
     
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url().'admin/autores/editar/'.$author->id.'" title="Editar" ><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                      <a class="show_del btn btn-sm btn-danger" href="#" data-id="'.$author->id.'" data-table="'.$table_name.'" title="Eliminar Categoría" data-toggle="modal" data-target="#deleteModal"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
     
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->authordata_model->count_all(),
                            "recordsFiltered" => $this->authordata_model->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
        else
        {
            redirect(base_url("admin"), "refresh");  
        }
    }
}