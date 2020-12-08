<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index()
	{
		$data = [];
		if($this->session->userdata('userType') == "hospital"){
			$data['groups'] = $this->GetAvailabilityByHospital();
		}
		if($this->session->userdata('userType') == "receiver"){
			$data['groups'] = $this->GetAvailabilityByType();
		}
		$this->load->view('viewfiles/home',$data);
    }
	
	public function GetAvailabilityByType(){
		$username = $this->session->userdata('username');
		$url = BASE_API_URL."dashboard/GetAvailabilityByType/$username";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($responseCode == 200) {
			return $output;
			curl_close($ch);
		}
	}

	public function GetAvailabilityByHospital(){
		$username = $this->session->userdata('username');
		$url = BASE_API_URL."dashboard/AvailableBloodGroups/$username";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($responseCode == 200) {
			return $output;
			curl_close($ch);
		}
	}

	public function GetAvailabilityByHospitalECHO(){
		$username = $this->session->userdata('username');
		$url = BASE_API_URL."dashboard/AvailableBloodGroups/$username";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($responseCode == 200) {
			echo $output;
			curl_close($ch);
		}
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

	// GET Requirement
	public function GetRequirement(){
		$usertype = $this->session->userdata('userType');
		$username = $this->session->userdata('username');
		$url = BASE_API_URL."dashboard/GetRequirements/$usertype/$username";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($responseCode == 200) {
			return $output;
			curl_close($ch);
		}
	}

	public function GetRequirementECHO(){
		$usertype = $this->session->userdata('userType');
		$username = $this->session->userdata('username');
		$url = BASE_API_URL."dashboard/GetRequirements/$usertype/$username";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		print_r($output);
		if($responseCode == 200) {
			echo $output;
			curl_close($ch);
		}
	}
}
