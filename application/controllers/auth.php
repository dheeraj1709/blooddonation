<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	// Views Signup View File
	public function index()
	{
		$data['groups'] = $this->getBloodGroups();
		$this->load->view('viewfiles/signup',$data);
	}
	// Views Login View File
	public function login()
	{
		$this->load->view('viewfiles/login');
	}
	// Checks if username exists or not
	public function check(){
		$postData = $this->input->post();
		if($postData != null){
			$data = [];
			$data['usertype'] = $postData['usertype'];
			$data['text'] = $postData['text'];
			$url = BASE_API_URL.'Auth/check';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($responseCode == 200) {
				echo $output;
				curl_close($ch);
			}
		}
	}
	// Signup user
	public function userSignup(){
		$postData = $this->input->post();
		if($postData != null){
			$data = [];
			$data['usertype'] = $postData['usertype'];
			$data['name'] = $postData['name'];
			$data['username'] = $postData['username'];
			$data['password'] = $postData['password'];
			$data['logo'] = $_FILES['logo']['tmp_name'];
			$data['bloodGroup'] = isset($postData['bloodGroup']) ? $postData['bloodGroup'] : null;
			$url = BASE_API_URL.'Auth/userSignup';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($responseCode == 200) {
				$this->session->set_flashdata('Message',json_decode($output)->Message);
				redirect('auth/login');
				curl_close($ch);
			}
		}
	}
	// User Login
	public function userLogin(){
		$postData = $this->input->post();
		if($postData != null){
			$data['username'] = $postData['username'];
			$data['password'] = $postData['password'];
			$data['userType'] = $postData['userType'];
			$url = BASE_API_URL.'Auth/userLogin';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($responseCode == 200) {
				curl_close($ch);
				$output = json_decode($output);
				if(($output->Status == 'SUCCESS') && ($output->Message == 'GRANTED')){
					$userData = array(
						'username' => $data['username'],
						'userType' => $data['userType']
					);
					$this->session->set_userdata($userData);
					redirect('dashboard');
				}else{
					echo $output->Message;
				}
			}else{
				redirect('auth/login');
			}
		}
	}
	// Logout 
	public function logout(){
		if($this->session->has_userdata('username')){
			$this->load->helper('url');
			$this->session->sess_destroy();
			$data['Message'] = "Successfully logged out";
			$data['Status'] = "SUCCESS";
		}else{
			$data['Message'] = "Need not logout twice :)";
			$data['Status'] = "FAILED";
		}
		http_response_code(200);
		echo json_encode($data);
	}
	// Get all blood groups
	public function getBloodGroups(){
		$url = BASE_API_URL.'Auth/GetBloodGroups';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($responseCode == 200) {
			return $output;
			curl_close($ch);
		}
	}
}
