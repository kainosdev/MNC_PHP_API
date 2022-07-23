<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
// require APPPATH . '/libraries/JWT.php';
class Vendor extends REST_Controller
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
        $this->load->model("vendor_model");
        $this->load->model("login_model");
        $this->load->model("employee_model");
    }
    public function InsertNewVendor_post()
    {
        $vendorinsertsuccess = $this->vendor_model->InsertNewVendor();
        $this->response($vendorinsertsuccess);
    }

    public function InsertVendorContact_get()
{
    $ContactBusiness=$_GET['ContactBusiness'];
    $ContactBusinessArr = json_decode($ContactBusiness,true);
    // $ContactBusinessArr = (array) $ContactBusiness;
    // $ContactBusinessArr2 = (array) $ContactBusinessArr;
    var_dump($ContactBusinessArr);
    // $vendorid = "test";
    if($ContactBusinessArr["VendorContactPrimary"] == true) {
        $ContactBusinessArr["VendorContactPrimary"] = 1;
    }
    else {
        $ContactBusinessArr["VendorContactPrimary"] = 0;
    }

    if($ContactBusinessArr["VendorContactPrimary"] == true) {
        $ContactBusinessArr["VendorContactActive"] = 1;
    }
    else {
        $ContactBusinessArr["VendorContactActive"] = 0;
    }
    $result = $this->vendor_model->insert_vendorContact("10",
    $ContactBusinessArr["contact_name"],
    $ContactBusinessArr["business_phone"],
    $ContactBusinessArr["title"],
    $ContactBusinessArr["business_email"],
    $ContactBusinessArr["VendorContactPrimary"],
    $ContactBusinessArr["VendorContactActive"],
//     $ContactBusinessArr["contact_name"],
//     $ContactBusinessArr["contact_name"]
);
                $data['success'] = $result;
    // var_dump($ContactBusinessArr[0]);

    // $vendorMgmt=$_GET['vendorMgmt'];


    // $queryresponse= $this->app_model->Addwhislisttodb($whislist,$Customer_id,$date,$city_id);
    //$this->response($ContactBusiness);
}

public function GetVendorType_get()
{
   // $dealer_id = $this->applib->verifyToken();
    $data['vendortype'] = $this->vendor_model->getVendorType();
    $this->response($data);

}


