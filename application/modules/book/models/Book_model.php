<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Book_model extends CI_Model
{
	public function get_active_categories()
	{
		$this->db->select('id, name, active');
        $this->db->from('categories');
        $this->db->where('active',1);
        $query = $this->db->get(); 

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
	}
	
	public function add_book($data)
	{
		$insert = $this->db->insert("books",$data);
        if($insert)
        {
            #
            return true;
        }
        else
        {
            return false;    
        }
	}
	
    public function add_author_book($data)
    {
        $insert = $this->db->insert_batch('author_book',$data);
        if($insert)
        {
            return true;
        }
        else
        {
            return false;    
        }
    }

    public function get_book($id)
    {
        $this->db->select('id,title,picture,isbn,editorial,publish_date,qty,active,category_id');
        $this->db->from('books');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function get_authorbook_id($id)
    {
        $this->db->select('id_author');
        $this->db->from('author_book');
        $this->db->where('id_book',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function get_author_book($id)
    {
        $this->db->select('author_book.id_author AS id,authors.name AS name');
        $this->db->from('author_book');
        $this->db->join('authors', 'authors.id = author_book.id_author');
        $this->db->where('author_book.id_book',$id);
        //$this->db->order_by('author_book.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_imagebook($id)
    {
        /*$query = $this->db->query("SELECT picture FROM books WHERE id = $id");
        $row = $query->row();*/
        $this->db->select("picture");
        $this->db->where("id", $id);
        $query = $this->db->get("books",1,0);

        if($query->num_rows() > 0)
        {
            $variable = $query->row("picture");
            return $variable;    
        }
        else 
        {
            return FALSE;
        }

    }

	public function update_book($id,$data)
	{
		
        return $this->db->where('id',$id)->update("books",$data);

	}

    public function update_author_book($id,$new_data)
    {
        $this->db->trans_start();
            $this->db->query("DELETE FROM author_book WHERE id_book = '".$id."'");
            foreach($new_data as $key)
            {
                $this->db->query(" INSERT INTO author_book (id_book,id_author) VALUES ('".$key['id_book']."','".$key['id_author']."') ");
            }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
               return $this->db->error();
        }
        else
        {
            return true;
        }

    }
}