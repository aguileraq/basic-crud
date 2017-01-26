<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_Model
{

	private $username;
    private $password;

    public function setUsername( $email )
    {
        $this->username = $email;
    }
    
    public function setPassword( $password )
    {
        $this->password = $password;
    }

	public function login()
    {
        $query = $this->db->select("users.id, users.email, users.password, users.active, .users_groups.group_id")
                ->from("users")
                ->join("users_groups","users_groups.user_id = users.id")
                ->where("users.email", $this->username)
                ->where("users.active",1)
                ->where("users_groups.group_id",1)
                ->get();
        if( $query->num_rows() === 1 )
        {
            $user = $query->row();
            if( $user->password == sha1($this->password) )
            {
                $this->session->set_userdata(
                    array(
                        "id"            =>      $user->id,
                        "username"      =>      $user->email,
                        "login"         =>      "administrador"
                    )
                );
                //var_dump($this->session);
                return TRUE;
            }
            return FALSE;
        }
        else
        {
            return FALSE;
        }
    }

}