public function AdduserDetails_post()
{
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
            $request = json_decode($json,true);
            $registercontactinformation = $request->registercontactinformation;
            // var_dump($MasterserviceForm);
            $UserTypeId = $registercontactinformation->UserTypeId;
           // var_dump($UserTypeId);
if($request["UserTypeId"]=="EMPLOY")
{
    //USer table
$UserId = $request["UserId"];
$UserTypeId = $request["UserTypeId"];
$UserStatusId = $request["UserStatusId"];
$UserPassword = $request["UserPassword"];
//$EmployeeId = NULL;
$VendorId = NULL;
$AdminUser = $request["AdminUser"];
if($AdminUser == true){
    $AdminUser = 1;
}
else {
    $AdminUser = 0;
}

// employee tbl insert
$FirstName = $request["FirstName"];
$LastName = $request["LastName"];
$MiddleName = $request["MiddleName"];
$Phone = $request["Phone"];
$EmploymentTypeId = $request["EmploymentTypeId"];
$JobTitleId = $request["JobTitleId"];
$StartDate = $request["JobStartDate"];

// $CreatedUserId = $request["CreatedUserId"];
$Email = $request["Email"];
$CreatedDate = date('Y-m-d  H:i:s');
$UpdatedDate = date('Y-m-d  H:i:s');
// $UpdatedUserId = $request["UpdatedUserId"];



// insert into employee address
$AddressTypeId = 'C';
$AStartDate = date('Y-m-d');
//$EndDate = $request["StartDate"];
$Address1 = $request["Address1"];
$Address2 = $request["Address2"];
$DistrictId = $request["DistrictId"];
$CityId = $request["CityId"];
$StateId = $request["StateId"];
$Zipcode = $request["Zipcode"];
$CountryId = $request["CountryId"];

$data = array('UserId' => $UserId, 'UserTypeId' => $UserTypeId, 'UserStatusId' => $UserStatusId,
'UserPassword' => $UserPassword,'VendorId' => $VendorId,'CreatedDate' => $CreatedDate,
'CreatedUserId' => $UserId, 'UpdatedDate' => $UpdatedDate,
'UpdatedUserid' => $UserId, 'AdminUser' => $AdminUser,
'FirstName'=>$FirstName,'LastName'=>$LastName,'MiddleName'=>$MiddleName,
'Phone'=>$Phone,'Email'=>$Email,'EmploymentTypeId'=>$EmploymentTypeId,'JobTitleId'=>$JobTitleId,'StartDate'=>$StartDate,
 'AddressTypeId'=>$AddressTypeId,
'AStartDate'=>$AStartDate,'Address1'=>$Address1,'Address2'=>$Address2,'StateId'=>$StateId,'Zipcode'=>$Zipcode,
'CountryId'=>$CountryId,'DistrictId'=>$DistrictId,'CityId'=>$CityId );





             $result = $this->employee_model->AdduserDetailsEmployee($data);


        $this->response($result,200);
}
//                 // insert vendor
elseif($request["UserTypeId"]=="BUSINE")
 {
//var_dump("ss");
$UserId = $request["UserId"];
$UserTypeId = $request["UserTypeId"];
$UserStatusId = $request["UserStatusId"];
$UserPassword = $request["UserPassword"];
$EmployeeId = NULL;
$CreatedDate = date('Y-m-d  H:i:s');
$UpdatedDate = date('Y-m-d  H:i:s');
$AdminUser = NULL;
$AStartDate = date('Y-m-d');
$FirstName = $request["FirstName"];
$LastName = $request["LastName"];
$AliasName = $request["AllasName"];
$VendorTypeId = 'B';
$AddressTypeId = 'C';
$Address1 = $request["Address1"];
$Address2 = $request["Address2"];
$DistrictId = $request["county_name"];
$CityId = $request["CityId"];
$StateId = $request["StateId"];
$Zipcode = $request["Zipcode"];
$CountryId = $request["CountryId"];

$EIN_SSN = $request["business_ssn"];
//var_dump("before>>>$EIN_SSN");
$EIN_SSN = str_replace("-","",$EIN_SSN);
$BusinessSize = $request["BusinessSize"];
$BEClassificationId = $request["BEClassificationId"];
$OutreachEmailOptIn = $request["OutreachEmailOptIn"];
$Email=$request["Mailbusiness"];
if($OutreachEmailOptIn == true){
    $OutreachEmailOptIn = 1;
}
else {
    $OutreachEmailOptIn = 0;
}
$BusinessRegisteredInSCC = $request["BusinessRegisteredInSCC"];
if($BusinessRegisteredInSCC == true){
    $BusinessRegisteredInSCC = 1;
}
else {
    $BusinessRegisteredInSCC = 0;
}
$BusinessIsFranchisee = $request["BusinessIsFranchisee"];
if($BusinessIsFranchisee == true){
    $BusinessIsFranchisee = 1;
}
else {
    $BusinessIsFranchisee = 0;
}
$BusinessRegisteredInDistrict = $request["BusinessRegisteredInDistrict"];
if($BusinessRegisteredInDistrict == true){
    $BusinessRegisteredInDistrict = 1;
}
else {
    $BusinessRegisteredInDistrict = 0;
}

$data = array('UserId' => $UserId, 'UserTypeId' => $UserTypeId, 'UserStatusId' => $UserStatusId,
'UserPassword' => $UserPassword, 'EmployeeId' => $EmployeeId,'CreatedDate' => $CreatedDate,
'CreatedUserId' => $UserId, 'UpdatedDate' => $UpdatedDate,
'UpdatedUserid' => $UserId, 'AdminUser' => $AdminUser,
 'VendorTypeId'=>$VendorTypeId,'LegalName'=>$LastName,'TradeName'=>$FirstName,'AliasName'=>$AliasName,'EIN_SSN'=>$EIN_SSN,
'BusinessSize'=>$BusinessSize,'BEClassificationId'=>$BEClassificationId,'BusinessRegisteredInDistrict'=>$BusinessRegisteredInDistrict,
'BusinessRegisteredInSCC'=>$BusinessRegisteredInSCC,'BusinessIsFranchisee'=>$BusinessIsFranchisee,'OutreachEmailOptIn'=>$OutreachEmailOptIn,
'Email'=>$Email,
'AddressTypeId'=>$AddressTypeId,'StartDate'=>$AStartDate,'EndDate'=>$AStartDate,'Address1'=>$Address1,'Address2'=>$Address2,
'StateId'=>$StateId,'DistrictId'=>$DistrictId,'CityId'=>$CityId,'Zipcode'=>$Zipcode,'CountryId'=>$CountryId);
//var_dump($data);

             $result = $this->employee_model->AdduserDetailsVendor($data);

                           $data = [
                    'ErrorCode' => $result
             ]; //        $this->response('', 404, 'Notsuccess')

         $this->response($result,200);
       // $this->response($data,200);
 }
else
{

    $UserId = $request["UserId"];
    $UserTypeId = $request["UserTypeId"];
    $UserStatusId = $request["UserStatusId"];
    $UserPassword = $request["UserPassword"];
    $EmployeeId = NULL;
    $CreatedDate = date('Y-m-d  H:i:s');
    $UpdatedDate = date('Y-m-d  H:i:s');
    $AdminUser = NULL;
    $AStartDate = date('Y-m-d');
    $FirstName = $request["FirstName"];
    $LastName = $request["LastName"];
    $AliasName = $request["AllasName"];
    $VendorTypeId = 'B';
    $AddressTypeId = 'C';
    $Address1 = $request["Address1"];
    $Address2 = $request["Address2"];
    $DistrictId = $request["county_name"];
    $CityId = $request["CityId"];
    $StateId = $request["StateId"];
    $Zipcode = $request["Zipcode"];
    $CountryId = $request["CountryId"];

    $EIN_SSN = $request["business_ssn"];
    //var_dump("before>>>$EIN_SSN");
    $EIN_SSN = str_replace("-","",$EIN_SSN);
    $BusinessSize='';
    $BEClassificationId = '';
    $OutreachEmailOptIn = $request["OutreachEmailOptIn"];
    $Email=$request["Mailbusiness"];
    if($OutreachEmailOptIn == true){
        $OutreachEmailOptIn = 1;
    }
    else {
        $OutreachEmailOptIn = 0;
    }
    $BusinessRegisteredInSCC = '';

    $BusinessIsFranchisee = '';

    $BusinessRegisteredInDistrict = '';

    $data = array('UserId' => $UserId, 'UserTypeId' => $UserTypeId, 'UserStatusId' => $UserStatusId,
    'UserPassword' => $UserPassword, 'EmployeeId' => $EmployeeId,'CreatedDate' => $CreatedDate,
    'CreatedUserId' => $UserId, 'UpdatedDate' => $UpdatedDate,
    'UpdatedUserid' => $UserId, 'AdminUser' => $AdminUser,
     'VendorTypeId'=>$VendorTypeId,'LegalName'=>$LastName,'TradeName'=>$FirstName,'AliasName'=>$AliasName,'EIN_SSN'=>$EIN_SSN,
    'BusinessSize'=>$BusinessSize,'BEClassificationId'=>$BEClassificationId,'BusinessRegisteredInDistrict'=>$BusinessRegisteredInDistrict,
    'BusinessRegisteredInSCC'=>$BusinessRegisteredInSCC,'BusinessIsFranchisee'=>$BusinessIsFranchisee,'OutreachEmailOptIn'=>$OutreachEmailOptIn,
    'Email'=>$Email,
    'AddressTypeId'=>$AddressTypeId,'StartDate'=>$AStartDate,'EndDate'=>$AStartDate,'Address1'=>$Address1,'Address2'=>$Address2,
    'StateId'=>$StateId,'DistrictId'=>$DistrictId,'CityId'=>$CityId,'Zipcode'=>$Zipcode,'CountryId'=>$CountryId);
    //var_dump($data);

                 $result = $this->employee_model->AdduserDetailsVendor($data);

                               $data = [
                        'ErrorCode' => $result
                 ]; //        $this->response('', 404, 'Notsuccess')

             $this->response($result,200);


}// else {
// $VendorTypeId = "B";




// // $OutreachEmailOptIn = $request["OutreachEmailOptIn"];
// $EIN_SSN = '';


// $VendorTypeId = "I";
// $BusinessSize = '';
// $BEClassificationId = '';
// $BusinessRegisteredInDistrict = '';
// $BusinessRegisteredInSCC = '';
// $BusinessIsFranchisee = '';
// // $OutreachEmailOptIn = $request["OutreachEmailOptIn"];
// // $OutreachEmailOptIn = 1;
// $EIN_SSN = $request["EIN_SSN"];
// var_dump("before>>>$EIN_SSN");
// $EIN_SSN = str_replace("-","",$EIN_SSN);
// var_dump("after>>>$EIN_SSN");
// }
// ;
// // $Email = $request["Email"];



// $CreatedDate = date('Y-m-d');

// $UpdatedDate = date('Y-m-d');
// $CreatedUserId = $request["UserId"];
// $UpdatedUserId = $request["UserId"];


// // address vendor
// $AddressTypeId = 'C';
// $StartDate = $request["StartDate"];
// $EndDate = $request["StartDate"];
// $Address1 = $request["Address1"];
// $Address2 = $request["Address2"];

// $DistrictId = $request["DistrictId"];
// $CityId =  1; //$request["CityId"];
// $StateId = $request["StateId"];
// $Zipcode = $request["Zipcode"];
// $CountryId = $request["CountryId"];
// // $EndDate = $request["EndDate"];





// $data = array('UserId' => $UserId, 'UserTypeId' => $UserTypeId, 'UserStatusId' => $UserStatusId,
// 'UserPassword' => $UserPassword, 'EmployeeId' => $EmployeeId,'CreatedDate' => $CreatedDate,
// 'CreatedUserId' => $UserId, 'UpdatedDate' => $UpdatedDate,
// 'UpdatedUserid' => $UserId, 'AdminUser' => $AdminUser,
// 'VendorTypeId'=>$VendorTypeId,'LegalName'=>$LastName,'TradeName'=>$FirstName,'EIN_SSN'=>$EIN_SSN,
// 'BusinessSize'=>$BusinessSize,'BEClassificationId'=>$BEClassificationId,'BusinessRegisteredInDistrict'=>$BusinessRegisteredInDistrict,
// 'BusinessRegisteredInSCC'=>$BusinessRegisteredInSCC,'BusinessIsFranchisee'=>$BusinessIsFranchisee,'OutreachEmailOptIn'=>$OutreachEmailOptIn,
// 'AddressTypeId'=>$AddressTypeId,'StartDate'=>$StartDate,'EndDate'=>$EndDate,'Address1'=>$Address1,'Address2'=>$Address2,'StateId'=>$StateId,'DistrictId'=>$DistrictId,'CityId'=>$CityId,'Zipcode'=>$Zipcode,'CountryId'=>$CountryId);
// // var_dump($data);

//              $result = $this->employee_model->AdduserDetailsVendor($data);

//             //  if($result)
//             //  {
//             //     $this->response('', 200, 'success')
//             //  }
//             //  else
//             //  {

//                 $data = [
//                     'ErrorCode' => $result
//              ]; //        $this->response('', 404, 'Notsuccess')


// // var_dump($result);
//          $this->response($result,200);
}





