<?php

//error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('gd.jpeg_ignore_warning', true);
require_once '../include/DbHandler.php';
require_once '../include/PassHash.php';
require '../lib/Slim/Slim.php';
require_once '../include/languages.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;
$language_id = NULL;
$education_id = NULL;
$salary_id = NULL;
$state_id=NULL;
date_default_timezone_set('Asia/Kolkata');

/**
 * Language List
 * url - /language_list
 * method - POST
 * params - NO 
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/language_list', function() use ($app) {
    $db = new DbHandler();
    $res = $db->language_list();
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Language List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Mobile Authenticate
 * url - /mobile_authenticate
 * method - POST
 * params - mobile(mandatory)
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/mobile_authenticate', function() use ($app) {
    global $config;
    verifyRequiredParams(array('mobile'));
    $mobile = $app->request()->post('mobile');
    $language_id = $app->request->post('language_id') ? $app->request->post('language_id') : 1;
    $response = array();
    $db = new DbHandler();
    $res = $db->mobile_authenticate($mobile);
    if ($res == 'INVALID') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Invalid_Mobile_Number'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 2;
        $response["error"] = true;
        $response["message"] = @$config['Unable_to_proceed_your_request'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'ALREADY_REGISTERED') {
        $response["code"] = 3;
        $response["error"] = true;
        $response["message"] = @$config['This_mobile_number_is_already_registered'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['OTP_Sent'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});



/**
 * Mobile Verification
 * url - /mobile_verification
 * method - POST
 * params - mobile(mandatory),otp(required)
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/mobile_verification', function() use ($app) {
    global $config;
    verifyRequiredParams(array('mobile', 'otp'));
    $mobile = $app->request()->post('mobile');
    $otp = $app->request()->post('otp');
    $language_id = $app->request->post('language_id') ? $app->request->post('language_id') : 1;
    $response = array();
    $db = new DbHandler();
    $res = $db->mobile_verification($mobile, $otp);
    if ($res == 'INVALID') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Invalid_Mobile_Number'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 2;
        $response["error"] = true;
        $response["message"] = @$config['Unable_to_proceed_your_request'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'ALREADY_REGISTERED') {
        $response["code"] = 3;
        $response["error"] = true;
        $response["message"] = @$config['This_mobile_number_is_already_registered'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'NORECORD') {
        $response["code"] = 4;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'EXPIRED') {
        $response["code"] = 5;
        $response["error"] = true;
        $response["message"] = @$config['OTP_Expired_Please_send_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'ALREADY_VERIFIED') {
        $response["code"] = 6;
        $response["error"] = true;
        $response["message"] = @$config['Mobile_number_already_verified'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Mobile_Number_verified'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});

/**
 * url -  http://www.blahworks.in/jobsite/v1/applicant_registration
 * method � POST
 * params � registered_mobile[required], first_name [Required], middle_name [optional], last_name [optional], gender [Required]{1=>male,0=>female},
  date_of_birth [Required]{Format=>YYYY-MM-DD  Example->2018-01-13},language_id [Required]

 */
