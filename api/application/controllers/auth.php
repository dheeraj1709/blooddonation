<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function check()
	{
        $this->load->model('authModel');
        $json = json_decode(file_get_contents('php://input'));
        $usertype = isset($json->usertype) ? $json->usertype : null;
        $text = isset($json->text) ? $json->text : null;
        $availability = null;
        $data = [];
        if($usertype != null && $text != null){
            $availability = $this->authModel->userNameAvailability($usertype,$text);
            if($availability == null){
                $data['Message'] = 'Available';
            }else{
                $data['Message'] = 'UnAvailable';
            }
            $data['Status'] = 'SUCCESS';
            http_response_code(200);
        }else{
            $data['Status'] = 'FAILED';
            $data['Message'] = 'Invalid Data Passed';
            http_response_code(401);
        }
        echo json_encode($data);
    }
    
	public function userSignup()
	{
        $this->load->model('authModel');
        $json = json_decode(file_get_contents('php://input'));
        $usertype = isset($json->usertype) ? $json->usertype : null; 
        $name = isset($json->name) ? $json->name : null; 
        $username = isset($json->username) ? $json->username : null; 
        $password = isset($json->password) ? $json->password : null; 
        $logo = isset($json->logo) ? $json->logo : null; 
        $group = isset($json->bloodGroup) ? $json->bloodGroup : null;
        $data = [];
        if($name != null && $username != null && $password != null){
            $this->authModel->registerUser($usertype,$name,$username,$password,$logo,$group);
            if($usertype == 'hospital'){
                $this->insertBloodGroupData($username);
            }
            $data['Message'] = 'Account Created Successfully';
            $data['Status'] = 'SUCCESS';
            http_response_code(200);
        }else{
            $data['Status'] = 'FAILED';
            $data['Message'] = 'Invalid Data Passed';
            http_response_code(401);
        }
        echo json_encode($data);
    }

	public function userLogin()
	{
        $this->load->model('authModel');
        $json = json_decode(file_get_contents('php://input'));
        $usertype = isset($json->userType) ? $json->userType : null; 
        $username = isset($json->username) ? $json->username : null; 
        $password = isset($json->password) ? $json->password : null; 
        $data = [];
        if($username != null && $password != null){
            $query = $this->authModel->loginUser($usertype,$username,$password);
            if($query != null){
                $data['Message'] = 'GRANTED';
                $data['Status'] = 'SUCCESS';
                http_response_code(200);
            }else{
                $data['Message'] = 'Invalid Email Id or Password';
                $data['Status'] = 'FAILED';
                http_response_code(401);
            }
        }else{
            $data['Status'] = 'FAILED';
            $data['Message'] = 'Invalid Data Passed';
            http_response_code(401);
        }
        echo json_encode($data);
    }

    // Private Function 
    public function insertBloodGroupData($username){
        $this->load->model('dashboardModel');
        $bloodGroups = $this->GetBloodTypes();
        $bloodGroups = (json_decode($bloodGroups))->groups;
            $this->dashboardModel->ChangeAvailableBloodGroups($bloodGroups,$username);
        }

    function GetBloodTypes(){
        $this->load->model('authModel');
        $data['groups'] = $this->authModel->getAllBloodGroups();
        http_response_code(200);
        return json_encode($data); 
    }

    public function GetBloodGroups(){
        $this->load->model('authModel');
        $data['groups'] = $this->authModel->getAllBloodGroups();
        http_response_code(200);
        echo json_encode($data); 
    }


}
