<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	public function userNameAvailability($usertype,$text){
        $this->load->database();
        $usertype.='s';
        $query = $this->db->query("SELECT * from $usertype where username = '$text'");
        return $query->row();
    }
    public function loginUser($usertype,$username,$password){
        $this->load->database();
        $usertype .= 's';
        $condition = "username = '$username' and password = '$password'";
        $query = $this->db->query("SELECT * from $usertype where $condition");
        return $query->row();
    }

    public function getAllBloodGroups(){
        $this->load->database();
        $query = $this->db->query("SELECT * from bloodgroups");
        return $query->result();
    }

}