public function GetAllVendors_get()
{

    $data['VendorList']=$this->vendor_model->GetVendorList();
    $this->response($data);

}

public function GetVendorById_get()
{
    $VendorId=$_GET['VendorId'];
    $data['SingleVendorDetails']=$this->vendor_model->GetVendorById($VendorId);
    $this->response($data);

}

public function GetVendorAddressById_get()
{
    $VendorId=$_GET['VendorId'];
    // $data=$this->vendor_model->GetVendorAddressById($VendorId);
    $data['SingleVendorAddressDetails']=$this->vendor_model->GetVendorAddressById($VendorId);
// var_dump($data);

// $test = json_decode($data, true);
// var_dump($test);
// foreach($array as $values) {
//    echo $values[0];

// }
    //$jsondatastdclass = json_decode($data);
//print_r($jsondataarray);

// foreach ($jsondatastdclass as $object)
// {
//   foreach ($object as $property=>$value)
//    {
//      echo $property." has the value ". $value;
//    }
// }
//  $data = json_decode($data);
// var_dump(json_decode($data));



    $this->response($data);

}
public function UpdateVendor_post(){
//     define('DEBUG', true);
// error_reporting(E_ALL);

// if(DEBUG == true)
// {
//        display_errors(true);
//        log_errors(false);
// }
// else
// {
//       display_errors(false);
//        log_errors(true);
// }

    $json = file_get_contents('php://input');
    $request = json_decode($json,true);
    // $vendorMgmt = $request->vendorMgmt;

    $VendorId = $request["VendorId"];
    $VendorTypeId = $request["VendorTypeId"];
    $Address1 = $request["Address1"];
    $Address2 = $request['Address2'];
    $CityId = $request['CityId'];
    $Zipcode = $request['Zipcode'];
    $DistrictId = $request['DistrictId'];
    $StateId = $request['StateId'];
    $CountryId = $request['CountryId'];
    $StartDate = $request['StartDate'];
    $EndDate = $request['EndDate'];

    $NAICSCodes = $request["NAICSCodes"];
    $BusinessRegisteredInDistrict = $request["BusinessRegisteredInDistrict"];
    $BusinessIsFranchisee = $request["BusinessIsFranchisee"];
    $DUNS = $request["DUNS"];
    $CommodityCodes = $request["CommodityCodes"];
    $Website = $request["Website"];
    $BusinessRegisteredInSCC = $request["BusinessRegisteredInSCC"];
    $ContactName = $request["ContactName"];
    $JobTitle = $request["JobTitle"];
    $VendorContactPrimary = $request["VendorContactPrimary"];
    $VendorContactActive = $request["VendorContactActive"];
    $Phone = $request["Phone"];
    $Email = $request["Email"];
    $BusinessEmail = $request["BusinessEmail"];
    $BusinessPhone = $request["BusinessPhone"];
    $CreatedUserId = $request["CreatedUserId"];
    $BusinessSize = $request["BusinessSize"];

    if($VendorTypeId == "B") {
         $LegalName = $request["LegalName"];
         $TradeName = $request["TradeName"];
         $AliasName = $request["AliasName"];
         $EIN_SSN = $request["Federal"];

        //  var_dump("before>>>$EIN_SSN");
         //$EIN_SSN = str_replace("-","",$EIN_SSN);
        //  var_dump("after>>>$EIN_SSN");

         $OutreachEmailOptIn = false;
         $Newcontact = $request["Newcontact"];


        //  $Newcontact = json_decode($json,true);
         $Newcontact1 = json_encode($request["Newcontact"],true);

         $Newcontact2 = json_decode($Newcontact1,true);
         var_dump($Newcontact2);
         foreach ($Newcontact2 as $object)

{
    //var_dump($object["AddtionalName"]);
    if($object["AddtionalContactActive"] == NULL){
        $object["AddtionalContactActive"] = 0;
    }
    var_dump($object["ContactId"]);

if($object["ContactId"] == 0){

    $data2 = array('VendorId' => $request["VendorId"], 'ContactName' => $object["AddtionalName"], 'BusinessPhone' => $object["AddtionalBusinessPhone"],
'BusinessEmail' => $object["AddtionalBusinessMail"], 'VendorContactActive' => $object["AddtionalContactActive"], 'VendorContactPrimary' => 0, 'JobTitle' => $object["AddtionalTitle"]
,'CreatedDate' => date('Y-m-d'),'CreatedUserId' => $CreatedUserId,'UpdatedDate' => date('Y-m-d'),'UpdatedUserId' => $CreatedUserId
);
// var_dump($data2);
    $result = $this->vendor_model->AddMultiVendorContact($data2);
}
else {

    $data3 = array('VendorId' => $request["VendorId"], 'ContactName' => $object["AddtionalName"], 'JobTitle' => $object["AddtionalTitle"], 'BusinessPhone' => $object["AddtionalBusinessPhone"],
'BusinessEmail' => $object["AddtionalBusinessMail"], 'VendorContactActive' => $object["AddtionalContactActive"], 'VendorContactPrimary' => 0, 'ContactId' => $object["ContactId"]
,'UpdatedDate' => date('Y-m-d'),'UpdatedUserId' => $CreatedUserId
);
// var_dump($data2);
    $result = $this->vendor_model->UpdateMultiVendorContact($data3);
}
//   foreach ($object as $property=>$value)
//    {
//      var_dump( $property." has the value ". $value);
//     //  var_dump
   }
// }


        //
// foreach($Newcontact1 as $item) { //foreach element in $arr
//     $uses = $item; //etc
// //     var_dump($uses);
// var_dump("i>>>>$item");
// }




        //  $array = json_decode( $Newcontact1, true );

         //$json  = '[{"var1":"9","var2":"16","var3":"16"},{"var1":"8","var2":"15","var3":"15"}]';
//$array = json_decode( $json, true );
        //   foreach ($Newcontact1 as $value) {
        //     echo "$value <br>";
        //   }
        //  var_dump($Newcontact1['AddtionalName']);

     }
    else {

        $TradeName = $request["LastName"];
        $LegalName = $request["FirstName"];
        $AliasName = $request["MiddleName"];
        $EIN_SSN = $request["EIN_SSN"];

        //  var_dump("before>>>$EIN_SSN");
         $EIN_SSN = str_replace("-","",$EIN_SSN);
        //  var_dump("after>>>$EIN_SSN");
        $OutreachEmailOptIn = $request["OutreachEmailOptIn"];

      }


      if($VendorTypeId == "B") {
        $MAddress1 = $request["BMAddress1"];
      $MAddress2 = $request['BMAddress2'];
      $MCityId = $request['BMCityId'];
      $MZipcode = $request['BMZipcode1'];
      $MDistrictId = $request['BMDistrictId'];
      $MStateId = $request['BMStateId1'];
      $MCountryId = $request['BMCountryId'];
      $MStartDate = $request['BMStartDate'];
      $MEndDate = $request['BMEndDate'];


      $PAddress1 = $request["BPAddress1"];
      $PAddress2 = $request['BPAddress2'];
      $PCityId = $request['BPCityId'];
      $PZipcode = $request['BPZipcode'];
      $PDistrictId = $request['BPDistrictId'];
      $PStateId = $request['BPStateId'];
      $PCountryId = $request['BPCountryId'];
      $PStartDate = $request['BPStartDate'];
      $PEndDate = $request['BPEndDate'];





        }
        else {
          $MAddress1 = $request["IMAddress1"];
      $MAddress2 = $request['IMAddress2'];
      $MCityId = $request['IMCityId'];
      $MZipcode = $request['IMZipcode'];
      $MDistrictId = $request['IMDistrictId'];
      $MStateId = $request['IMStateId'];
      $MCountryId = $request['IMCountryId'];
      $MStartDate = $request['IMStartDate'];
      $MEndDate = $request['IMEndDate'];

      $PAddress1 = $request["IPAddress1"];
      $PAddress2 = $request['IPAddress2'];
      $PCityId = $request['IPCityId'];
      $PZipcode = $request['IPZipcode'];
      $PDistrictId = $request['IPDistrictId'];
      $PStateId = $request['IPStateId'];
      $PCountryId = $request['IPCountryId'];
      $PStartDate = $request['IPStartDate'];
      $PEndDate = $request['IPEndDate'];




        }

        $ContactName = $request['ContactName'];
      $BusinessPhone = $request['BusinessPhone'];
      $JobTitle = $request['JobTitle'];
      $BusinessEmail = $request['BusinessEmail'];
      $VendorContactActive = $request['VendorContactActive'];
      if($VendorContactActive== NULL){
        $VendorContactActive = 0;
      }
      $VendorContactPrimary = $request['VendorContactPrimary'];
      if($VendorContactPrimary== NULL){
        $VendorContactPrimary = 0;
      }


      if($VendorTypeId == "B") {
      $vendordata = array('VendorTypeId'=>$VendorTypeId,'LegalName'=>$LegalName,'TradeName'=>$TradeName,
      'EIN_SSN'=>$EIN_SSN,'DUNS'=>$DUNS,'BusinessSize'=>$BusinessSize,'BEClassificationId'=>"",'NAICSCodes'=>$NAICSCodes,'CommodityCodes'=>$CommodityCodes,
      'BusinessRegisteredInDistrict'=>$BusinessRegisteredInDistrict,'BusinessRegisteredInSCC'=>$BusinessRegisteredInSCC,
        'BusinessIsFranchisee'=>$BusinessIsFranchisee,'Website'=>$Website,'Phone'=>'','Email'=>'','OutreachEmailOptIn'=>$OutreachEmailOptIn,
        'UpdatedDate'=>date('Y-m-d'),'UpdatedUserId'=>$CreatedUserId,'VendorId'=>$VendorId,'AliasName'=>$AliasName,

        'AddressTypeId'=>"C",'StartDate'=>$StartDate,'EndDate'=>$EndDate,'Address1'=>$Address1,
        'Address2'=>$Address2,'StateId'=>$StateId,'DistrictId'=>$DistrictId,'CityId'=>$CityId,'Zipcode'=>$Zipcode,'CountryId'=>$CountryId,

        'MAddressTypeId'=>"M",'MStartDate'=>$MStartDate,'MEndDate'=>$MEndDate,'MAddress1'=>$MAddress1,
    'MAddress2'=>$MAddress2,'MStateId'=>$MStateId,'MDistrictId'=>$MDistrictId,'MCityId'=>$MCityId,
    'MZipcode'=>$MZipcode,'MCountryId'=>$MCountryId,'MCreatedDate'=>date('Y-m-d'),'MCreatedUserId'=>$CreatedUserId,
    'MUpdatedDate'=>date('Y-m-d'),'MUpdatedUserId'=>$CreatedUserId,

    'PAddressTypeId'=>"P",'PStartDate'=>$PStartDate,'PEndDate'=>$PEndDate,'PAddress1'=>$PAddress1,
    'PAddress2'=>$PAddress2,'PStateId'=>$PStateId,'PDistrictId'=>$PDistrictId,'PCityId'=>$PCityId,
    'PZipcode'=>$PZipcode,'PCountryId'=>$PCountryId,'PCreatedDate'=>date('Y-m-d'),'PCreatedUserId'=>$CreatedUserId,
    'PUpdatedDate'=>date('Y-m-d'),'PUpdatedUserId'=>$CreatedUserId,

 'ContactName'=>$ContactName,'BusinessPhone'=>$BusinessPhone,'BusinessEmail'=>$BusinessEmail,'VendorContactActive'=>$VendorContactActive,'VendorContactPrimary'=>$VendorContactPrimary,
'JobTitle'=>$JobTitle
 //,'Title'=>$Title
    //

     );
    }


    else {
        $vendordata = array('VendorTypeId'=>$VendorTypeId,'LegalName'=>$LegalName,'TradeName'=>$TradeName,'EIN_SSN'=>$EIN_SSN,
        'DUNS'=>'','BusinessSize'=>'','BEClassificationId'=>"",'NAICSCodes'=>"",
        'CommodityCodes'=>"", 'BusinessRegisteredInDistrict'=>"",'BusinessRegisteredInSCC'=>"",'BusinessIsFranchisee'=>'',
        'Website'=>'','Phone'=>$Phone,'Email'=>$Email,'OutreachEmailOptIn'=>$OutreachEmailOptIn,
        'UpdatedDate'=>date('Y-m-d'),'UpdatedUserId'=>$CreatedUserId,'VendorId'=>$VendorId,'AliasName'=>$AliasName,

        'AddressTypeId'=>"C",'StartDate'=>$StartDate,'EndDate'=>$EndDate,'Address1'=>$Address1,
        'Address2'=>$Address2,'StateId'=>$StateId,'DistrictId'=>$DistrictId,'CityId'=>$CityId,
        'Zipcode'=>$Zipcode,'CountryId'=>$CountryId,

        'MAddressTypeId'=>"M",'MStartDate'=>$MStartDate,'MEndDate'=>$MEndDate,'MAddress1'=>$MAddress1,
    'MAddress2'=>$MAddress2,'MStateId'=>$MStateId,'MDistrictId'=>$MDistrictId,'MCityId'=>$MCityId,
    'MZipcode'=>$MZipcode,'MCountryId'=>$MCountryId,'MCreatedDate'=>date('Y-m-d'),'MCreatedUserId'=>$CreatedUserId,
    'MUpdatedDate'=>date('Y-m-d'),'MUpdatedUserId'=>$CreatedUserId,

    'PAddressTypeId'=>"P",'PStartDate'=>$PStartDate,'PEndDate'=>$PEndDate,'PAddress1'=>$PAddress1,
    'PAddress2'=>$PAddress2,'PStateId'=>$PStateId,'PDistrictId'=>$PDistrictId,'PCityId'=>$PCityId,
    'PZipcode'=>$PZipcode,'PCountryId'=>$PCountryId,'PCreatedDate'=>date('Y-m-d'),'PCreatedUserId'=>$CreatedUserId,
    'PUpdatedDate'=>date('Y-m-d'),'PUpdatedUserId'=>$CreatedUserId,

    'ContactName'=>$ContactName,'BusinessPhone'=>$BusinessPhone,'BusinessEmail'=>$BusinessEmail,'VendorContactActive'=>$VendorContactActive,'VendorContactPrimary'=>$VendorContactPrimary,
'JobTitle'=>$JobTitle
     );
    }

var_dump($vendordata);
    //  $vendordata1 = array('VendorId'=>$VendorId,'AddressTypeId'=>"C",'StartDate'=>$StartDate,'EndDate'=>$EndDate,'Address1'=>$Address1,
    //     'Address2'=>$Address2,'StateId'=>$StateId,'DistrictId'=>$DistrictId,'CityId'=>$CityId,'Zipcode'=>$Zipcode,'CountryId'=>$CountryId
    //  );



    //   $result = $this->vendor_model->updatevendorDetails($vendordata);
    //   //var_dump($result);
    //   $data['success'] = $result;


    // $this->response('', 404, 'fail', $request["FirstName"]);

//     $vendordata1 = array('VendorId'=>$VendorId,'AddressTypeId'=>"M",'StartDate'=>$MStartDate,'EndDate'=>$MEndDate,'Address1'=>$MAddress1,
//     'Address2'=>$MAddress2,'StateId'=>$MStateId,'DistrictId'=>$MDistrictId,'CityId'=>$MCityId,'Zipcode'=>$MZipcode,'CountryId'=>$MCountryId,
//     'MCreatedDate'=>date('Y-m-d'),'MCreatedUserId'=>$CreatedUserId,'MUpdatedDate'=>date('Y-m-d'),'MCreatedUserId'=>$CreatedUserId,
//     'AddressTypeId'=>"P",'StartDate'=>$PStartDate,'EndDate'=>$PEndDate,'Address1'=>$PAddress1,
//     'Address2'=>$PAddress2,'StateId'=>$PStateId,'DistrictId'=>$PDistrictId,'CityId'=>$PCityId,'Zipcode'=>$PZipcode,'CountryId'=>$PCountryId,
//    'MCreatedDate'=>date('Y-m-d'),'MCreatedUserId'=>$CreatedUserId,'MUpdatedDate'=>date('Y-m-d'),'MCreatedUserId'=>$CreatedUserId
//  );

    $result = $this->vendor_model->updatevendorDetails($vendordata);
//       //var_dump($result);
      $data['success'] = $result;



    // $result = $this->vendor_model->updatevendorDetails($vendordata1);

}



