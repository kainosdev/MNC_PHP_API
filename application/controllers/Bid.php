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
//$SectorId=$request["SectorId"];
//$DivisionId=$request["DivisionId"];
//$DepartmentId=$request["DepartmentId"];
$BuyingEntityTypeId=$request["BuyingEntityTypeId"];
$SetAsideTypeId=$request["SetAsideTypeId"];
$FundingSourceId=$request["FundingSourceId"];
$BidBudgetAmount=$request["BidBudgetAmount"];
$ContractVehicleId=$request["ContractVehicleId"];
$Descritpion=$request["Descritpion"];
$ContractingOfficer=$request["ContractingOfficer"];
$BidPostedDate=$request["BidPostedDate"];
$QandADueDate=$request["QandADueDate"];
$BidResponseDueDate=$request["BidResponseDueDate"];
$BidNotes=$request["BidNotes"];
$UpdatedDate=date('Y-m-d')
$UpdatedUserId=$request["UpdateUserId"];
$Phone=$request["Phone"];
$Email=$request["Email"];

$BidDetails=array('BidNumber'=>$BidNumber,'Title'=>$Title,'SolicitationTypeId'=>$SolicitationTypeId,'BidStatusId'=>$BidStatusId,
	'BuyingEntityTypeId'=>$BuyingEntityTypeId,'SetAsideTypeId'=>$SetAsideTypeId,'FundingSourceId'=>$FundingSourceId,
	'BidBudgetAmount'=>$BidBudgetAmount,'ContractVehicleId'=>$ContractVehicleId,'BidPostedDate'=>$BidPostedDate,
	'BidResponseDueDate'=>$BidResponseDueDate,'QandADueDate'=>$QandADueDate,'BidNotes'=>$BidNotes,
	'UpdatedDate'=>$UpdatedDate,'UpdatedUserId'=>$UpdatedUserId,'Descritpion'=>$Descritpion,
	'ContractingOfficer'=>$ContractingOfficer,'Phone'=>$Phone,'Email'=>$Email);

    $result = $this->bid_model->UpdateBid($BidDetails);

$this->response($result,'200');
}

public function UpdateClin_post()
{
    $json = file_get_contents('php://input');
    $request = json_decode($json,true);
    $BidNumber=$request["BidNumber"];
    $ClinId = $request["ClinId"],
    $BidClinCustomDesc=$request["BidClinCustomDesc"];
    $ServiceTypeId=$request["ServiceTypeId"];
    $BEGoalTypeId=$request["BEGoalTypeId"];
    $DBEGoalPercent=$request["DBEGoalPercent"];
    $ClinDetails=array('BidNumber'=>$BidNumber,'ClinId'=>$ClinId,'BidClinCustomDesc'=>$BidClinCustomDesc,
                       'ServiceTypeId'=>$ServiceTypeId,'BEGoalTypeId'=>$BEGoalTypeId,'DBEGoalPercent'=>$DBEGoalPercent);

    $result = $this->bid_model->UpdateClin($ClinDetails);

$this->response($result,'200');
}
public function GetBidOpenandDraft_get()
{
    // var_dump("hi");
    $BidStatusId=$_GET['BidStatusId'];
    $data['BidOpen']=$this->bid_model->GetBidOpenandDraft($BidStatusId);
    $this->response($data);

}
public function GetConAwardByUser_get()
{
    $CurrentUserid=$_GET['CurrentUserid'];
    $data['currentuserid']=$this->bid_model->GetConAwardByUser($CurrentUserid);
    $this->response($data);

}

    }
