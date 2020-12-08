<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function AvailableBloodGroupsByHospital($username){
        $this->load->database();
        $query = $this->db->query("SELECT * from availability where hospital = '$username'");
        return $query->result();
    }

    public function ChangeAvailableBloodGroups($bloodgroups,$hospital){
        $this->load->database();
        foreach($bloodgroups as $group){
          $condition = "bloodgroup = '$group->type' and hospital = '$hospital' ";
          $ampBlock = isset($group->status) ? " and status = '$group->status'" : " and status = 'AVAILABLE'";
          $check = $this->db->query("SELECT * from availability where $condition");
          if($check->row() == null){
            $query = $this->db->query("INSERT INTO availability (bloodgroup,hospital,status) VALUES ('$group->type','$hospital','AVAILABLE')");
          }else{
            $status = $group->status ? 'AVAILABLE' : 'UNAVAILABLE';
            $query = $this->db->query("UPDATE availability SET bloodgroup = '$group->type', SET hospital = '$hospital', SET status = '$status' where $condition");
          }
        }
    }

    public function GetHospitalsWithBloodGroup($group){
      $this->load->database();
      $query = $this->db->query("SELECT * from availability  INNER JOIN hospitals on hospitals.username = availability.hospital where availability.bloodgroup = '$group' and status = 'AVAILABLE'");
      return $query->result();
    }

    public function AddRequirement($username,$hospitalname,$bloodGroup){
      $this->load->database();
      $query = $this->db->query("INSERT into request (receiver,hospital,requirement,dateplaced,status) VALUES ($username,$hospitalname,$bloodGroup,now(),'REQUESTED')");
    }

    public function GetRequirements($usertype,$username){
      $this->load->database();
      $query = $this->db->query("SELECT * from request where $usertype = '$username'");
      return $query->result();
    }

    public function GetUserBloodType($username){
      $this->load->database();
      $query = $this->db->query("SELECT * from receivers where username='$username'");
      return $query->row();
    }
}
