<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Contract_model extends CI_Model
{

    /**
     * Check owner function
     *
     * @param int $mobile
     * @return array owner details
     */
public function GetVendorActiveContracts($VendorId)
{
    $query = $this->db->query("sVendorActiveContracts @VendorId='$VendorId'");
    return $query->result_array();

}

}