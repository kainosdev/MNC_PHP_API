<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Employee_model extends CI_Model
{

    public function get_employee_details()
        {
            $this->db->select('*');
            $this->db->from('tEmployee');
            return $this->db->get()->row_array();
        }

        public function getAllEmpType()
{
$query = $this->db->get('vEmploymentType');
return $query->result_array();
}

public function getJobTitle()
{
$query = $this->db->get('vJobTitle');
return $query->result_array();
}

// public function getNewID(){
//     $query = $this->db->get('vGetNewID');
// return $query->row_array();
// }


// public function AdduserDetailsEmployee($data,$data1){
//     $this->db->trans_begin();

//     // echo $data["UserId"];

//         $sp = "sAddUser ?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed

//         //     //No @ needed.  Codeigniter gets it right either way
//         $params =$data;
//             // $params = array($data);
//             // print_r($params);

//             $result = $this->db->query($sp,$params);
//             var_dump($this->db->trans_status());
//             if ($result) {

//             $sp1 = "sAddEmployee ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed - count 16

//         //     //No @ needed.  Codeigniter gets it right either way
//         $params1 = $data1;
//             // $params = array($data);
//             // print_r($params);

//             $result1 = $this->db->query($sp1,$params1);
//             }


//                 if ($this->db->trans_status() === FALSE)
//             {
//                 $this->db->trans_rollback();
//                 return false;
//             }
//             else
//             {
//                 $this->db->trans_commit();
//                 return TRUE;

//             }

//     }



    // public function AdduserDetailsVendor($data,$data1){
    //     $this->db->trans_begin();

    //     // echo $data["UserId"];

    //         $sp = "sAddUser ?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed

    //         //     //No @ needed.  Codeigniter gets it right either way
    //         $params =$data;
    //             // $params = array($data);
    //             // print_r($params);

    //             $result = $this->db->query($sp,$params);
    //             var_dump($this->db->trans_status());
    //             if ($result) {

    //             $sp1 = "sAddVendor ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed

    //         //     //No @ needed.  Codeigniter gets it right either way
    //         $params1 = $data1;
    //             // $params = array($data);
    //             // print_r($params);

    //             $result1 = $this->db->query($sp1,$params1);
    //             }


    //                 if ($this->db->trans_status() === FALSE)
    //             {
    //                 $this->db->trans_rollback();
    //             }
    //             else
    //             {
    //                 $this->db->trans_commit();
    //                 return TRUE;

    //             }

    //     }
    public function AdduserDetailsEmployee($data){


        $sp = "sAddEmployee ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed

        //     //No @ needed.  Codeigniter gets it right either way
        $params =$data;
            $result = $this->db->query($sp,$params);
            $retVal = $result->result_array();
        //    var_dump($retVal);
            // foreach($retVal as $key=>$value)
            // {

            //     // $firstprocedursuccess= $key;
            // }
            // if($key=="ErrorCodeID")
            // {
            // $firstprocedursuccess= $value;
            // }
            return $retVal;

   }



    public function AdduserDetailsVendor($data){


        // echo $data["UserId"];

           // $sp = "sAddVendor ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed

           $sp = "sAddVendor ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
            //     //No @ needed.  Codeigniter gets it right either way
            $params =$data;
                // $params = array($data);
                // print_r($params);

                //$result = $this->db->query($sp,$params);
                $result = $this->db->query($sp,$params);
                $retVal = $result->result_array();
               // echo $retVal;

            return $retVal;

        }

        public function GetDirectReportList($EmployeeIdSupervisor)
        {
            $query = $this->db->query("sGetDirectReport @EmployeeIdSupervisor='$EmployeeIdSupervisor'");
            return $query->result_array();

        }
        public function GetEmployeeApprovalList($UserTypeId,$UserStatusId)
        {
            $query = $this->db->query("sGetEmployeeApproval @UserTypeId='$UserTypeId',@UserStatusId='$UserStatusId'");
            return $query->result_array();

        }
        public function Updateemplyeestatus($Id,$UserStatusId,$UpdatedUserId,$UpdatedDate)
        {
            $query = $this->db->query("sUpdateEmployeeStatus @Id='$Id',@UserStatusId='$UserStatusId',@UpdatedUserId = '$UpdatedUserId',@UpdatedDate='$UpdatedDate'");
            return $query->result_array();

        }



}