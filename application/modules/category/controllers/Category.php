<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{

	public $autoload = array(
        "libraries"     =>  array("form_validation","session"),
        "helper"        =>  array("form","url","security","date")
    );

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Category_model", "category_model");
		$this->load->model('Categorydata_model','categorydata_model');
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
            $data['title'] = 'Control Acervo | Categorías';
			$data['categories'] = $this->category_model->get_categories_list();
			//$data['username'] = $this->session->userdata('username');
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
            $data['title'] = 'Control Acervo |  Agregar Categoría';
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
                    "category_name",
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
                    "category_name" => form_error("category_name"),
                    "res"           => "error"
                    );
                }
                else
                {
                    $category_data = array(
    	                "name"	=> $this->input->post('category_name'),
    	            	"active"	=> $this->input->post("category_status"),
    					"created_at" => $this->date_time()
                	);
                	$insertcategory = $this->category_model->add_category($category_data);

                    if($insertcategory)
                    {
                        $data = array(
                            "redirect" => base_url('admin/categorias'),
                            "message" => "Registro realizado.",
                            "res" => "success",
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
            elseif ( $this->input->post('add_cancel') )
            {  
                redirect(base_url("admin/categorias/"),"refresh");
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
            $data['category'] = $this->category_model->get_category($id);
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
                    "category_name",
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
                    "category_name" => form_error("category_name"),
                    "res"           => "error"
                    );
                }
                else
                {
    				$id = $this->uri->segment(4);
                    $category_data = array(
    	                "name"	=> $this->input->post('category_name'),
    	            	"active"	=> $this->input->post("category_status"),
    					"updated_at" => $this->date_time()
                	);

                	$updatecategory = $this->category_model->update_category($id,$category_data);

                    if($updatecategory)
                    {
                        $data = array(
                            "message" => "Registro actualizado.",
                            "redirect" => base_url("admin/categorias/"),
                            "res" => "success",
                        );
                    }
                    else
                    {
                        $data = array(
                            "message" => "No fue posible editar el registro..",
                            "res" => "update_error",
                        );
                    }
            	}
            echo json_encode($data);
            }
            elseif( $this->input->post('edit_cancel') )
            {
                redirect(base_url("admin/categorias/"), "refresh");
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
            $list = $this->categorydata_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $category) {
                $no++;
                $table_name = "categories";//name of the table in db.
                $row = array();
    			$row[] = $no;
                $row[] = $category->name;
                $row[] = ($category->active) ? '<span class="label label-success">Activado</span>':'<span class="label label-danger">Desactivado</span>';
     
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url().'admin/categorias/editar/'.$category->id.'" title="Editar" ><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                      <a class="show_del btn btn-sm btn-danger" href="#" data-id="'.$category->id.'" data-table="'.$table_name.'" title="Eliminar Categoría" data-toggle="modal" data-target="#deleteModal"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
     
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->categorydata_model->count_all(),
                            "recordsFiltered" => $this->categorydata_model->count_filtered(),
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

	
	public function ajax_delete()
    {
        if( $this->session->userdata("login","administrador") )
        {
            $res = array();
            $data = array(
                    "message" => "",
                    "res" => FALSE,
            );

            $id = $this->input->post('id');
            $table = $this->input->post('table');
            $delete = $this->categorydata_model->delete_by_id($id,$table);
            if( $this->db->affected_rows() > 0 )
            {
                $data = array(
                        "message" => "",
                        "res" => TRUE,
                    );
            }
            echo json_encode($data);
        }
        else
        {
            redirect(base_url("admin"), "refresh"); 
        }
    }
}