public function GetVendorContactById_get()
{
    $VendorId=$_GET['VendorId'];
    $VendorContactPrimary=$_GET['VendorContactPrimary'];
    $data['SingleVendorContactDetails']=$this->vendor_model->GetVendorContactById($VendorId,$VendorContactPrimary);
    // if($VendorId == 0) {
    //     $this->response(array($data));
    // }
    // else {
        $this->response($data);
    // }


}


public function AddVendorContact_post(){

    $json = file_get_contents('php://input');
    $request = json_decode($json,true);
    // $vendorMgmt = $request->vendorMgmt;
    var_dump("test");
    // var_dump($request);
    $AddtionalName = $request["AddtionalName"];
    $AddtionalTitle = $request["AddtionalTitle"];
    $AddtionalBusinessMail = $request["AddtionalBusinessMail"];
    $AddtionalBusinessPhone = $request["AddtionalBusinessPhone"];
    $AddtionalContactActive = $request["AddtionalContactActive"];
    if($AddtionalContactActive == NULL){
        $AddtionalContactActive = 0;
    }
    $VendorIdContact = $request["VendorIdContact"];
    // $VendorId = $request["VendorId"];

    $vendorContact = array('VendorId'=>$VendorIdContact,'ContactName'=>$AddtionalName,'Phone'=>$AddtionalBusinessPhone,
      'Email'=>$AddtionalBusinessMail,'VendorContactActive'=>$AddtionalContactActive,'VendorContactPrimary'=>0,'JobTitle'=>$AddtionalTitle);

      $result = $this->vendor_model->insertVendorContact($vendorContact);
    //   //       //var_dump($result);
            $data['success'] = $result;
}
public function UpdateVendorContact_post(){
$json = file_get_contents('php://input');
    $request = json_decode($json,true);
    $VendorId = $request["VendorId"];
    $ContactId = $request["ContactId"];
    $JobTitle=$request["JobTitle"];
    $Phone=$request["Phone"];
    $Email= $request["Email"];
    $VendorContactActive=$request["VendorContactActive"];
    $VendorContactPrimay=$request["VendorContactPrimary"];
    $ContactName=$request["ContactName"];
    $vendorcontact=array('VendorId'=>$VendorId,'ContactName'=>$ContactName,'JobTitle'=>$JobTitle,
    'Phone'=>$Phone,'Email'=>$Email,'VendorContactActive'=>$VendorContactActive,
    'VendorContactPrimay'=>$VendorContactPrimay,'ContactId'=>$ContactId);

    $result = $this->vendor_model->UpdateVendorContact($vendorcontact);
      $data = [
       'ErrorCode' => $result
      ];

$this->response($data);

}


