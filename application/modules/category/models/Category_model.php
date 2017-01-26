<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_model extends CI_Model
{
	public function get_categories_list()
	{
		$this->db->select('id, name, active');
        $this->db->from('categories');
        $query = $this->db->get(); 

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
	}
	
	public function add_category($data)
	{
		$insert = $this->db->insert("categories",$data);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;    
        }
	}
	
    public function get_category($id)
    {
        $this->db->select('id,name,active');
        $this->db->from('categories');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return FALSE;
    }

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
	public function update_category($id,$data)
	{
		return $this->db->where('id',$id)->update("categories",$data);
	}
}