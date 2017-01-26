<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends MY_Controller
{

	public $autoload = array(
        "libraries"     =>  array("form_validation","session","upload"),
        "helper"        =>  array("security","date")
    );

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Book_model", "book_model");
		$this->load->model('Bookdata_model','bookdata_model');
        $this->load->model('author/author_model');
        $this->load->model('category/category_model');
        $this->load->model("category/Categorydata_model", "categorydata_model");
        $this->form_validation->CI = & $this;
	}
    
	public function date_time()
	{
		date_default_timezone_set('America/Mexico_City');
		$date = date('Y-m-d H:i:s');
		return $date;
	}

	public function get_author_list()
    {
        if ( isset($_GET['q']) ) :
            $name = strtolower($_GET['q']);
            $output = $this->author_model->get_active_authors_ajax($name);
            echo json_encode($output);
        endif;
    }

    public function check_upload()
    {
        if(!empty($_FILES['book_picture']['tmp_name']))
        {
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['remove_spaces'] = true;
            $config['max_size']  = '2000';
            $temp = explode(".",$_FILES['book_picture']['name']);
            $name = 'cover_'.time().'.'.end($temp);
            $config['file_name'] = $name;

            $this->upload->initialize($config);
            
            $uploadData = $this->upload->data();
            $picture = $uploadData['file_name'];

            if( $this->upload->do_upload('book_picture') === FALSE )
            {
                $this->form_validation->set_message('check_upload',$this->upload->display_errors('',''));
                return false;
            }
            else
            {
                //unlink("uploads/images/".$picture);
                return true;
            }
          
        }
        elseif ($this->input->post('saved_picture') )
        {
                return true;
        }
        else
        {
            $this->form_validation->set_message('check_upload',"El campo Portada es requerido");
            return false;
        }
    }

    public function do_upload()
    {
        $check_result = $this->check_upload();
        if($check_result)
        {
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['remove_spaces'] = true;
            $config['max_size']  = '2000';
            $temp = explode(".",$_FILES['book_picture']['name']);
            $name = 'cover_'.time().'.'.end($temp);
            $config['file_name'] = $name;

            $this->upload->initialize($config);
            if($this->upload->do_upload('book_picture'))
            {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
                return $picture;
            }
        }
    }

    public function index()
    {
        if( $this->session->userdata("login","administrador") )
        {
            $data['title'] = 'Control Acervo | Libros';
			//$data['categories'] = $this->book_model->get_categories_list();
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
            $data['title'] = 'Libreria |  Agregar Libro';
            $data['categories'] = $this->book_model->get_active_categories();
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
                    "Categoría",
                    "required|trim"
                );
                $this->form_validation->set_rules(
                    "book_title",
                    "Titulo",
                    "required|trim|min_length[4]"
                );
                $this->form_validation->set_rules(
                    "book_picture",
                    "Portada",
                    "callback_check_upload"
                );
                $this->form_validation->set_rules(
                    "book_editorial",
                    "Editorial",
                    "required|trim|min_length[5]"
                );
                $this->form_validation->set_rules(
                    "author_ids",
                    "Autor",
                    "required|trim"
                );
                $this->form_validation->set_rules(
                    "book_isbn",
                    "ISBN",
                    "required|trim|min_length[5]"
                );
                $this->form_validation->is_unique('book_isbn', 'books.isbn');
                $this->form_validation->set_rules(
                    "book_publishdate",
                    "Fecha de Publicación",
                    "required|trim"
                );
                $this->form_validation->set_rules(
                    "book_qty",
                    "Número de Ejemplares",
                    "required|trim|numeric"
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
                $this->form_validation->set_message('is_unique', 'El %s ya existe');
                $this->form_validation->set_error_delimiters('','');
                if( $this->form_validation->run() === FALSE )
                {
                    $data = array(
                        "response" => array(
                            "category_name" => form_error("category_name"),
                            "book_title" => form_error("book_title"),
                            "book_picture" => form_error("book_picture"),
                            "book_editorial" => form_error("book_editorial"),
                            "author_ids" => form_error("author_ids"),
                            "book_isbn" => form_error("book_isbn"),
                            "book_publishdate" => form_error("book_publishdate"),
                            "book_qty" => form_error("book_qty")
                        ),
                        "res"           => "error"
                    );
                }
                else
                {
                    $book_data = array(
                        "title"    => $this->input->post("book_title"),
                        "picture"    => $this->do_upload(),
                        "isbn"    => $this->input->post("book_isbn"),
                        "editorial"    => $this->input->post("book_editorial"),
                        "publish_date"    => $this->input->post("book_publishdate"),
                        "qty"    => $this->input->post("book_qty"),
    	            	"active"	=> $this->input->post("book_status"),
    					"created_at" => $this->date_time(),
                        "category_id"   => $this->input->post('category_name')
                	);

                    $insertbook = $this->book_model->add_book($book_data);
                    $last_id = $this->db->insert_id();
                    $ids = $this->input->post('author_ids');
                    $author_ids = explode(',',$ids);
                    $author_data = array();
                    foreach($author_ids as $i):
                        $author_data[]=array('id_book' => $last_id, 'id_author' => $i);
                    endforeach;
                	$insertauthor_book = $this->book_model->add_author_book($author_data);

                    if($insertbook && $insertauthor_book)
                    {                        
                        $data = array(
                            "redirect" => base_url('admin/libros'),
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
                redirect(base_url("admin/libros/"), "refresh");
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
	
    public function ajax_add_author()
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

                $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
                    
                if ($this->form_validation->run() == FALSE) 
                {
                        $status = 'error';
                        $res['sts'] = false;
                        $res['msg'] = validation_errors();
                }
                else 
                {
                    $author_data = array(
                        "name"    => ucwords(strtolower($this->input->post("author_name"))),
                        "active"    => $this->input->post("author_status"),
                        "created_at" => $this->date_time()
                    );

                    $insertauthor = $this->author_model->add_author($author_data);

                    if($insertauthor)
                    {
                        $status = 'sucess';
                        $res['sts'] = true;
                        $res['msg'] = 'Dato Guardado.';
                    }
                }
            }
            else
            {
                $res['sts'] = false;
                $res['msg'] = 'x error';
            }
            echo json_encode($res);
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
            $data['categories'] = $this->category_model->get_active_categories();
            $data['book'] = $this->book_model->get_book($id);
            $data['author'] = $this->book_model->get_authorbook_id($id);
            $data['arr_author'] = $this->book_model->get_author_book($id);
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
                    "Categoría",
                    "required|trim"
                );
                $this->form_validation->set_rules(
                    "book_title",
                    "Titulo",
                    "required|trim|min_length[6]"
                );
                $this->form_validation->set_rules(
                    "book_editorial",
                    "Editorial",
                    "required|trim|min_length[5]"
                );
                $this->form_validation->set_rules(
                    "author_ids",
                    "Autor",
                    "required|trim"
                );
                $this->form_validation->set_rules(
                    "book_isbn",
                    "ISBN",
                    "required|trim|min_length[5]"
                );
                $this->form_validation->is_unique('book_isbn', 'books.isbn');
                $this->form_validation->set_rules(
                    "book_publishdate",
                    "Fecha de Publicación",
                    "required|trim"
                );
                $this->form_validation->set_rules(
                    "book_qty",
                    "Número de Ejemplares",
                    "required|trim|numeric"
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
                        "response" => array(
                            "category_name" => form_error("category_name"),
                            "book_title" => form_error("book_title"),
                            "book_editorial" => form_error("book_editorial"),
                            "author_ids" => form_error("author_ids"),
                            "book_isbn" => form_error("book_isbn"),
                            "book_publishdate" => form_error("book_publishdate"),
                            "book_qty" => form_error("book_qty")
                        ),
                        "res" => "error"
                    );
                }
                else
                {
                    $id = $this->uri->segment(4);
                    
                    if(!isset($_FILES['book_picture']) || $_FILES['book_picture']['error'] == UPLOAD_ERR_NO_FILE) 
                    {
                        $picture = $this->book_model->get_imagebook($id);
                    } 
                    else
                    {
                        $temp = explode(".",$_FILES['book_picture']['name']);
                        $name = 'cover_'.time().'.'.end($temp);
                        /* Start Uploading File */
                        $config = [
                            'upload_path' =>'./uploads/images/',
                            'allowed_types' => 'jpg|jpeg|png|gif',
                            'remove_spaces' => true,
                            'max_size'  => '2000',
                            'file_name' => $name
                        ];
                        $this->upload->initialize($config);
                        if ( ! $this->upload->do_upload('book_picture') )
                        {
                            $error = $this->upload->display_errors('','');
                            $data = array(
                                "response" => array(
                                    "book_picture" => $error,
                                ),
                                "res" => "error"
                            );
                        }
                        else
                        {
                            $file = $this->upload->data();
                            $picture = $file['file_name'];
                        }
                    }
                       
                    $book_data = array(
                        "title"    => $this->input->post("book_title"),
                        "picture" => $picture,
                        "isbn"    => $this->input->post("book_isbn"),
                        "editorial"    => $this->input->post("book_editorial"),
                        "publish_date"    => $this->input->post("book_publishdate"),
                        "qty"    => $this->input->post("book_qty"),
                        "active"    => $this->input->post("book_status"),
                        "updated_at" => $this->date_time(),
                        "category_id"    => $this->input->post("category_name")
                    );
                    $updatebook = $this->book_model->update_book($id,$book_data);

                    $ids = $this->input->post('author_ids');
                    $author_ids = explode(',',$ids);
                            
                    $new_data = array();
                    foreach($author_ids as $i):
                        $new_data[]= array(
                            'id_book' => $id, 
                            'id_author' => $i,
                            );
                    endforeach;
                    $updateauthor_book = $this->book_model->update_author_book($id,$new_data);
                                
                    if($updatebook && $updateauthor_book)
                    {
                        $data = array(
                            "redirect" => base_url('admin/libros'),
                            "message" => "Registro Actualizado",//$picture,
                            "res" => "success"
                        );
                    }
                    else
                    {
                        $data = array(
                            "message" => 'No se logro realizar el proceso.',
                            "res" => "create_error",
                        );
                    }
                        //}
                }
                
                echo json_encode($data);
            }
            elseif( $this->input->post('edit_cancel') )
            {
                redirect(base_url("admin/libros/"), "refresh");
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
            $list = $this->bookdata_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $book) {
                $no++;
                $row = array();
    			$row[] = $no;
                $table_name = "books";//name of the table in db.
                $row[] = $book->title;
                $row[] = $book->isbn;
                $row[] = '<img src="'.base_url().'uploads/images/'.$book->picture.'" width="60" class="center-block"/>';
                $row[] = $book->qty;
                $row[] = ($book->active) ? '<span class="label label-success">Activado</span>':'<span class="label label-danger">Desactivado</span>';
     
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url().'admin/libros/editar/'.$book->id.'" title="Editar" ><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                      <a class="show_del btn btn-sm btn-danger" href="#" data-id="'.$book->id.'" data-table="'.$table_name.'" title="Eliminar Categoría" data-toggle="modal" data-target="#deleteModal"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
     
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->bookdata_model->count_all(),
                            "recordsFiltered" => $this->bookdata_model->count_filtered(),
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

	
	public function ajax_delete($id)
    {
        if( $this->session->userdata("login","administrador") )
        {
            $this->bookdata_model->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        }
        else
        {
            redirect(base_url("admin"), "refresh"); 
        }
    }
}