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
public function UpdateBid($data)
{
    $sp = "sUpdateBid ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?"; //No exec or call needed

    //     //No @ needed.  Codeigniter gets it right either way
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->row_array();
        return $retVal;
}
public function UpdateClin($data)
{
    $sp = "sUpdateClin ?,?,?,?,?,?";
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->row_array();
        return $retVal;
}
public function GetBidOpenandDraft($BidStatusId)
{
    $query = $this->db->query("sGetBidOpenandDraft @BidStatusId='$BidStatusId'");
    return $query->result_array();

}
public function GetConAwardByUser($CurrentUserid)
{
    $query = $this->db->query("sGetConAwardByUser @CurrentUserid='$CurrentUserid'");
    return $query->result_array();

}

public function GetBidResponseSubmittedByVendor($VendorId)
{
    $query = $this->db->query("sGetBidResponseSubmittedByVendor @VendorId='$VendorId'");
    return $query->result_array();

}

public function GetBidResponseNotSubmittedByVendor($VendorId)
{
    $query = $this->db->query("sGetBidResponseNotSubmittedByVendor @VendorId='$VendorId'");
    return $query->result_array();

}
public function AddBidData($data)
{
    $sp = "sAddBid ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->result_array();
        return $retVal;
}

public function GetEmplyeeViewbid($BidStatusId,$SolicitationTypeId,$SetAsideTypeId)
{
    $query = $this->db->query("sGetEmployeeViewBid @BidStatusId='$BidStatusId',@SolicitationTypeId='$SolicitationTypeId',@SetAsideTypeId = '$SetAsideTypeId' ");
    return $query->result_array();
}

public function GetVendorViewbid($BidStatusId,$SolicitationTypeId,$SetAsideTypeId)
{
    $query = $this->db->query("sGetEmployeeViewBid @BidStatusId='$BidStatusId',@SolicitationTypeId='$SolicitationTypeId',@SetAsideTypeId = '$SetAsideTypeId' ");
    return $query->result_array();
}
public function GetReviewerNameList()
{
    $query = $this->db->query("sGetReviewerName");
    return $query->result_array();

}
public function AddReviewerData($data)
{
    $sp = "sAddReviewer ?,?,?,?,?,?";
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->result_array();
        return $retVal;
}
public function AddSubContractPlanDetail($data)
{
    $sp = "sAddSubContractingPlan ?,?,?,?,?,?,?,?";
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->result_array();
        return $retVal;
}

public function AddClinItemDetail($data)
{
    $sp = "sAddClin ?,?,?,?,?,?,?,?";
    $params =$data;
        $result = $this->db->query($sp,$params);
        $retVal = $result->result_array();
        return $retVal;
}
public function GetReviewerDetail()
{
    $query = $this->db->query("sGetReviewer");
    return $query->result_array();

}
}