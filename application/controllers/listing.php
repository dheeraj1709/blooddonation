<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller {
	
	public function index()
	{
		$this->load->view('viewfiles/listing');
    }
    
}