$app->post('/applicant_registration', function () use ($app) {
    global $config;
    //Verifying the required parameters
    verifyRequiredParams(array('first_name', 'registered_mobile', 'gender', 'date_of_birth', 'language_id'));

    //Creating a response array
    $response = array();

    //reading post parameters
    $first_name = $app->request->post('first_name');
    $registered_mobile = $app->request->post('registered_mobile');
    $gender = $app->request->post('gender') ? $app->request->post('gender') : 0;
    $date_of_birth = $app->request->post('date_of_birth');
    $language_id = $app->request->post('language_id') ? $app->request->post('language_id') : 1;
    $middle_name = $app->request->post('middle_name');
    $last_name = $app->request->post('last_name');
    $state_id = $app->request->post('state_id');
    $db = new DbHandler();
    //Calling the method createStudent to add student to the database
    $res = $db->applicant_registration($first_name, $registered_mobile, $gender, $date_of_birth, $language_id, $middle_name, $last_name, $state_id);
    if ($res == 'INVALID') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Invalid_Mobile_Number'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 2;
        $response["error"] = true;
        $response["message"] = @$config['Unable_to_proceed_your_request'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else if ($res == 'ALREADY_REGISTERED') {
        $response["code"] = 3;
        $response["error"] = true;
        $response["message"] = @$config['This_mobile_number_is_already_registered'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else if ($res == 'UNAUTH_NUMBER') {
        $response["code"] = 4;
        $response["error"] = true;
        $response["message"] = @$config['Mobile_number_not_verified'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] =@$config['Applicant_registered_successfully'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Education List
 * url - /education_list
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/education_list', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $res = $db->education_list($language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Education_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * job category list

 * url - /job_category_list

 * Header  params �mobile (Required),mobile (Required)
 * params education_id

 */
$app->get('/job_category_list/:education_id', 'authenticate', function($education_id) use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $res = $db->job_category_list($language_id, $user_id, $education_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Job_Category_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * Training Category List
 * url - /training_category_list
 * method � GET
 * Header  params �mobile (Required),mobile (Required)
 * params �education_id
 */
$app->get('/training_category_list/:education_id', 'authenticate', function($education_id) use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $res = $db->training_category_list($user_id, $language_id, $education_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Training_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * State List
 * url - /state_list
 * method - GET
 * params - language_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/state_list/:language_id', function($language_id) use ($app) {
    $db = new DbHandler();
    global $config;
    $res = $db->state_list($language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['State_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * District List
 * url - /district_list
 * method - GET
 * params - language_id,state_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/district_list/:language_id/:state_id', function($language_id, $state_id) use ($app) {
    $db = new DbHandler();
    global $config;
    $res = $db->district_list($language_id, $state_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['District_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});





/**
 * Change Password
 * url - /change_password
 * method - POST
 * params - oldpassword(mandatory),newpassword(mandatory)
 * header Params - mobile(mandatory), password (mandatory)
 */
$app->post('/change_password', 'authenticate', function() use ($app) {
    global $user_id;
    //verifyRequiredParams(array('password'));
    verifyRequiredParams(array('oldpassword', 'newpassword'));
    $oldpassword = $app->request()->post('oldpassword');
    $newpassword = $app->request()->post('newpassword');
    $response = array();
    $db = new DbHandler();
    $res = $db->change_password($user_id, $oldpassword, $newpassword);
    if ($res == 'INVALID_USER_ACCESS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Invalid User access";
        echoRespnse(200, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Unable to proceed your request";
        echoRespnse(200, $response);
    } else if ($res == 'INVALID_OLD_PASSWORD') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Invalid old password";
        echoRespnse(200, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Password changed successfully";
        echoRespnse(201, $response);
    }
});


/**
 * Save interesr
 * url - /save_interest
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params 
 */
$app->post('/save_interest', 'authenticate', function() use ($app) {
    global $user_id, $config, $language_id;
    //Verifying the required parameters
    verifyRequiredParams(array('education_id'));
    $response = array();
    $education_id = $app->request->post('education_id');
//    $job_category_id1 = $app->request->post('job_category_id1');
//    $job_category_id2 = $app->request->post('job_category_id2');
//    $training_id = $app->request->post('training_id');

    $db = new DbHandler();
    $res = $db->save_interest($user_id, $education_id);

    $response["code"] = 0;
    $response["error"] = false;
    $response["message"] = @$config['Education_successfully_updated'][$language_id];
    $response["data"] = "";
    echoRespnse(200, $response);
});




/**
 * Applicant Home
 * url - /applicant_home
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/applicant_home', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $education_id, $salary_id, $config,$state_id;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $res = $db->applicant_home($language_id, $user_id, $education_id, $salary_id,$state_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Applicant_Home'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Applicant Info
 * url - /applicant_info
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/applicant_info', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $res = $db->applicant_info($user_id, $language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Applicant_Information'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Applicant States
 * url - /applicant_states
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/applicant_states', 'authenticate', function() use ($app) {
    global $user_id, $language_id;
    $language_id = $language_id ? $language_id : 1;
    $response = array();
    $db = new DbHandler();
    $res = $db->applicant_states($user_id, $language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Applicant State List";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 *  applicant add state
 * url - /applicant_add_state
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-state_id
 */
$app->post('/applicant_add_state', 'authenticate', function() use ($app) {
    global $user_id;
    //Verifying the required parameters
    verifyRequiredParams(array('state_id'));
    $response = array();
    $state_id = $app->request->post('state_id');
    $db = new DbHandler();
    $res = $db->applicant_add_state($user_id, $state_id);
    if ($res == 'AlREADY_EXISTS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "This state already added by you";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else if ($res == 'LIMIT_REACHED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Sorry you can add maximum five states";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "State Added Successfully";
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});


/**
 * Applicant remove state
 * url - /applicant_remove_state
 * method - GET
 * params - state_id [Required]
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/applicant_remove_state/:state_id', 'authenticate', function($state_id) use ($app) {
    $db = new DbHandler();
    global $user_id;
    $res = $db->applicant_remove_state($user_id, $state_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else if ($res == 'CANNOT_DELETE') {
        $response["code"] = 2;
        $response["error"] = true;
        $response["message"] = "You can not remove your home state";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "State removed successfully";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * Applicant job Category
 * url - /applicant_job_category
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/applicant_job_category(/:page_type)', 'authenticate', function($page_type = 0) use ($app) {
    global $user_id, $language_id, $education_id, $salary_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $response = array();
    $db = new DbHandler();
    //$page_type=0;//1=>For apply job from home,0=>Applicant Job Category
    $res = $db->applicant_job_category($user_id, $language_id, $education_id, $page_type, $salary_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Applicant_Job_Category'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 *  applicant add job category
 * url - /applicant_add_job_category
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-job_category_id
 */
$app->post('/applicant_add_job_category', 'authenticate', function() use ($app) {
    global $user_id;
    //Verifying the required parameters
    verifyRequiredParams(array('job_category_id'));
    $response = array();
    $job_category_id = $app->request->post('job_category_id');
    $db = new DbHandler();
    $res = $db->applicant_add_job_category($user_id, $job_category_id);
    if ($res == 'AlREADY_EXISTS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "This job category already added by you";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else if ($res == 'LIMIT_REACHED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Sorry you can add maximum five job category";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Job Category Added Successfully";
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});



/**
 * Applicant remove job category
 * url - /applicant_remove_job_category
 * method - GET
 * params - job_category_id [Required]
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/applicant_remove_job_category/:job_category_id', 'authenticate', function($job_category_id) use ($app) {
    $db = new DbHandler();
    global $user_id;
    $res = $db->applicant_remove_job_category($user_id, $job_category_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "No record available";
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Job Category removed successfully";
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Technical Course List
 * url - /technical_courses
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/technical_courses', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $response = array();
    $db = new DbHandler();
    $res = $db->technical_courses($language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Technical_Courses_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 *  applicant update name
 * url - /applicant_update_name
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-first_name [Required],middle_name [Optional],last_name [optional]
 */
$app->post('/applicant_update_name', 'authenticate', function() use ($app) {
    global $user_id, $config, $language_id;
    //Verifying the required parameters
    verifyRequiredParams(array('first_name'));
    $response = array();
    $first_name = $app->request->post('first_name');
    $middle_name = $app->request->post('middle_name');
    $last_name = $app->request->post('last_name');

    $db = new DbHandler();
    $res = $db->applicant_update_name($user_id, $first_name, $middle_name, $last_name);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Name_updated_Successfully'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});


/**
 *  applicant education details
 * url - /update_education_details
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-education_id [Required],technical_course_id [Optional]
 */
$app->post('/update_education_details', 'authenticate', function() use ($app) {
    global $user_id, $config, $language_id;
    //Verifying the required parameters
    verifyRequiredParams(array('education_id'));
    $response = array();
    $education_id = $app->request->post('education_id');
    $technical_course_id = $app->request->post('course_id');


    $db = new DbHandler();
    $res = $db->update_education_details($user_id, $education_id, $technical_course_id);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Education_details_updated_Successfully'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});





/**
 *  applicant language
 * url - /update_applicant_language
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-language_id [Required]
 */
$app->post('/update_applicant_language', 'authenticate', function() use ($app) {
    global $user_id, $config;
    //Verifying the required parameters
    verifyRequiredParams(array('language_id'));
    $response = array();
    $language_id = $app->request->post('language_id');
    $language_id = $language_id ? $language_id : 1;
    $db = new DbHandler();
    $res = $db->update_applicant_language($user_id, $language_id);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Language_updated_Successfully'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});


/**
 * applicant update language
 * url - /update_languages
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-language_id1 [Required],language_id2 [Optional]
 */
$app->post('/update_languages', 'authenticate', function() use ($app) {
    global $user_id;
    //Verifying the required parameters
    verifyRequiredParams(array('language_id1'));
    $response = array();
    $language_id1 = $app->request->post('language_id1');
    $language_id2 = $app->request->post('language_id2');


    $db = new DbHandler();
    $res = $db->update_languages($user_id, $language_id1, $language_id2);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Sorry, Some Issue occurred";
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Language updated Successfully";
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});



/**
 * applicant update profile
 * url - /update_profile
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-first_name [Required],middle_name [Optional],last_name [optional]
 */
$app->post('/update_profile', 'authenticate', function() use ($app) {
    global $user_id;
    //Verifying the required parameters
    verifyRequiredParams(array('first_name'));
    $response = array();
    $first_name = $app->request->post('first_name');
    $middle_name = $app->request->post('middle_name');
    $last_name = $app->request->post('last_name');

    $gender = $app->request->post('gender');
    $date_of_birth = $app->request->post('date_of_birth');
    $aadhar_number = $app->request->post('aadhar_number');



    $db = new DbHandler();
    $res = $db->update_profile($user_id, $first_name, $middle_name, $last_name, $gender, $date_of_birth, $aadhar_number);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Sorry, Some Issue occurred";
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Personal details updated Successfully";
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});


/**
 * Block List
 * url - /block_list
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 * params - district_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/block_list/:district_id', 'authenticate', function($district_id) use ($app) {
    $db = new DbHandler();
    global $language_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $res = $db->block_list($language_id, $district_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Panchayat_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Panchayat List
 * url - /panchayat_list
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 * params - block_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/panchayat_list/:block_id', 'authenticate', function($block_id) use ($app) {
    $db = new DbHandler();
    global $language_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $res = $db->panchayat_list($language_id, $block_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Panchayat_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});









/**
 * applicant update address
 * url - /update_address
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-state_id [Required],district_id [Required],block_id [optional],village_name [Required],house_number [optional],pin_code [Required]
 */
$app->post('/update_address', 'authenticate', function() use ($app) {
    global $user_id;
    //Verifying the required parameters
    verifyRequiredParams(array('state_id', 'district_id', 'village_name', 'pin_code'));
    $response = array();
    $state_id = $app->request->post('state_id');
    $district_id = $app->request->post('district_id');
    $block_id = $app->request->post('block_id');

    $village_name = $app->request->post('village_name');
    $house_number = $app->request->post('house_number');
    $pin_code = $app->request->post('pin_code');



    $db = new DbHandler();
    $res = $db->update_address($user_id, $state_id, $district_id, $block_id, $village_name, $house_number, $pin_code);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Sorry, Some Issue occurred";
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Address updated Successfully";
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});




/**
 * applicant update full profile
 * url - /update_full_profile
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-first_name [Required],middle_name [Optional],last_name [optional],state_id [Required],district_id [Required],block_id [optional],village_name [Required],house_number [optional],pin_code [Required]
 */
$app->post('/update_full_profile', 'authenticate', function() use ($app) {
    global $user_id, $config, $language_id;
    //Verifying the required parameters
    verifyRequiredParams(array('first_name', 'state_id', 'district_id','pin_code', 'father_name'));
    $response = array();

    $first_name = $app->request->post('first_name');
    $middle_name = $app->request->post('middle_name');
    $last_name = $app->request->post('last_name');

    $gender = $app->request->post('gender');
    $date_of_birth = $app->request->post('date_of_birth');
    $aadhar_number = $app->request->post('aadhar_number');


    $state_id = $app->request->post('state_id');
    $district_id = $app->request->post('district_id');
    $block_id = $app->request->post('block_id');

    $village_name = $app->request->post('village_name');
    $house_number = $app->request->post('house_number');
    $pin_code = $app->request->post('pin_code');

    $language_id1 = $app->request->post('language_id1');
    $language_id2 = $app->request->post('language_id2');
    $proficiency_level_id1 = $app->request->post('proficiency_level_id1');
    $proficiency_level_id2 = $app->request->post('proficiency_level_id2');

    $education_id = $app->request->post('education_id');
    $technical_course_id = $app->request->post('technical_course_id');
    $work_experience = $app->request->post('work_experience') ? $app->request->post('work_experience') : 0;
    $willing_to_relocate = $app->request->post('willing_to_relocate') ? $app->request->post('willing_to_relocate') : 0;
    $cast_category = $app->request->post('cast_category');


    $father_name = $app->request->post('father_name');
    $panchayat_id = @$app->request->post('panchayat_id');


    $db = new DbHandler();
    $res = $db->update_full_profile($user_id, $first_name, $middle_name, $last_name, $gender, $date_of_birth, $aadhar_number, $state_id, $district_id, $block_id, $village_name, $house_number, $pin_code, $language_id1, $language_id2, $proficiency_level_id1, $proficiency_level_id2, $education_id, $technical_course_id, $work_experience, $willing_to_relocate, $cast_category, $father_name, $panchayat_id);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Profile_updated_Successfully'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});



/**
 * language proficiency levels
 * url - /language_proficiency_levels
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 * params -  
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/language_proficiency_levels', 'authenticate', function() use ($app) {
    $db = new DbHandler();
    global $language_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $res = $db->language_proficiency_levels($language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Language_Proficiency_level_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Job List
 * url - /jobs_list
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - job_category_id,page 
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/jobs_list', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $education_id, $salary_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    verifyRequiredParams(array('job_category_id'));
    $job_category_id = $app->request->post('job_category_id');
    $page = $app->request->post('page') ? $app->request->post('page') : 1;


    $res = $db->jobs_list($user_id, $language_id, $job_category_id, $education_id, $page, $salary_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Jobs_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * apply job
 * url - /apply_job
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - job_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/apply_job', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    verifyRequiredParams(array('job_id'));
    $job_id = $app->request->post('job_id');
    $res = $db->apply_job($language_id, $job_id, $user_id);
    if ($res == 'ALREADY_APPLIED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['You_have_already_applied_this_job'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Jobs_applied_successfully'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Applicant Training Category
 * url - /applicant_training_category
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/applicant_training_category(/:page_type)', 'authenticate', function($page_type = 0) use ($app) {
    global $user_id, $language_id, $education_id, $config,$state_id;
    $language_id = $language_id ? $language_id : 1;
    $response = array();
    $db = new DbHandler();
    //$page_type=0;//1=>For apply job from home,0=>Applicant Job Category
    $res = $db->applicant_training_category($user_id, $language_id, $education_id, $page_type,$state_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Applicant_Training_Category'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 *  applicant add Training category
 * url - /applicant_add_training_category
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-training_category_id
 */
$app->post('/applicant_add_training_category', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    //Verifying the required parameters
    verifyRequiredParams(array('training_category_id'));
    $response = array();
    $training_category_id = $app->request->post('training_category_id');
    $db = new DbHandler();
    $res = $db->applicant_add_training_category($user_id, $training_category_id);
    if ($res == 'AlREADY_EXISTS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['This_Training_category_already_added_by_you'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'LIMIT_REACHED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Sorry_you_can_add_maximum_five_Training_category'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Training_Category_Added_Successfully'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});



/**
 * Applicant remove Training category
 * url - /applicant_remove_training_category
 * method - GET
 * params - training_category_id [Required]
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/applicant_remove_training_category/:training_category_id', 'authenticate', function($training_category_id) use ($app) {
    $db = new DbHandler();
    global $user_id, $language_id, $config;
    $res = $db->applicant_remove_training_category($user_id, $training_category_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Training_Category_removed_successfully'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * Training List
 * url - /trainings_list
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - training_category_id,page 
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/trainings_list', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $education_id, $config,$state_id;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    verifyRequiredParams(array('training_category_id'));
    $training_category_id = $app->request->post('training_category_id');
    $page = $app->request->post('page') ? $app->request->post('page') : 1;


    $res = $db->trainings_list($user_id, $language_id, $training_category_id, $education_id, $page,$state_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Training_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * All Training List
 * url - /all_trainings_list
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - page 
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/all_trainings_list', 'authenticate', function() use ($app) {
    global $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $page = $app->request->post('page') ? $app->request->post('page') : 1;


    $res = $db->all_trainings_list($language_id, $page);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Training_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * apply training
 * url - /apply_job
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - training_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/apply_training', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    verifyRequiredParams(array('training_id'));
    $training_id = $app->request->post('training_id');
    $res = $db->apply_training($language_id, $training_id, $user_id);
    if ($res == 'ALREADY_APPLIED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['You_have_already_applied_this_training'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Training_applied_successfully'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});


/**
 * notification_list
 * url - /notification_list
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params -  
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/notification_list', 'authenticate', function() use ($app) {
    global $language_id, $user_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $page = $app->request->post('page') ? $app->request->post('page') : 1;
    $res = $db->notification_list($user_id, $page);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['NOTIFICATION_LIST'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});





/**
 *  applicant update profile image
 * url - /update_profile_image
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-profile_image in file
 */
$app->post('/update_profile_image', 'authenticate', function() use ($app) {
    
    global $user_id, $language_id, $config;
    $db = new DbHandler();
    $res = $db->update_profile_image($user_id);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'NO_FILE') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Please_select_profile_image'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Profile_image_updated_Successfully'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * Applicant Bio Data
 * url - /biodata
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/biodata', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $id = base64_encode(base64_encode($user_id));
    $res = APIURL . "biodata/" . $id;
    $response["code"] = 0;
    $response["error"] = false;
    $response["message"] = @$config['Bio_Data_URL'][$language_id];
    $response["data"] = $res;
    echoRespnse(200, $response);
});



/**
 * Experience List
 * url - /experience_list
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/experience_list', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $response = array();
    $db = new DbHandler();
    $res = $db->experience_list($language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Experience_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});




/**
 * Salary List
 * url - /salary_list
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 */
$app->get('/salary_list', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $language_id = $language_id ? $language_id : 1;
    $response = array();
    $db = new DbHandler();
    $res = $db->salary_list($language_id);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Salary_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * employment_program_list
 * url - /employment_program_list
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params -  page
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/employment_program_list', 'authenticate', function() use ($app) {
    global $language_id, $user_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $page = $app->request->post('page') ? $app->request->post('page') : 1;


    $res = $db->employment_program_list($user_id, $language_id, $page);
    if ($res == 'NO_RECORDS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['NO_RECORDS'][$language_id];
        $response["data"] = (object) array();
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Employment_Program_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * apply employment program
 * url - /apply_employment_program
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - employment_program_id 
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/apply_employment_program', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    verifyRequiredParams(array('employment_program_id'));
    $employment_program_id = $app->request->post('employment_program_id');
    $res = $db->apply_employment_program($language_id, $employment_program_id, $user_id);
    if ($res == 'ALREADY_APPLIED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['You_have_already_applied_this_Employment_program'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Employment_Program_applied_successfully'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});



/**
 * get filter masters
 * url - /get_filters
 * method - GET
 * header Params - mobile (mandatory), password (mandatory)
 * params -  
 * Created By- Rajesh Kumar->8130023094
 */
$app->get('/get_filters', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $salary_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;
    $res = $db->get_filters($language_id, $user_id, $salary_id);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Filter_List'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});

/**
 * apply filter
 * url - /apply_filters
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params - states [jason array=>[1,2,3]],job_categories [json array=>[1,2,3]],salary_id  
 * Created By- Rajesh Kumar->8130023094
 */
$app->post('/apply_filters', 'authenticate', function() use ($app) {
    global $user_id, $language_id, $config;
    $response = array();
    $db = new DbHandler();
    $language_id = $language_id ? $language_id : 1;

    $states = json_decode($app->request->post('states'));
    $job_categories = json_decode($app->request->post('job_categories'));
    $salary_id = $app->request->post('salary_id');
    $res = $db->apply_filters($language_id, $user_id, $states, $job_categories, $salary_id);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'SLIMIT_REACHED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Maximum_five_state_can_be_selected'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else if ($res == 'JLIMIT_REACHED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Maximum_five_job_category_can_be_selected'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['FILTER_APPLIED_SUCCESS'][$language_id];
        $response["data"] = $res;
        echoRespnse(200, $response);
    }
});





/**
 *  applicant update mobile
 * url - /applicant_update_mobile
 * method - POST
 * header Params - mobile (mandatory), password (mandatory)
 * params-mobile [Required]
 */
$app->post('/applicant_update_mobile', 'authenticate', function() use ($app) {
    global $user_id, $config, $language_id;
    //Verifying the required parameters
    verifyRequiredParams(array('mobile'));
    $response = array();
    $mobile = $app->request->post('mobile');
    
    $db = new DbHandler();
    $res = $db->applicant_update_mobile($user_id, $mobile);
    if ($res == 'ERROR') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = @$config['Some_error_occurred_Please_try_again'][$language_id];
        $response["data"] = "";
        echoRespnse(201, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = @$config['Mobile_update_successfully'][$language_id];
        $response["data"] = "";
        echoRespnse(200, $response);
    }
});




/**
 * Forgot Password
 * url - /forgot_password
 * method - POST
 * params - mobile(mandatory)
 */
$app->post('/forgot_password', function() use ($app) {
    verifyRequiredParams(array('mobile'));
    $mobile = $app->request()->post('mobile');
    $response = array();
    $db = new DbHandler();
    //$db->fare_adjustment();
    $res = $db->forgot_password($mobile);
    if ($res == 'INVALID_USER_ACCESS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Invalid User access";
        echoRespnse(200, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Unable to proceed your request";
        echoRespnse(200, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "New password sent to registered mobile number";
        echoRespnse(201, $response);
    }
});


/**
 * Change Password
 * url - /change_password
 * method - POST
 * params - oldpassword(mandatory),newpassword(mandatory)
 * header Params - mobile(mandatory), password (mandatory)
 */
$app->post('/change_password', 'authenticate', function() use ($app) {
    global $user_id;
    //verifyRequiredParams(array('password'));
    verifyRequiredParams(array('oldpassword', 'newpassword'));
    $oldpassword = $app->request()->post('oldpassword');
    $newpassword = $app->request()->post('newpassword');
    $response = array();
    $db = new DbHandler();
    $res = $db->change_password($user_id, $oldpassword, $newpassword);
    if ($res == 'INVALID_USER_ACCESS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Invalid User access";
        echoRespnse(200, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Unable to proceed your request";
        echoRespnse(200, $response);
    } else if ($res == 'INVALID_OLD_PASSWORD') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Invalid old password";
        echoRespnse(200, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Password changed successfully";
        echoRespnse(201, $response);
    }
});



/**
 * Logout User
 * url - /logout
 * method - GET
 * header Params - email (mandatory), password (mandatory)
 */
$app->get('/logout', 'authenticate', function() use ($app) {
    global $user_id;

    $response = array();

    $db = new DbHandler();
    $res = $db->logout($user_id);
    if ($res == 'INVALID_USER_ACCESS') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Invalid User access";
        echoRespnse(200, $response);
    } else if ($res == 'UNABLE_TO_PROCEED') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Unable to proceed your request";
        echoRespnse(200, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "You have logged out successfully";
        echoRespnse(201, $response);
    }
});

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
// Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
// Required field(s) are missing or empty
// echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["code"] = 10;
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["code"] = 11;
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
// Http response code
    $app->status($status_code);

// setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate_live(\Slim\Route $route) {

    $app = \Slim\Slim::getInstance();
    $realm = 'Protected APIS';

    $req = $app->request();
    $res = $app->response();

    if (isset($_SERVER['HTTP_AUTHORIZATION']) && !empty($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION'] != "" && $_SERVER['HTTP_AUTHORIZATION'] != NULL) {
        list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        if (isset($username) && $username != '' && isset($password) && $password != '') {
            $db = new DbHandler();

            if ($userid = $db->validateUser($username, $password)) {
                if ($userid) {
                    global $user_id;
                    $user_id = $userid["id"];
                    return true;
                } else {
                    $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
                    $res = $app->response();
                    $res->status(401);
                    $app->stop();
                }
            } else {
                $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
                $res = $app->response();
                $res->status(401);
                $app->stop();
            }
        } else {
            $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
            $res = $app->response();
            $res->status(401);
            $app->stop();
        }
    } else {
        $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
        $res = $app->response();
        $res->status(401);
        $app->stop();
    }
}

function authenticate(\Slim\Route $route) {
    $app = \Slim\Slim::getInstance();
    $realm = 'Protected APIS';

    $req = $app->request();
    $res = $app->response();

    $username = $req->headers('PHP_AUTH_USER');
    $password = $req->headers('PHP_AUTH_PW');

    if (isset($username) && $username != '' && isset($password) && $password != '') {
        $db = new DbHandler();
        if ($userid = $db->validateUser($username, $password)) {
            if (!empty($userid)) {
                global $user_id, $language_id, $education_id, $salary_id,$state_id;
                $user_id = $userid["id"];
                $language_id = $userid["language_id"];
                $education_id = $userid["education_id"];
                $salary_id = $userid["salary_id"];
                $state_id = $userid["state_id"];
                return true;
            } else {
                $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
                $res = $app->response();
                $res->status(401);
                $app->stop();
            }
        } else {
            $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
            $res = $app->response();
            $res->status(401);
            $app->stop();
        }
    } else {
        $res->header('WWW-Authenticate', sprintf('Basic realm="%s"', $realm));
        $res = $app->response();
        $res->status(401);
        $app->stop();
    }
}

// functions of image upload

function resize($image_name, $size, $folder_name) {
    $file_extension = getFileExtension($image_name);
    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            $image_src = imagecreatefromjpeg($folder_name . '/' . $image_name);
            break;
        case 'png':
            $image_src = imagecreatefrompng($folder_name . '/' . $image_name);
            break;
        case 'gif':
            $image_src = imagecreatefromgif($folder_name . '/' . $image_name);
            break;
    }
    $true_width = imagesx($image_src);
    $true_height = imagesy($image_src);

    $width = $size;
    $height = ($width / $true_width) * $true_height;

    $image_des = imagecreatetruecolor($width, $height);

    imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image_des, $folder_name . '/' . $image_name, 100);
            break;
        case 'png':
            imagepng($image_des, $folder_name . '/' . $image_name, 8);
            break;
        case 'gif':
            imagegif($image_des, $folder_name . '/' . $image_name, 100);
            break;
    }
    return $image_des;
}

function resize1($image_name, $size, $folder_name, $thumb_folder) {
    $file_extension = getFileExtension($image_name);
    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            $image_src = imagecreatefromjpeg($folder_name . '/' . $image_name);
            break;
        case 'png':
            $image_src = imagecreatefrompng($folder_name . '/' . $image_name);
            break;
        case 'gif':
            $image_src = imagecreatefromgif($folder_name . '/' . $image_name);
            break;
    }
    $true_width = imagesx($image_src);
    $true_height = imagesy($image_src);

    $width = $size;
    $height = ($width / $true_width) * $true_height;

    $image_des = imagecreatetruecolor($width, $height);

    imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image_des, $folder_name . '/' . $image_name, 100);
            break;
        case 'png':
            imagepng($image_des, $folder_name . '/' . $image_name, 8);
            break;
        case 'gif':
            imagegif($image_des, $folder_name . '/' . $image_name, 100);
            break;
    }

    switch ($file_extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($image_des, $thumb_folder . '/' . $image_name, 100);
            break;
        case 'png':
            imagepng($image_des, $thumb_folder . '/' . $image_name, 5);
            break;
        case 'gif':
            imagegif($image_des, $thumb_folder . '/' . $image_name, 100);
            break;
    }
    return $image_des;
}

function getFileExtension($file) {
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    return $extension;
}

/**
 * verify trip strat otp
 * url - /verify_start_trip_otp
 * method - POST
 * params - booking_id (mandatory),otp(mandatory),
 */
$app->post('/verify_start_trip_otp', 'authenticate', function () use ($app) {
    verifyRequiredParams(array('booking_id', 'otp'));
    global $user_id;
    $booking_id = $app->request()->post('booking_id');
    $otp = $app->request()->post('otp');

    $db = new DbHandler();
    $res = $db->verify_start_trip_otp($booking_id, $otp);
    if ($res == 'INVALID_CODE') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Please enter a valid OTP";
        //   $response["data"] = null;
        echoRespnse(200, $response);
    } else if ($res == 'OTP_EXPIRED') {
        $response["code"] = 2;
        $response["error"] = true;
        $response["message"] = "OTP expired";
        //  $response["data"] = null;
        echoRespnse(200, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Verified";
        //$response["data"] = null;
        echoRespnse(201, $response);
    }
});

/**
 * resend trip start otp
 * url - /resend_trip_start_otp
 * method - POST
 * params - mobile (mandatory),code(mandatory),
 */
$app->post('/resend_trip_start_otp', 'authenticate', function () use ($app) {
    verifyRequiredParams(array('booking_id'));
    global $user_id;
    $booking_id = $app->request()->post('booking_id');

    $db = new DbHandler();
    $res = $db->resend_trip_start_otp($booking_id);
    if ($res == 'INVALID_CODE') {
        $response["code"] = 1;
        $response["error"] = true;
        $response["message"] = "Please enter a valid booking id";
        //  $response["data"] = null;
        echoRespnse(200, $response);
    } else {
        $response["code"] = 0;
        $response["error"] = false;
        $response["message"] = "Otp send successfully";
        // $response["data"] = null;
        echoRespnse(201, $response);
    }
});


$app->run();
?>
