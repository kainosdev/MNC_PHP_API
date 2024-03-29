<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
// require APPPATH . '/libraries/JWT.php';
class Login extends REST_Controller
{
    public $device = "";
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        header('Content-Type:  multipart/form-data');
        header('Authorization: token');
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
        $this->load->model("shop_model");
        $this->load->model("dealer_model");
        $this->load->model("shop_model");
        $this->load->model("login_model");
    }



    public function loginauth_post()
    {

        $UserId = $this->post('UserId');
        $password = $this->post('Password');
        $IPAddress = $this->post('IPAddress');

         $rowcountuser = $this->login_model->checkuser($UserId);
               if($rowcountuser != 0)
               {

                       $userdetails = $this->login_model->get_user_credential($UserId);
                       $retpassword = $userdetails['UserPassword'];
                       $UserTypeId = $userdetails['UserTypeId'];

                       $firstname;
                        $lasttname;
                        $Middlename;

                       if($UserTypeId == 'EMPLOY'){
                        $Empdetails = $this->login_model->get_EmployeeDetails($UserId);
                        $firstname = $Empdetails['FirstName'];
                        $lasttname = $Empdetails['LastName'];
                        $Middlename = $Empdetails['MiddleName'];
                       }
                       if($UserTypeId  == 'BUSINE' ){
                       $Vendordetails = $this->login_model->get_VendorDetails($UserId);
                       $firstname = $Vendordetails['LegalName'];
                       $lasttname = $Vendordetails['TradeName'];
                       $Middlename = $Vendordetails['AliasName'];
                       }
                       if($UserTypeId  == 'INDIVI' ){

                        $Vendordetails = $this->login_model->get_VendorDetails($UserId);
                        $firstname = $Vendordetails['LegalName'];
                        $lasttname = $Vendordetails['TradeName'];
                        $Middlename = $Vendordetails['AliasName'];
                        }


                       $UserStatusId = $userdetails['UserStatusId'];

                        if($retpassword == $password &&  $UserStatusId == "A")
                        {

                            $tokenData['UserId'] = $UserId;
                            $tokenData['UserTypeId'] = $UserTypeId;
                            $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
                            $jwtToken = $this->applib->generateToken($tokenData);

                            $dealerData['token'] = $jwtToken;
                            $checkUserLogin = $this->login_model->checkUserLoginDetails($UserId);

                                        if($checkUserLogin == 0)
                                        {
                                        $LoginDate=date('Y-m-d');
                                        // $Password=$password;
                                        $Successful=1;
                                        $IPAddress=$IPAddress;
                                        $LoginDetail="Success";
                                        $SessionId="";

                                        $result = $this->login_model->AddUserLogin($UserId,
                                        $LoginDate,
                                        $password,
                                        $Successful,
                                        $IPAddress,
                                        $LoginDetail,
                                        $SessionId
                                    );
                                                    $data['success'] = $result;
                                    }

else {
    $LoginDate=date('Y-m-d');


    $Password=$Password;
    $Successful=1;
    $IPAddress=$IPAddress;
    $LoginDetail='Success';
    $SessionId='';

    $result = $this->login_model->UpdateUserLogin($UserId,
    $LoginDate,
    $password,
    $Successful,
    $IPAddress,
    $LoginDetail,
    $SessionId
);
                $data['success'] = $result;
}
// echo "$jwtToken";

$data = $jwtToken."VERTEX-LMS".$UserId."VERTEX-LMS".$UserTypeId."VERTEX-LMS".$firstname
."VERTEX-LMS".$lasttname;


$this->response($data);



                        }
                        else if($retpassword == $password &&  $UserStatusId == "N"){
                            $this->response("Waiting For Approval");
                        }
                        else if($retpassword != $password &&  $UserStatusId == "N"){
                            $this->response("Incorrect Password");
                        }
                        else if($retpassword == $password &&  $UserStatusId != "A")
                        {

                            $this->response($data);

                        }
                        else if($retpassword != $password &&  $UserStatusId == "A")
                        {

                            $this->response("Incorrect Password");
                        }



                    }
                    else
                    {
                            $this->response("Invalid User");
                    }




    }

    public function displayAllEmployee1_get()
    {
        $userdetails = $this->login_model->displayAllEmployee();
        $this->response($userdetails);
    }

    public function insertVendor_post() {
        var_dump($this->input->post('VendorId'));
        // if ($this->input->post('submit')) {
            // $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            // $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
            // $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
            // $this->form_validation->set_rules('address', 'Contact Address', 'trim|required');

            // if ($this->form_validation->run() !== FALSE) {
                $result = $this->login_model->insert_user($this->input->post('VendorId'),
                $this->input->post('LegalName'),
                 $this->input->post('TradeName'),
                 $this->input->post('AliasName'),
                  $this->input->post('Phone'),
                $this->input->post('Email'),
                 $this->input->post('EIN_SSN'),
                  $this->input->post('VendorTypeId'),
                   $this->input->post('OutreachEmailOptIn'),
                $this->input->post('BusinessSize'),
                $this->input->post('NAICSCodes'),
                $this->input->post('CommodityCodes'),
                $this->input->post('BEClassificationId'),
                $this->input->post('BusinessRegisteredInDistrict'),
                $this->input->post('BusinessIsFranchisee'),
                $this->input->post('Website'),
                $this->input->post('CreatedDate'),
                $this->input->post('UpdatedDate'),
                $this->input->post('CreatedUserId'),
                $this->input->post('UpdatedUserId'),
                $this->input->post('BusinessRegisteredInSCC'));
                $data['success'] = $result;

            // } else {
            //     $this->load->view('sp_view');
            // }
        // } else {
        //     $this->load->view('sp_view');
        // }
    }

    public function insert_post() {

                $result = $this->login_model->insert_user1($this->input->post('CountryId'), $this->input->post('CountryName'));

    }

