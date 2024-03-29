<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
class Contract extends REST_Controller
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
        $this->load->model("contract_model");
    }

//

public function GetVendorActiveContracts_get()
{
    $VendorId=$_GET['VendorId'];
    $data['VendorActiveContracts']=$this->contract_model->GetVendorActiveContracts($VendorId);
    $this->response($data);

}

    }
