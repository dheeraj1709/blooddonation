<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    // GET Available blood groups for a hospital
	public function AvailableBloodGroups($username)
	{
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->load->model('dashboardModel');
            $data = [];
            $data['bloodGroupsByHospital'] = $this->dashboardModel->AvailableBloodGroupsByHospital($username);
            if($data['bloodGroupsByHospital'] == null){
                $data['Message'] = "No Blood Groups Available for this Hospital";
            }
            else{
                $data['Message'] = "Blood Groups Available for this Hospital";
            }
             http_response_code(200);
            $data['Status'] = "SUCCESS";
            echo json_encode($data);
        }else{
            $data['Status'] = "FAILED"; 
            echo json_encode($data);
        }
    }
    // UPDATE Available blood groups for a hospital
    public function ChangeAvailableBloodGroups(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $data = [];
            $this->load->model('dashboardModel');
            $json = json_decode(file_get_contents("php://input"));
            if($json != null){
                $bloodgroups = $json->bloodgroups;
                $hospital = $json->hospital;
                $this->dashboardModel->ChangeAvailableBloodGroups($bloodgroups,$hospital);
                $data['Message'] = "Blood groups changed successfully";
                $data['Status'] = "SUCCESS";
                http_response_code(200);
            }else{
                $data['Message'] = "Invalid input data";
                $data['Status'] = "FAILED";
                http_response_code(200);
            }
            echo json_encode($data);
        }
    }
    // GET Hospitals with blood group 'OR' GET all data -> (NULL argument)
    public function GetHospitalsWithBloodGroup($group = null){
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->load->model('dashboardModel');
            $data = [];
            $data['HospitalsWithBloodGroup'] = $this->dashboardModel->GetHospitalsWithBloodGroup($group);
            if($data['HospitalsWithBloodGroup'] == null){
                $data['Message'] = "No Hospital Available for this Blood Group";
            }
            else{
                $data['Message'] = "Hospital Available for this Blood Group";
            }
            http_response_code(200);
            $data['Status'] = "SUCCESS";
            echo json_encode($data);
        }else{
            $data['Status'] = "FAILED"; 
            echo json_encode($data);
        }
    }
    // POST Add Blood Requirement
    public function AddRequirement(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $data = [];
            $this->load->model('dashboardModel');
            $json = json_decode(file_get_contents("php://input"));
            if($json != null){
                $username = $json->user;
                $hospitalname = $json->hospital;
                $bloodGroup = $json->group;
                $this->dashboardModel->AddRequirement($username,$hospitalname,$bloodGroup);
                 $data['Status'] = "SUCCESS";
                http_response_code(200);
            }else{
                $data['Message'] = "Invalid input data";
                $data['Status'] = "FAILED";
                http_response_code(200);
            }
            echo json_encode($data);
        }
    }
    // GET Blood requirement by hospital
    public function GetRequirements($usertype,$username){
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->load->model('dashboardModel');
            $data = [];
            $data['Requirements'] = $this->dashboardModel->GetRequirements($usertype,$username);
            if($data['Requirements'] == null){
                $data['Message'] = "No Requirements Found";
            }
            else{
                $data['Message'] = "Requirements Found";
            }
             http_response_code(200);
            $data['Status'] = "SUCCESS";
            echo json_encode($data);
        }else{
            $data['Status'] = "FAILED"; 
            echo json_encode($data);
        }
    }

    public function GetAvailabilityByType($username){
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->load->model('dashboardModel');
            $data = [];
            $type = $this->dashboardModel->GetUserBloodType($username);
            $data = $this->GetHospitalsWithBloodGroup($type->bloodgroup);
        }
    }

}
