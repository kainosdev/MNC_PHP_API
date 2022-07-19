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
public function UpdateBid_post()
{
    $json = file_get_contents('php://input');
    $request = json_decode($json,true);
    $BidNumber=$request["BidNumber"];
$Title=$request["Title"];
$SolicitationTypeId=$request["SolicitationTypeId"];
$BidStatusId=$request["BidStatusId"];
$FundingSourceId=$request["FundingSourceId"];
$ContractVehicleId=$request["ContractVehicleId"];
$Descritpion=$request["Descritpion"];
$BidBudgetAmount=$request["BidBudgetAmount"];
$BidPostedDate=$request["BidPostedDate"];
$BuyingEntityTypeId=$request["BuyingEntityTypeId"];
$BidResponseDueDate=$request["BidResponseDueDate"];
$QandADueDate=$request["QandADueDate"];
$ContractingOfficer=$request["ContractingOfficer"];
DepartmentId
ContractVehicleId
SetAsideTypeId


BidNotes
ContractNumber
ComtractVendorId
CreatedDate
CreatedUserId
UpdatedDate
UpdatedUserId
Descritpion



    $VendorId = $request["VendorId"];
    $ContactId = $request["ContactId"];
    $JobTitle=$request["JobTitle"];
    $Phone=$request["Phone"];
    $Email= $request["Email"];
    $VendorContactActive=$request["VendorContactActive"];
    $VendorContactPrimay=$request["VendorContactPrimary"];
    $ContactName=$request["ContactName"];
    $BidDetails=array('VendorId'=>$VendorId,'ContactName'=>$ContactName,'JobTitle'=>$JobTitle,
    'Phone'=>$Phone,'Email'=>$Email,'VendorContactActive'=>$VendorContactActive,
    'VendorContactPrimay'=>$VendorContactPrimay,'ContactId'=>$ContactId);

    $result = $this->vendor_model->UpdateBid($BidDetails);
      $data = [
       'ErrorCode' => $result
      ];

$this->response($data);
}

    }