public function DeleteVendorContact_post() {
    $json = file_get_contents('php://input');
    // $Newcontact2 = json_encode($Newcontact1,true);
        //  var_dump($Newcontact2);

    $request = json_decode($json,true);
    // var_dump($request["ContactId"]);

    $data = array('VendorId'=>$request["VendorId"],'ContactId'=>$request["ContactId"]);

      $result = $this->vendor_model->DeleteVendorContact($data);
}

public function UpdVendorNew_post() {
// var_dump("hi");
$json = file_get_contents('php://input');
    $request = json_decode($json,true);
    // var_dump($request);



    $VendorId = $request["VendorId"];
    $VendorTypeId = $request["VendorTypeId"];
    if($VendorTypeId == ""){
        $VendorTypeId = "B";
    }


    $NAICSCodes = $request["NAICSCodes"];
    $BusinessRegisteredInDistrict = $request["BusinessRegisteredInDistrict"];
    if($BusinessRegisteredInDistrict = ""){
        $BusinessRegisteredInDistrict = false;
    }
    $BusinessIsFranchisee = $request["BusinessIsFranchisee"];
    if($BusinessIsFranchisee = ""){
        $BusinessIsFranchisee = false;
    }
    $DUNS = $request["DUNS"];
    $CommodityCodes = $request["CommodityCodes"];
    $Website = $request["Website"];
    $BusinessRegisteredInSCC = $request["BusinessRegisteredInSCC"];
    if($BusinessRegisteredInSCC = ""){
        $BusinessRegisteredInSCC = false;
    }
    $ContactName = $request["ContactName"];
    $JobTitle = $request["JobTitle"];
    $VendorContactPrimary = $request["VendorContactPrimary"];
    $VendorContactActive = $request["VendorContactActive"];
    $Phone = $request["Phone"];
    $Email = $request["Email"];
    // $BusinessEmail = $request["BusinessEmail"];
    // $BusinessPhone = $request["BusinessPhone"];
    $CreatedUserId = $request["CreatedUserId"];
    $BusinessSize = $request["BusinessSize"];




    $Address = json_encode($request["Address"],true);

    $AddressFinal = json_decode($Address,true);
    // var_dump($AddressFinal);

   foreach ($AddressFinal as $obj)

   {
    $address_type = $obj["address_type"];
    var_dump($address_type["AddressTypeId"]);

       $data2 = array('VendorId' => $request["VendorId"],'AddressTypeId'=>$obj["AddressTypeId"],'StartDate'=>$obj["StartDate"],'EndDate'=>$obj["EndDate"],'Address1'=>$obj["Address1"],
       'Address2'=>$obj["Address1"],'StateId'=>$obj["StateId"],'DistrictId'=>$obj["DistrictId"],'CityId'=>$obj["CityId"],'Zipcode'=>$obj["Zipcode"],'CountryId'=>$obj["CountryId"],
       'CreatedDate'=>date('Y-m-d'),'CreatedUserId'=>$CreatedUserId,
    'UpdatedDate'=>date('Y-m-d'),'UpdatedUserId'=>$CreatedUserId,
   );

       $result = $this->vendor_model->AddVendorAddress($data2);


      }



    if($VendorTypeId == "B") {
         $LegalName = $request["LegalName"];
        //  if($LegalName == NULL){
        //     $LegalName = "";
        //  }
         $TradeName = $request["TradeName"];
         $AliasName = $request["AliasName"];
         $EIN_SSN = $request["EIN_SSN"];

        //  var_dump("before>>>$EIN_SSN");
         //$EIN_SSN = str_replace("-","",$EIN_SSN);
        //  var_dump("after>>>$EIN_SSN");

         $OutreachEmailOptIn = false;
         $Newcontact = $request["Newcontact"];


        //  $Newcontact = json_decode($json,true);
         $Newcontact1 = json_encode($request["Newcontact"],true);

         $Newcontact2 = json_decode($Newcontact1,true);
        //  var_dump($Newcontact2);
         foreach ($Newcontact2 as $object)

{
//     $jobtitle = $object["JobTitle"];

// $object["AddtionalContactActive"] = 1;



// if($object["ContactId"] == 0){

    var_dump("if");

    $object["AddtionalContactActive"] = 1;
    // $object["ContactId"] = 23;

    $data2 = array('VendorId' => $request["VendorId"], 'FirstName' => $object["FirstName"],'BusinessPhone' => $object["Phone"],
'BusinessEmail' => $object["Email"], 'VendorContactActive' => 1, 'VendorContactPrimary' => $object["VendorContactPrimary"], 'JobTitle' => $object["JobTitleId"]
,'CreatedDate' => date('Y-m-d'),'CreatedUserId' => $CreatedUserId,'UpdatedDate' => date('Y-m-d'),'UpdatedUserId' => $CreatedUserId
,'LastName' => $object["LastName"],
'MiddleName' => $object["MiddleName"],'ContactId' => $object["ContactId"]
);

    $result = $this->vendor_model->AddMultiVendorContact($data2);
// }
// else {
//     var_dump("else");

//     $data3 = array('VendorId' => $request["VendorId"], 'FirstName' => $object["AddtionalName"], 'JobTitle' => $object["AddtionalTitle"], 'BusinessPhone' => $object["AddtionalBusinessPhone"],
// 'BusinessEmail' => $object["AddtionalBusinessMail"], 'VendorContactActive' => $object["AddtionalContactActive"], 'VendorContactPrimary' => 0, 'ContactId' => $object["ContactId"]
// ,'UpdatedDate' => date('Y-m-d'),'UpdatedUserId' => $CreatedUserId,'LastName' => $object["lastname"],
// 'MiddleName' => $object["middlename"]
// );

//     $result = $this->vendor_model->UpdateMultiVendorContact($data3);
// }

   }





     }
    else {

        $TradeName = $request["LastName"];
        $LegalName = $request["FirstName"];
        $AliasName = $request["MiddleName"];
        $EIN_SSN = $request["EIN_SSN"];

        //  var_dump("after>>>$EIN_SSN");

        //  var_dump("before>>>$EIN_SSN");
         $EIN_SSN = str_replace("-","",$EIN_SSN);
        //  var_dump("after>>>$EIN_SSN");
        $OutreachEmailOptIn = $request["OutreachEmailOptIn"];

      }




         if($VendorTypeId == "B") {
            $vendordata = array('VendorTypeId'=>$VendorTypeId,'LegalName'=>$LegalName,'TradeName'=>$TradeName,
            'EIN_SSN'=>$EIN_SSN,'DUNS'=>$DUNS,'BusinessSize'=>$BusinessSize,'BEClassificationId'=>"",'NAICSCodes'=>$NAICSCodes,'CommodityCodes'=>$CommodityCodes,
            'BusinessRegisteredInDistrict'=>$BusinessRegisteredInDistrict,'BusinessRegisteredInSCC'=>$BusinessRegisteredInSCC,
              'BusinessIsFranchisee'=>$BusinessIsFranchisee,'Website'=>$Website,'Phone'=>'','Email'=>'','OutreachEmailOptIn'=>$OutreachEmailOptIn,
              'UpdatedDate'=>date('Y-m-d'),'UpdatedUserId'=>$CreatedUserId,'VendorId'=>$VendorId,'AliasName'=>$AliasName,



           );
          }


          else {
              $vendordata = array('VendorTypeId'=>$VendorTypeId,'LegalName'=>$LegalName,'TradeName'=>$TradeName,'EIN_SSN'=>$EIN_SSN,
              'DUNS'=>'','BusinessSize'=>'','BEClassificationId'=>"",'NAICSCodes'=>"",
              'CommodityCodes'=>"", 'BusinessRegisteredInDistrict'=>"",'BusinessRegisteredInSCC'=>"",'BusinessIsFranchisee'=>'',
              'Website'=>'','Phone'=>$Phone,'Email'=>$Email,'OutreachEmailOptIn'=>$OutreachEmailOptIn,
              'UpdatedDate'=>date('Y-m-d'),'UpdatedUserId'=>$CreatedUserId,'VendorId'=>$VendorId,'AliasName'=>$AliasName,


           );
          }

    //   var_dump($vendordata);

      $result = $this->vendor_model->updatevendorDetailsNew($vendordata);
//       //var_dump($result);
      $data['success'] = $result;
}

}