//     public function sp()
// {
// $this->login_model->pc();
// }

public function AddCountryInsert_post() {


    $json = file_get_contents('php://input');
// Converts it into a PHP object
    $data = json_decode($json);
    print_r($data);

        $insertTestimonial = $this->login_model->AddCountry($data);



}

public function CountryView_get()
{
    $userdetails = $this->login_model->getCountryView();
    $this->response($userdetails);
}

public function AddUserLogin_post()
{
    $UserId=$_POST['UserId'];
    $checkUserLogin = $this->login_model->checkUserLoginDetails($UserId);
    // var_dump($checkUserLogin);
    if($checkUserLogin == 0){
    $LoginDate=date('Y-m-d');
    $Password=$_POST['Password'];
    $Successful=$_POST['Successful'];
    $IPAddress=$_POST['IPAddress'];
    $LoginDetail=$_POST['LoginDetail'];
    $SessionId=$_POST['SessionId'];

    $result = $this->login_model->AddUserLogin($UserId,
    $LoginDate,
    $Password,
    $Successful,
    $IPAddress,
    $LoginDetail,
    $SessionId
);
                $data['success'] = $result;
}
else {
    $LoginDate=date('Y-m-d');
    $Password=$_POST['Password'];
    $Successful=$_POST['Successful'];
    $IPAddress=$_POST['IPAddress'];
    $LoginDetail=$_POST['LoginDetail'];
    $SessionId=$_POST['SessionId'];

    $result = $this->login_model->UpdateUserLogin($UserId,
    $LoginDate,
    $Password,
    $Successful,
    $IPAddress,
    $LoginDetail,
    $SessionId
);
                $data['success'] = $result;
}

}
public function AddUser_post()
{
    $cuid=$this->login_model->selectNewid();
    echo $cuid;
    // var_dump($cuid);
//     $result = $this->login_model->addUser($this->input->post('password'),
//     'VENDOR',
//     'N',
//     $this->input->post('password'),
//     '',
//     '',
//     date('Y-m-d'),
//     '',
//      date('Y-m-d'),
//     '',
//     $this->input->post('firstname'),
//     $this->input->post('lastname'),
//     $this->input->post('phone'),
//     $this->input->post('email'),
//     $this->input->post('postalcode'),
//     $this->input->post('vendortype')
//   //  $this->input->post('jobtitle')
// );
//     $data['success'] = $result;
//     $this->response($data);
}


}

