<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
class Bid extends REST_Controller
{
    public $device = "";
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        header('Content-Type:  multipart/form-data');
        header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
// header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}

        $this->load->library("applib", array("controller" => $this));
        $this->load->model("app_model");
        $this->load->model("vendor_model");
        $this->load->model("bid_model");
    }

//
public function GetBidByNumber_get()
{
    $BidNumber=$_GET['BidNumber'];
    $data['BidDetails']=$this->bid_model->GetBidByNumber($BidNumber);
    $this->response($data);

}

public function GetBidClinByNumber_get()
{
    $BidNumber=$_GET['BidNumber'];
    $data['BidClinDetails']=$this->bid_model->GetBidClinByNumber($BidNumber);
    $this->response($data);

}
public function BuyingEntity_get()
{
    $data['BuyingEntity']=$this->bid_model->getBuyingEntity();
    $this->response($data);
}
public function GetViewBid_get()
{
    $data['ViewBid']=$this->bid_model->GetViewBidList();
    $this->response($data);

}
public function GetBidOpen_get()
{
    $BidStatusId=$_GET['BidStatusId'];
    $data['BidOpen']=$this->bid_model->GetBidOpenList($BidStatusId);
    $this->response($data);

}
public function GetContractlist_get()
{
    $CurrentUserid=$_GET['CurrentUserid'];
    $data['currentuserid']=$this->bid_model->GetContractALl($CurrentUserid);
    $this->response($data);

}

    }
