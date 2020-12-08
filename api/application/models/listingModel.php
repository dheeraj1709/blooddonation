<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListingModel extends CI_Model {

	public function userNameAvailability($usertype,$text){
        $this->load->database();
        $usertype.='s';
        $query = $this->db->query("SELECT * from $usertype where username = '$text'");
        return $query->row();
    }
}
