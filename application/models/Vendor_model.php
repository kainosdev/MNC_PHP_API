<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vendor_model extends CI_Model
{





          public function generateToken($data)
    {
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }

    function insert_vendorContact($VendorId, $ContactName,$Phone, $JobTitle, $Email, $VendorContactPrimary,$VendorContactActive
     ) {
        $sp = "InsertVendorContact ?, ?, ?, ?, ?, ?, ?";

        $data = array(
            'VendorId' => $VendorId,
            'ContactName' => $ContactName,
            'Phone' => $Phone,
            'JobTitle' => $JobTitle,
            'Phone' => $Phone,
            'Email' => $Email,
            'VendorContactPrimary' => $VendorContactPrimary,
            'VendorContactActive' => $VendorContactActive,



            );

            $result = $this->db->query($sp,$data);


	}

    // function getVendorType()
    // {
    //     var_dump("hi");
    //     $query = $this->db->get('vVendorType');
    //     return $query->result_array();
    // }

    public function GetVendorList()
{
    $query = $this->db->query("sGetAllVendors");
    return $query->result_array();

}

public function GetVendorById($VendorId)
{
    $query = $this->db->query("sGetVendorById @VendorId='$VendorId'");
    return $query->result_array();

}

public function GetVendorAddressById($VendorId)
{
    $query = $this->db->query("sGetVendorAddressById @VendorId='$VendorId'");
    return $query->result_array();

}

// public function updatevendorDetails($vendordata){
    // $this->db->trans_begin();



        //$sp = "sUpdateVendor ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
        // $sp = "sUpdateVendor ?,?,?,?";
        // $params =$vendordata;

            // print_r($params);

            // $result = $this->db->query($sp,$params);
            // var_dump($this->db->trans_status());
            // if ($result) {


            // }


            //     if ($this->db->trans_status() === FALSE)
            // {
            //     $this->db->trans_rollback();
            // }
            // else
            // {
            //     $this->db->trans_commit();
            //     return TRUE;

            // }

    // }


    public function updatevendorDetails($data){


        $sp = "sUpdateVendor ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed
        //echo $sp;

        //     //No @ needed.  Codeigniter gets it right either way
        $params =$data;

            $result = $this->db->query($sp,$params);

            // $sp1 = "sUpdateVendorAddress ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed
        //echo $sp;

        //     //No @ needed.  Codeigniter gets it right either way
        // $params1 =$data1;

            // $result = $this->db->query($sp1,$params1);

   }

   public function GetVendorContactById($VendorId,$VendorContactPrimary)
{
    $query = $this->db->query("sGetVendorContactById @VendorId='$VendorId', @VendorContactPrimary='$VendorContactPrimary'");
    return $query->result_array();

}



public function insertVendorContact($data){


    $sp = "sAddVendorContact ?,?,?,?,?,?,?"; //No exec or call needed
    //echo $sp;

    //     //No @ needed.  Codeigniter gets it right either way
    $params =$data;

        $result = $this->db->query($sp,$params);



}
public function UpdateVendorContact($data){


    $sp = "sUpdateVendorContact ?,?,?,?,?,?,?,?"; //No exec or call needed

    //     //No @ needed.  Codeigniter gets it right either way
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->row_array();
       // var_dump($retVal);
        foreach($retVal as $key=>$value)
        {
            $firstprocedursuccess= $value;
        }
        return $firstprocedursuccess;

}

}