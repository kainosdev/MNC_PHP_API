<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bid_model extends CI_Model
{

    /**
     * Check owner function
     *
     * @param int $mobile
     * @return array owner details
     */

public function GetBidByNumber($BidNumber)
{
    $query = $this->db->query("sGetBidByBidNumber @BidNumber='$BidNumber'");
    return $query->result_array();

}
public function GetBidClinByNumber($BidNumber)
{
    $query = $this->db->query("sGetBidClinByBidNumber @BidNumber='$BidNumber'");
    return $query->result_array();

}
public function getBuyingEntity()
{
$query = $this->db->get('vBuyingEntity');
return $query->result_array();
}
public function GetViewBidList()
{
    $query = $this->db->query("sGetViewBid");
    return $query->result_array();

}

}