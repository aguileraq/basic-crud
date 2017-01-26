<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Author_model extends CI_Model
{
	public function get_active_authors_ajax($name)
	{
		$this->db->select('id,name');
        $this->db->from('authors');
        $this->db->where('active',1);
        $this->db->like('name',$name);
        $query = $this->db->get(); 

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
	}

    public function get_active_authors()
    {
        $this->db->select('id,name');
        $this->db->from('authors');
        $this->db->where('active',1);
        $query = $this->db->get(); 

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

	public function add_author($data)
	{
		$insert = $this->db->insert("authors",$data);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;    
        }
	}
	
    public function get_author($id)
    {
        $this->db->select('id,name,active');
        $this->db->from('authors');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }
	
	public function update_author($id,$data)
	{
		return $this->db->where('id',$id)->update("authors",$data);


	}
}