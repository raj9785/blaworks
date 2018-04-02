<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
//define('SITEURL', Router::url('/', true));

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Time',
        'Text');

    /**
     * Components
     *
     * @var array
     */
    public $components = array(
        'Auth',
        'Session',
        'Cookie',
        'Paginator');
    public $booking_type_arr = array(
        "4" => "One Way",
        "3" => "Round Trip",
        "5" => "Multi City",
        "1" => "Day Package",
    );
    public $blog_types = array(
        "0" => "Blog",
        "1" => "Video",
    );
    public $dashboard_types = array(
        "1" => "Retail Business",
        "2" => "Corporate Business",
        //"3" => "Sector Specific",
        "4" => "Route Wise Performance",
    );
    public $booking_group_types = array(
        1 => 'Bookings',
        2 => 'Packages',
        3 => 'Getaways'
    );
    public $sorting_by_times = array(
        1 => 'Booking Time',
        2 => 'Pickup Time',
    );
    public $booking_source_list = array(
        "W" => 'Website',
        "M" => 'Mobile',
        "P" => 'Panel',
        "T" => 'MMT',
        "C" => 'Corporate'
    );
    public $DirClosedReasonArr = array(
        1 => "Price High",
        2 => "Urgent Booking",
        3 => "No Service Zone",
        4 => "Business Enquiry",
        5 => "Needs P2P Service",
        6 => "Needs Information only",
        7 => "Unrelated call",
        8 => "Existing Vendor/Driver call",
        9 => "Others"
    );
    public $DirClosedReasonArrWebEnq = array(
        1 => "Price High",
        2 => "Urgent Booking",
        3 => "No Service Zone",
        4 => "Business Enquiry",
        5 => "Needs P2P Service",
        6 => "Needs Information only",
        7 => "Unrelated Enquiry",
        8 => "Existing Vendor/Driver Enquiry",
        9 => 'Corporate Business Enquiry',
        10 => 'Booked with Competitor',
        11 => 'Booked with Local Vendor',
        12 => 'Not Responding',
        13 => 'Not Interested',
        14 => 'Repeat Enquiry'
    );
    public $open_enq_reasonWebEnq = array(
        1 => "Price High - Will take if we offer desired price",
        2 => "Customer has asked to call him/her later",
        3 => "Customer will call us back later",
        //4 => "Will confirm later after discussing with Family/Friends",
        5 => "Preferred Vehicle choice not available on our platform"
    );
    public $reasons_not_converted = array(
        1 => 'Booked with Competitor',
        2 => 'Booked with Local Vendor',
        3 => 'Price High',
        4 => 'Urgent Booking',
        5 => 'Not Responding',
        6 => 'Not Interested',
        7 => 'Others',
    );
    public $open_enq_reason = array(
        1 => "Price High - Will take if we offer desired price",
        2 => "Customer has asked to call him/her later",
        3 => "Customer will call us back later",
        //4 => "Will confirm later after discussing with Family/Friends",
        5 => "Preferred Vehicle choice not available on our platform"
    );
    public $booking_status = array(
        '0' => 'OPEN',
        '1' => 'ACCEPTED',
        '2' => 'ASSIGNED',
        //'9' => 'REASSIGNED',
        '8' => 'RESCHEDULED',
        '4' => 'EN-ROUTE',
        '5' => 'COMPLETED',
        // '3' => 'DECLINED',
        '6' => 'CUSTOMER CANCELLED',
        '7' => 'VENDOR CANCELLED',
        '12' => 'COMPANY CANCELLED',
        '10' => 'EN-ROUTE CHANGE',
        //'11' => 'ABANDONED',
        'ALL' => 'CHECK STATUS',
            //'13' => 'Invoice Updates',
            //14=>"advance payment"
            //15=>"edit booking"//
            //16 =>"move booking form conpany cancel to customer" //
            //20 for any text show//
    );

    function gen_slug($str, $table = '', $id = '') {
# special accents
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        $slug = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), str_replace($a, $b, $str)));
        $this->loadModel($table);
        if ($id) {
            $cond = array(
                $table . '.slug LIKE' => "" . $slug . "%",
                $table . '.id !=' => $id,
            );
        } else {
            $cond = array(
                'slug' => $slug,
            );
        }
//pr($cond);
        $get_count = $this->$table->find('count', array(
            'conditions' => $cond,
        ));

//echo $get_count; exit;

        if ($get_count > 0) {
            $slug = $slug . "-" . $get_count;
        }
        return $slug;
    }

    public function beforeFilter() {
        $this->set('booking_group_types', $this->booking_group_types);
        $this->set('sorting_by_times', $this->sorting_by_times);
        $this->set('booking_source_list', $this->booking_source_list);
//$booking_source_list
        $this->set('dashboard_types', $this->dashboard_types);
// $random_tracking = rand(0, 999999999);
// $this->Cookie->write("random_tracking", $random_tracking, false, "-12 months");
//$this->Cookie->delete('random_tracking');
        $scope = array('User.status' => 1, 'User.user_role_id' => 1);
        $loginAction = array('plugin' => '', 'controller' => 'users', 'action' => 'login');
        $loginRedirect = array('plugin' => '', 'controller' => 'users', 'action' => 'dashboard');
        $logoutRedirect = array('plugin' => '', 'controller' => 'users', 'action' => 'login');

        $this->Auth->authenticate = array(
            'all' => array('userModel' => 'User'),
            'Form' => array(
                'fields' => array(
                    'username' => 'username', 'password' => 'password'
                )
                ,
                'scope' => $scope
        ));

        $this->Auth->authError = __('Did you really think you are allowed to see that?');
        $sessionKey = 'Auth.Admin';
        authComponent::$sessionKey = $sessionKey;
        Security::setHash('md5');
//parent::beforeFilter();
        $this->layout = 'admin';
        $this->Auth->loginRedirect = $loginRedirect;
        $this->Auth->logoutRedirect = $logoutRedirect;
        $this->Auth->loginAction = $loginAction;
        $this->Auth->allow('login');
        $alerts_Arr = array();
        if ($this->Auth->user() && ($this->Auth->user('user_role_id') == 6)) {
            $this->loadModel('AccessRightUser');
            $id_user = $this->Auth->user('id');
            $user_dtl = $this->AccessRightUser->find('first', array(
                'conditions' => array(
                    'AccessRightUser.id' => $id_user,
                ),
                'fields' => array('trip_feedback', 'web_feedback', 'new_booking_alert', 'new_panic_alert', 'new_panic_alert_cs', 'new_booking_attemptet_alert'),
            ));
            $alerts_Arr['new_booking_alert'] = $user_dtl['AccessRightUser']['new_booking_alert'];
            $alerts_Arr['new_panic_alert'] = $user_dtl['AccessRightUser']['new_panic_alert'];
            $alerts_Arr['new_panic_alert_cs'] = $user_dtl['AccessRightUser']['new_panic_alert_cs'];
            $alerts_Arr['new_booking_attemptet_alert'] = $user_dtl['AccessRightUser']['new_booking_attemptet_alert'];
            $alerts_Arr['trip_feedback'] = $user_dtl['AccessRightUser']['trip_feedback'];
            $alerts_Arr['web_feedback'] = $user_dtl['AccessRightUser']['web_feedback'];
        } else {
            $this->loadModel('User');
            $id_user = $this->Auth->user('id');
            $user_dtl = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $id_user,
                ),
                'fields' => array('trip_feedback', 'web_feedback', 'new_booking_alert', 'new_panic_alert', 'new_panic_alert_cs', 'new_booking_attemptet_alert'),
            ));
            $alerts_Arr['new_booking_alert'] = $user_dtl['User']['new_booking_alert'];
            $alerts_Arr['new_panic_alert'] = $user_dtl['User']['new_panic_alert'];
            $alerts_Arr['new_panic_alert_cs'] = $user_dtl['User']['new_panic_alert_cs'];
            $alerts_Arr['new_booking_attemptet_alert'] = $user_dtl['User']['new_booking_attemptet_alert'];
            $alerts_Arr['trip_feedback'] = $user_dtl['User']['trip_feedback'];
            $alerts_Arr['web_feedback'] = $user_dtl['User']['web_feedback'];
        }

        if ($alerts_Arr['new_booking_attemptet_alert'] == 1) {
            $this->loadModel('BookingInitial');

            $conditions = array("BookingInitial.converted" => 0);
            $date_cr = date("Y-m-d H:i:s", strtotime("-10 minutes"));
            array_push($conditions, array('DATE_FORMAT(BookingInitial.created, "%Y-%m-%d %H:%i:%s") >= ' => $date_cr));
///get success ids///
            $this->loadModel('TransactionDetail');

            $count_logs = $this->TransactionDetail->find('all', array(
                'conditions' => array(
                    'TransactionDetail.paid_type' => 0
                ),
                'recursive' => -1
            ));
            $arr_dec = array();
            if (!empty($count_logs)) {
                foreach ($count_logs as $td) {
                    $arr_dec[$td['TransactionDetail']['transaction_id']] = $td['TransactionDetail']['transaction_id'];
                }
            }

            if (!empty($arr_dec)) {
                $conditions['BookingInitial.trans_id NOT'] = $arr_dec;
            }
            $count_new_bookings = $this->BookingInitial->find('count', array(
                'conditions' => $conditions,
            ));

            if ($count_new_bookings > 0) {
                $alerts_Arr['new_booking_attemptet_alert'] = 0;
            }
        }

//pr($alerts_Arr); exit;

        $this->set('alerts_Arr', $alerts_Arr);


        if ($this->Auth->user() && ($this->Auth->user('user_role_id') == 6)) {
            $this->loadModel('AccessRightUser');
            $id_user = $this->Auth->user('id');
            $user_dtl = $this->AccessRightUser->find('first', array(
                'conditions' => array(
                    'AccessRightUser.id' => $id_user,
                ),
            ));
            $this->set('loggedin_user', $user_dtl['AccessRightUser']);
            $this->loggedin_user = $user_dtl['AccessRightUser'];

            $this->loadModel('AccessPermission');
            $permissions = $this->AccessPermission->find('list', array('fields' => array('field_name', 'field_value'), 'conditions' => array('access_right_category_id' => $this->Auth->user('access_right_category_id'))));
//pr($permissions);
            $this->set('permissions', $permissions);
        } else {
            $this->set('loggedin_user', $this->Auth->user());
            $this->loggedin_user = $this->Auth->user();
        }


//        if ($this->loggedin_user['id'] == 14 && $this->params['action'] != "rate_list") {
////pr($this->params); exit;
//            $this->redirect(array('plugin' => 'booking', 'controller' => 'bookings', 'action' => 'rate_list'));
//        }
//check for alerts//


        $NewArrAlerts = $this->get_alert_list();
//pr($NewArrAlerts); exit;
        $this->set('new_alerts', $NewArrAlerts);

//endsupdate_alerts
    }

    public function global_logs($table_name, $table_id, $action_type, $text_action, $json_data) {
        $this->loadModel("Logs");
        $arr['Logs']['table_name'] = $table_name;
        $arr['Logs']['table_id'] = $table_id;
        $arr['Logs']['action_type'] = $action_type;
        $arr['Logs']['text_action'] = $text_action;
        $arr['Logs']['created'] = date("Y-m-d H:i:s");
        $arr['Logs']['json_data'] = $json_data;
        $arr['Logs']['ip_address'] = $this->get_client_ip();
        if ($this->Auth->user('user_role_id') == 1) {
            $contacted_user_type = 0;
        } else {
            $contacted_user_type = 1;
        }
        $arr['Logs']['action_taken_by_id'] = $this->Auth->user('id');
        $arr['Logs']['action_taken_by_type'] = $contacted_user_type;
        $arr['Logs']['action_taken_by_name'] = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
        $this->Logs->save($arr);
        return true;
    }

    function fare_logs($fare_id, $text, $fare_type, $json_data) {
        if ($fare_type == 1) {
            $this->loadModel("FareLog");
            $arr['FareLog']['fare_id'] = $fare_id;
            $arr['FareLog']['text'] = $text;
            $arr['FareLog']['json_data'] = $json_data;
            $arr['FareLog']['created'] = date("Y-m-d H:i:s");
            $arr['FareLog']['ip_address'] = $this->get_client_ip();

            if ($this->Auth->user('user_role_id') == 1) {
                $contacted_user_type = 0;
            } else {
                $contacted_user_type = 1;
            }
            $arr['FareLog']['action_taken_by_id'] = $this->Auth->user('id');
            $arr['FareLog']['action_taken_by_type'] = $contacted_user_type;
            $arr['FareLog']['action_taken_by_name'] = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
            $this->FareLog->save($arr);
        } else {
            $this->loadModel("VendorFareLog");
            $arr['VendorFareLog']['vendor_fare_id'] = $fare_id;
            $arr['VendorFareLog']['text'] = $text;
            $arr['VendorFareLog']['json_data'] = $json_data;
            $arr['VendorFareLog']['created'] = date("Y-m-d H:i:s");
            $arr['VendorFareLog']['ip_address'] = $this->get_client_ip();

            if ($this->Auth->user('user_role_id') == 1) {
                $contacted_user_type = 0;
            } else {
                $contacted_user_type = 1;
            }
            $arr['VendorFareLog']['action_taken_by_id'] = $this->Auth->user('id');
            $arr['VendorFareLog']['action_taken_by_type'] = $contacted_user_type;
            $arr['VendorFareLog']['action_taken_by_name'] = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
            $this->VendorFareLog->save($arr);
        }
        return true;
    }

    public function send_invoice_mail_leads($lead_in_id = '') {
//PHP Version 5.5.9-1ubuntu4.16
//pr(phpinfo());
        $this->layout = false;
//$lead_in_id = 3;
        if ($lead_in_id) {
            require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
// check that user exists or not
            $this->loadModel('LeadInvoice');
            $this->LeadInvoice->bindModel(array('hasMany' => array('LeadInvoiceDetail', 'LeadInvoiceTax')));
            $this->LeadInvoice->bindModel(array('belongsTo' => array('LeadCompany')));
            $invoice_details = $this->LeadInvoice->find('first', array(
                'conditions' => array(
                    'LeadInvoice.id' => $lead_in_id
                ),
                    //'recursive' => -2
            ));
//pr($invoice_details);

            if (!empty($invoice_details)) {

                $this->set("invoice_details", $invoice_details);
                $this->set('booking_type_arr', $this->booking_type_arr);
//$this -> viewPath = 'LeadInvoices';
//$this->view  = 'LeadInvoice/index';
                $detail = $this->render('LeadInvoice.LeadInvoices/export'); //$this->render('export', array('plugin'=>'LeadInvoice'));

                $this->dompdf = new DOMPDF();
                $papersize = "legal";
                $orientation = "portrait";

                $this->dompdf->load_html($detail);

                $this->dompdf->render();
//echo "www"; exit;

                $filename = "SCINVOICE_" . time() . ".pdf";


//pr($customer_taxes);
//exit;
//end//

                $fileLoc = WEBSITE_APP_WEBROOT_ROOT_PATH . "invoice/" . $filename;
                $output = $this->dompdf->output();
                file_put_contents($fileLoc, $output);


                $arr_var['invoice_details'] = $invoice_details;
                $arr_var['booking_type_arr'] = $this->booking_type_arr;
                $arr_var['blog_types'] = $this->blog_types;
                $email = $invoice_details['LeadCompany']['email_id'];
//$email = "deepakjangid05@gmail.com";
                $subject = "Invoice from " . date("d-m-Y", strtotime($invoice_details['LeadInvoice']['from_date'])) . " to " . date("d-m-Y", strtotime($invoice_details['LeadInvoice']['to_date']));
                $Email = new CakeEmail();
                $Email->from(Configure::read("Site.email"))
                        ->to($email)
                        ->subject($subject)
                        ->template("lead_invoice_mail")
                        ->emailFormat("html")
                        ->attachments(array($fileLoc))
                        ->viewVars($arr_var)
                        ->send();
            }
        }
//exit;
        return true;
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function get_alert_list() {
        $NewArrAlerts = array();
        if ($this->Auth->user()) {
            $this->loadModel('UpdateAlert');
            if ($this->Auth->user('user_role_id') == 6) {
                $user_type = 1;
            } else {
                $user_type = 0;
            }

            $alerts_list = $this->UpdateAlert->find('all', array(
                'conditions' => array(
                    'UpdateAlert.user_id' => $this->Auth->user('id'),
                    'UpdateAlert.user_type' => $user_type,
                    'UpdateAlert.seen_status' => 0,
                ),
            ));
//pr($alerts_list);

            if (!empty($alerts_list)) {
                foreach ($alerts_list as $dt) {
                    $NewArrAlerts[$dt['UpdateAlert']['menu']][$dt['UpdateAlert']['controller']][$dt['UpdateAlert']['action']] = 1;
                }
            }
        }
        return $NewArrAlerts;
    }

    function update_alert_seen($controller, $action) {
        if ($this->Auth->user()) {
            $this->loadModel('UpdateAlert');
            $id = $this->Auth->user('id');
            if ($this->Auth->user('user_role_id') == 6) {
                $user_type = 1;
            } else {
                $user_type = 0;
            }
            $qry = "update update_alerts set update_alerts.seen_status=1 WHERE update_alerts.user_id='$id' AND update_alerts.user_type='$user_type' AND update_alerts.controller='$controller' AND update_alerts.action='$action'";
            $this->UpdateAlert->query($qry);
        }
        return true;
    }

    function insert_alerts($controller, $action, $menu, $message = '', $fields = '') {
        if ($controller) {
            $this->loadModel("UpdateAlert");
            $ArrIns = array();

            $ArrIns[0]['UpdateAlert']['user_id'] = 1;
            $ArrIns[0]['UpdateAlert']['user_type'] = 0;
            $ArrIns[0]['UpdateAlert']['controller'] = $controller;
            $ArrIns[0]['UpdateAlert']['menu'] = $menu;
            $ArrIns[0]['UpdateAlert']['action'] = $action;
            $ArrIns[0]['UpdateAlert']['message'] = $message;
            $ArrIns[0]['UpdateAlert']['seen_status'] = 0;
            $ArrIns[0]['UpdateAlert']['created'] = date("Y-m-d H:i:s");

//send to user 
            if ($fields) {
                $this->loadModel("AccessRightUser");

                $list = $this->AccessRightUser->find('all', array(
                    'conditions' => array(
                        'AccessRightUser.status' => 1,
                        'AccessRightUser.' . $fields => 1,
                    ),
                    'fields' => array(
                        'AccessRightUser.id'
                    )
                ));

                if (!empty($list)) {
                    $i = 1;
                    foreach ($list as $data) {
                        $ArrIns[$i]['UpdateAlert']['user_id'] = $data['AccessRightUser']['id'];
                        $ArrIns[$i]['UpdateAlert']['user_type'] = 1;
                        $ArrIns[$i]['UpdateAlert']['menu'] = $menu;
                        $ArrIns[$i]['UpdateAlert']['controller'] = $controller;
                        $ArrIns[$i]['UpdateAlert']['action'] = $action;
                        $ArrIns[$i]['UpdateAlert']['message'] = $message;
                        $ArrIns[$i]['UpdateAlert']['seen_status'] = 0;
                        $ArrIns[$i]['UpdateAlert']['created'] = date("Y-m-d H:i:s");
                        $i++;
                    }
                }
            }
            $this->UpdateAlert->saveAll($ArrIns);
        }
        return true;
    }

    function update_seen_alerts($type = '', $panictype = '') {
        if ($this->Auth->user() && ($this->Auth->user('user_role_id') == 6)) {
            $this->loadModel('AccessRightUser');
            $id_user = $this->Auth->user('id');
            if ($type == "booking") {
                $this->AccessRightUser->updateAll(array('AccessRightUser.new_booking_alert' => "0"), array('AccessRightUser.id' => $id_user));
            } else {
                if ($panictype == "driver") {
                    $this->AccessRightUser->updateAll(array('AccessRightUser.new_panic_alert' => "0"), array('AccessRightUser.id' => $id_user));
                } else {
                    $this->AccessRightUser->updateAll(array('AccessRightUser.new_panic_alert_cs' => "0"), array('AccessRightUser.id' => $id_user));
                }
            }
        } else {
            $this->loadModel('User');
            $id_user = $this->Auth->user('id');
            if ($type == "booking") {
                $this->User->updateAll(array('User.new_booking_alert' => "0"), array('User.id' => $id_user));
            } else {
                if ($panictype == "driver") {
                    $this->User->updateAll(array('User.new_panic_alert' => "0"), array('User.id' => $id_user));
                } else {
                    $this->User->updateAll(array('User.new_panic_alert_cs' => "0"), array('User.id' => $id_user));
                }
            }
        }
    }

    function update_seen_feed_alerts($type = '') {
        if ($this->Auth->user() && ($this->Auth->user('user_role_id') == 6)) {
            $this->loadModel('AccessRightUser');
            $id_user = $this->Auth->user('id');
            if ($type == "web") {
                $this->AccessRightUser->updateAll(array('AccessRightUser.web_feedback' => "0"), array('AccessRightUser.id' => $id_user));
            } else {
                $this->AccessRightUser->updateAll(array('AccessRightUser.trip_feedback' => "0"), array('AccessRightUser.id' => $id_user));
            }
        } else {
            $this->loadModel('User');
            $id_user = $this->Auth->user('id');
            if ($type == "web") {
                $this->User->updateAll(array('User.web_feedback' => "0"), array('User.id' => $id_user));
            } else {
                $this->User->updateAll(array('User.trip_feedback' => "0"), array('User.id' => $id_user));
            }
        }
    }

    function update_seen_att_alerts() {
        if ($this->Auth->user() && ($this->Auth->user('user_role_id') == 6)) {
            $this->loadModel('AccessRightUser');
            $id_user = $this->Auth->user('id');
            $this->AccessRightUser->updateAll(array('AccessRightUser.new_booking_attemptet_alert' => "0"), array('AccessRightUser.id' => $id_user));
        } else {
            $this->loadModel('User');
            $id_user = $this->Auth->user('id');
            $this->User->updateAll(array('User.new_booking_attemptet_alert' => "0"), array('User.id' => $id_user));
        }
    }

    public function send_message($phone_no, $msg, $no_response = '') {
        if ($phone_no) {
// $url = "http://37.58.64.227/server/sendsms.aspx?username=superc&password=superc12&receiver=" . $phone_no . "&message=" . urlencode($msg) . "&message_type=TEXT&sender=SUPERC";
//$url = "http://api.clickatell.com/http/sendmsg?user=xabado&password=AUdDOeGcQHffON&api_id=3552366&to=" . $phone_no . "&text=" . urlencode($msg) . "";
//$execute = file_get_contents($url);
// echo $url; exit;
            $url = "http://nimbusit.co.in/api/swsend.asp?username=t1ankkitraghav&password=15501954&sender=SUPERC&sendto=" . $phone_no . "&message=" . urlencode($msg);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, true);
            if ($no_response == 1) {
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            }
            $data = curl_exec($ch);
//pr($data);exit;

            if ($data)
                return true;
            else
                return false;
        }else {
            return false;
        }
    }

    public function send_message_multiple($phone_no_arry, $msg, $no_response = '') {
        if (!empty($phone_no_arry)) {
            $phone_nos = implode(",", $phone_no_arry);
            if ($phone_nos) {
//$url = "http://37.58.64.227/server/sendsms.aspx?username=superc&password=superc12&receiver=" . $phone_nos . "&message=" . urlencode($msg) . "&message_type=TEXT&sender=SUPERC";
//$url = "http://api.clickatell.com/http/sendmsg?user=xabado&password=AUdDOeGcQHffON&api_id=3552366&to=" . $phone_no . "&text=" . urlencode($msg) . "";
//$execute = file_get_contents($url);
//echo $url; exit;
// echo $url; exit;
                $url = "http://nimbusit.co.in/api/swsend.asp?username=t1ankkitraghav&password=15501954&sender=SUPERC&sendto=" . $phone_nos . "&message=" . urlencode($msg);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, true);
                if ($no_response == 1) {
                    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                }
                $data = curl_exec($ch);
//pr($data);exit;
                if ($data)
                    return $data;
                else
                    return false;
            }else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isAuthorized() {
        return true;
    }

    function download($filename, $type = '') {
        if ($type == 'doc') {
            $downloadPath = USER_DOC_STORE_PATH;
        } else if ($type == 'taxidoc') {
            $downloadPath = TAXI_DOC_STORE_PATH_IMAGE;
        } else if ($type == "driverdoc") {
            $downloadPath = USER_DOC_STORE_PATH;
        }
//echo $downloadPath; exit;
        $this->downloadFile($filename, $downloadPath, $alt_name = '');
    }

    function downloadFile($filename, $downloadPath, $alt_name = '') {
        $file = $downloadPath . $filename;
        if (!is_file($file)) {
            die("<b>404 File not found!</b>");
        }

//Gather relevent info about file
        $len = filesize($file);
        $filename = basename($file);
        $file_extension = strtolower(substr(strrchr($filename, "."), 1));

//This will set the Content-Type to the appropriate setting for the file
        switch ($file_extension) {
            case "pdf": $ctype = "application/pdf";
                break;
            case "exe": $ctype = "application/octet-stream";
                break;
            case "zip": $ctype = "application/zip";
                break;
            case "docx": $ctype = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                break;
            case "doc": $ctype = "application/msword";
                break;
            case "xlsx": $ctype = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                break;
            case "xls": $ctype = "application/vnd.ms-excel";
                break;
            case "ppt": $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif": $ctype = "image/gif";
                break;
            case "png": $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg": $ctype = "image/jpg";
                break;
            case "mp3": $ctype = "audio/mpeg";
                break;
            case "wav": $ctype = "audio/x-wav";
                break;
            case "mpeg":
            case "mpg":
            case "mpe": $ctype = "video/mpeg";
                break;
            case "mov": $ctype = "video/quicktime";
                break;
            case "avi": $ctype = "video/x-msvideo";
                break;

//The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
            case "php":
            case "htm":
            case "html": die("<b>" . __("Cannot be used for") . $file_extension . __("files") . "!</b>");
                break;

            default: $ctype = "application/force-download";
        }

//Begin writing headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");

//Use the switch-generated Content-Type
        header("Content-Type: $ctype");

//Force the download
        if ($alt_name == '') {
            $alt_name = $filename;
        } else {
            $alt_name = $alt_name . '.' . $file_extension;
        }
        $header = "Content-Disposition: attachment; filename=" . $alt_name . ";";
        header($header);
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $len);
        @readfile($file);
        exit();
    }

    function resizeImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
//echo $image."-----".$thumb_image_name; exit;
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }

        imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
//echo $newImage; exit;
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_image_name, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);
                break;
        }
//chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    public function resize($image_name, $width, $height = '', $folder_name, $thumb_folder) {

        $file_extension = $this->getFileExtension($image_name);
        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                $image_src = imagecreatefromjpeg($folder_name . DS . $image_name);
                break;
            case 'png':
                $image_src = imagecreatefrompng($folder_name . DS . $image_name);
                break;
            case 'gif':
                $image_src = imagecreatefromgif($folder_name . DS . $image_name);
                break;
        }
        $true_width = imagesx($image_src);
        $true_height = imagesy($image_src);

        if ($true_width > $true_height) {
            $height = ($true_height * $width) / $true_width;
        } else {
            if ($height == '')
                $height = ($true_height * $width) / $true_width;

            $width = ($true_width * $height) / $true_height;
        }
        $image_des = imagecreatetruecolor($width, $height);

        if ($file_extension == 'png') {
            $nWidth = intval($true_width / 4);
            $nHeight = intval($true_height / 4);
            imagealphablending($image_des, false);
            imagesavealpha($image_des, true);
            $transparent = imagecolorallocatealpha($image_des, 255, 255, 255, 127);
            imagefilledrectangle($image_des, 0, 0, $nWidth, $nHeight, $transparent);
        }

        imagecopyresampled($image_des, $image_src, 0, 0, 0, 0, $width, $height, $true_width, $true_height);

        switch ($file_extension) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($image_des, $thumb_folder . DS . $image_name, 100);
                break;
            case 'png':
                imagepng($image_des, $thumb_folder . DS . $image_name, 5);
                break;
            case 'gif':
                imagegif($image_des, $thumb_folder . DS . $image_name, 100);
                break;
        }
        return $image_des;
    }

    function getFileExtension($file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        return $extension;
    }

    function export_file($header_row, $results, $flag = '', $page_type = '') {
        if ($flag == 'csv') {
            ini_set('max_execution_time', 600);
            $filename = "report_csv_" . time() . ".csv";
            $csv_file = fopen('php://output', 'w');
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            fputcsv($csv_file, $header_row, ',', '"');
            foreach ($results as $result) {
                $row = array();
                foreach ($result as $key => $res) {
                    $row[] = $res;
                }
                fputcsv($csv_file, $row, ',', '"');
            }
            fclose($csv_file);
            die;
        } else if ($flag == 'pdf') {
            $detail = PDF_HEADER_HTML;
            foreach ($header_row as $header_item) {
                $detail .= '<th style="border:1px solid #000;">' . $header_item . '</th>';
            }
            $detail .= '</tr>';
            if (!empty($results)) {
                foreach ($results as $key => $result) {
                    $row = array();
                    $detail .= '<tr >';
                    foreach ($result as $key => $res) {
                        $detail .= '<td style="border:1px solid #000;">' . $res . '</td>';
                    }
                    $detail .= '</tr>';
                }
            } else {
                $row = array();
                $detail .= '<tr >';
                $detail .= '<td style="border:1px solid #000;" colspan="15">No Record Found</td>';
                $detail .= '</tr>';
            }
            $detail .= '</table>' . PDF_FOOTER_HTML;
            require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
            $dompdf = new DOMPDF();
//$dompdf->set_paper("a4","landscape");
            if ($page_type) {
                $dompdf->set_paper(array(0, 0, "1060", "600"));
            } else {
                $dompdf->set_paper("a4", "landscape");
            }

            $dompdf->load_html($detail);
            $dompdf->render();
            $filename = "report_pdf_" . time() . ".pdf";
            $dompdf->stream($filename);
            die;
        }
    }

    function status_ccpayment_api($order_no = '') {
        require_once(APP . 'Vendor' . DS . 'Crypto.php');
        $order_List = "|" . $order_no . "|";
        $encrypted_data = encrypt($order_List, CCAVENUE_WORKING_KEY); // Method for encrypting the data.
        $url = CCAVENUE_API_URL . "enc_request=" . $encrypted_data . "&command=orderStatusTracker&access_code=" . CCAVENUE_ACCESS_CODE . "&request_type=STRING&response_type=JSON&version=1.1";
//echo $url;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $info = curl_getinfo($ch);
        $result = curl_exec($ch);
        $decryptValues = explode('&', $result);
        $status_chk = explode('=', $decryptValues[0]);
//pr($result);
        $responseArr = array();
        if (!empty($status_chk)) {
            if ($status_chk[1] != 1) {
                $information = explode('=', $decryptValues[1]);
//pr($information[1]);
                $result1 = decrypt(trim($information[1]), CCAVENUE_WORKING_KEY);
                $result1 = preg_replace('/[^\x20-\x7E]/', '', $result1);
                $result1 = trim($result1);
                $responseArr = json_decode($result1, true);
            }
        }
        return $responseArr;
    }

    function confirm_ccpayment_api($tracking_no = '', $amount = '') {
        require_once(APP . 'Vendor' . DS . 'Crypto.php');
        $order_List = $tracking_no . "$" . $amount . "|";
        $encrypted_data = encrypt($order_List, CCAVENUE_WORKING_KEY); // Method for encrypting the data.
        $url = CCAVENUE_API_URL . "enc_request=" . $encrypted_data . "&command=confirmOrder&access_code=" . CCAVENUE_ACCESS_CODE . "&request_type=STRING&response_type=JSON&version=1.1";
//echo $url;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $info = curl_getinfo($ch);
        $result = curl_exec($ch);
        $decryptValues = explode('&', $result);
        $status_chk = explode('=', $decryptValues[0]);
        $responseArr = array();
        if (!empty($status_chk)) {
            if ($status_chk[1] != 1) {
                $information = explode('=', $decryptValues[1]);
//pr($information[1]);
                $result1 = decrypt(trim($information[1]), CCAVENUE_WORKING_KEY);
                $result1 = preg_replace('/[^\x20-\x7E]/', '', $result1);
                $result1 = trim($result1);
                $responseArr = json_decode($result1, true);
            }
        }
        return $responseArr;
    }

    function refund_ccpayment_api($tracking_no = '', $order_id = '', $amount = '') {
        require_once(APP . 'Vendor' . DS . 'Crypto.php');
        $data_resp = $tracking_no . "|" . $amount . "|" . $order_id . "|";
        $encrypted_data = encrypt($data_resp, CCAVENUE_WORKING_KEY); // Method for encrypting the data.
        $url = CCAVENUE_API_URL . "command=refundOrder&request_type=STRING&response_type=JSON&access_code=" . CCAVENUE_ACCESS_CODE . "&enc_request=" . $encrypted_data;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $info = curl_getinfo($ch);
        $result = curl_exec($ch);

        $decryptValues = explode('&', $result);
        $status_chk = explode('=', $decryptValues[0]);

        $return = 0;
        $responseArr = array();
        if (!empty($status_chk)) {
            if ($status_chk[1] != 1) {
                $information = explode('=', $decryptValues[1]);
                $result1 = decrypt(trim($information[1]), CCAVENUE_WORKING_KEY);
//pr($result1);
                $result1 = preg_replace('/[^\x20-\x7E]/', '', $result1);
                $result1 = trim($result1);
                $responseArr = json_decode($result1, true);
            }
        }
        return $responseArr;
    }

    function transfer_wallet_cashbacks($booking_id, $type, $fare_category = '') {
        if ($type == "CREATEBOOKING") {

            if ($this->Auth->user('id')) {
//check for cashback available//
                $this->loadModel('BookingWalletCashback');
                $this->BookingWalletCashback->virtualFields = array(
                    'total_trip_count' => 'select COUNT(customer_soas.id) from customer_soas where customer_soas.cashback_offer_id=BookingWalletCashback.cashback_offer_id AND customer_soas.type=2 limit 1',
                );

                if ($fare_category == 1) {
                    $conditions = array(
                        'BookingWalletCashback.customer_id' => $this->Auth->user('id'),
                        'BookingWalletCashback.booking_id !=' => $booking_id,
                        'BookingWalletCashback.status' => 2,
                        'Booking.farecategory_id >=' => $fare_category,
                    );
                } else {
                    $conditions = array(
                        'BookingWalletCashback.customer_id' => $this->Auth->user('id'),
                        'BookingWalletCashback.booking_id !=' => $booking_id,
                        'BookingWalletCashback.status' => 2,
                    );
                }

                $SoaRecords = $this->BookingWalletCashback->find("first", array(
                    'conditions' => $conditions,
                    'joins' => array(
                        array(
                            'table' => 'bookings',
                            'alias' => 'Booking',
                            'type' => 'LEFT',
                            'conditions' => array('Booking.id = BookingWalletCashback.booking_id')
                        )
                    ),
                    "group" => 'BookingWalletCashback.id HAVING BookingWalletCashback__total_trip_count < BookingWalletCashback.no_of_trips',
                    'order' => array('id' => 'ASC')
                ));

//pr($SoaRecords);
//exit;

                if (!empty($SoaRecords)) {
                    $BookingWalletCashback = $SoaRecords['BookingWalletCashback'];
                    if (!empty($BookingWalletCashback)) {
//                        /pr($BookingWalletCashback);exit;
                        $this->loadModel('CustomerSoa');
//insert to customer seo//
                        $SoaLast = $this->CustomerSoa->find("first", array(
                            'conditions' => array(
                                'CustomerSoa.customer_id' => $this->Auth->user('id'),
                            ),
                            'order' => array('id' => 'DESC')
                        ));
                        if (!empty($SoaLast)) {
                            $current_amount = $SoaLast['CustomerSoa']['current_amount'];
                            $transfer_amount = $BookingWalletCashback['cashback_per_trip'];
                            $current_amount = $current_amount - $transfer_amount;
                            $created = date("Y-m-d H:i:s");
                            $InsArr['CustomerSoa']['booking_id'] = $booking_id;
                            $InsArr['CustomerSoa']['customer_id'] = $this->Auth->user('id');
                            $InsArr['CustomerSoa']['cashback_offer_id'] = $BookingWalletCashback['cashback_offer_id'];
                            $InsArr['CustomerSoa']['particular_description'] = "Cashback Adjusted against Booking";
                            $InsArr['CustomerSoa']['particular'] = 3;
                            $InsArr['CustomerSoa']['type'] = 2;
                            $InsArr['CustomerSoa']['created'] = $created;
                            $InsArr['CustomerSoa']['amount'] = $transfer_amount;
                            $InsArr['CustomerSoa']['current_amount'] = $current_amount;
                            $this->CustomerSoa->save($InsArr);
                        }
                    }
                }
            }
        } else if ($type == "CANCELBOOKING") {
            $this->loadModel('CustomerSoa');
            $SoaRecords = $this->CustomerSoa->find("first", array(
                'conditions' => array(
                    'CustomerSoa.booking_id' => $booking_id,
                    'CustomerSoa.particular' => 3,
                    'CustomerSoa.type' => 2,
                ),
            ));

            if (!empty($SoaRecords)) {
                $ChkRecords = $this->CustomerSoa->find("first", array(
                    'conditions' => array(
                        'CustomerSoa.booking_id' => $booking_id,
                        'CustomerSoa.particular' => 2,
                        'CustomerSoa.type' => 1,
                    ),
                ));
                if (empty($ChkRecords)) {
//insert to customer seo//
                    $SoaLast = $this->CustomerSoa->find("first", array(
                        'conditions' => array(
                            'CustomerSoa.customer_id' => $SoaRecords['CustomerSoa']['customer_id'],
                        ),
                        'order' => array('id' => 'DESC')
                    ));
                    if (!empty($SoaLast)) {
                        $current_amount = $SoaLast['CustomerSoa']['current_amount'];
                        $transfer_amount = $SoaRecords['CustomerSoa']['amount'];
                        $current_amount = $current_amount + $transfer_amount;
                        $created = date("Y-m-d H:i:s");
                        $InsArr['CustomerSoa']['booking_id'] = $booking_id;
                        $InsArr['CustomerSoa']['customer_id'] = $SoaRecords['CustomerSoa']['customer_id'];
                        $InsArr['CustomerSoa']['cashback_offer_id'] = $SoaRecords['CustomerSoa']['cashback_offer_id'];
                        $InsArr['CustomerSoa']['particular_description'] = "Cashback Returned to Account";
                        $InsArr['CustomerSoa']['particular'] = 2;
                        $InsArr['CustomerSoa']['type'] = 1;
                        $InsArr['CustomerSoa']['created'] = $created;
                        $InsArr['CustomerSoa']['amount'] = $transfer_amount;
                        $InsArr['CustomerSoa']['current_amount'] = $current_amount;
                        $this->CustomerSoa->save($InsArr);
                    }
                }
            }
        }

//delete from BookingWalletCashback if cashback is in pending mode///
        $this->loadModel('BookingWalletCashback');
        $this->BookingWalletCashback->deleteAll(array('BookingWalletCashback.booking_id' => $booking_id, 'BookingWalletCashback.status' => 1));


        return true;
    }

    function save_booking_fare_details($booking_id = '', $rate_detail_id = '', $state_tax = '', $toll_tax = '', $RateAdjustmentID = '') {
        $this->loadModel("BookingRateDetail");
        $this->loadModel("RateDetail");
//$booking_id = 5033;
//$rate_detail_id = 5033;
        $saveArr = array();
        if ($booking_id && $rate_detail_id) {
            $fareData = $this->RateDetail->find('first', array(
                'conditions' => array(
                    'RateDetail.id' => $rate_detail_id,
                ),
                'fields' => array("RateDetail.*", "Rate.*", "Package.*"),
                'joins' => array(
                    array(
                        'table' => 'rates',
                        'alias' => 'Rate',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Rate.id = RateDetail.rate_id'
                        )
                    ),
                    array(
                        'table' => 'packages',
                        'alias' => 'Package',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Package.id=Rate.package_id'
                        )
                    )
                ),
            ));
            if (!empty($fareData)) {
                $base_fare_cust = $fareData['RateDetail']['base_fare_cust'];
                $base_fare_vend = $fareData['RateDetail']['base_fare_vend'];
                $base_fare_cust_Rt = $base_fare_cust;
                $base_fare_vend_Rt = $base_fare_vend;

                $AdjustArr = array();


                if ($RateAdjustmentID) {
                    $this->loadModel("RateAdjustment");
                    $query = " SELECT `RateAdjustmentAmount`.`cust_amount` ,`RateAdjustment`.`vendor_adjustment_type`,`RateAdjustmentAmount`.`vend_amount`,`RateAdjustment`.`adjustment_type`,`RateAdjustment`.`amount_type`,`RateAdjustment`.`id` from rate_adjustments  as RateAdjustment
					INNER join rate_adjustment_amounts  as RateAdjustmentAmount  on `RateAdjustmentAmount`.`rate_adjustment_id`=`RateAdjustment`.`id` 
					where `RateAdjustment`.`id`=$RateAdjustmentID";
                    $records = $this->RateAdjustment->query($query);


                    if (!empty($records)) {
                        $records = $records[0];
                        //adjustment for customer//
                        $adjust_amount = $records['RateAdjustmentAmount']['cust_amount'];
                        $vendor_adjustment_type = $records['RateAdjustment']['vendor_adjustment_type']; ///1 for invoice,2=>SOA
                        $amount = $adjust_amount;
                        if ($records['RateAdjustment']['amount_type'] == 1) {
                            $amount = $base_fare_cust * $adjust_amount / 100;
                        }
                        if ($records['RateAdjustment']['adjustment_type'] == 1) {
                            $base_fare_cust_Rt = $base_fare_cust - $amount;
                        } else {
                            $base_fare_cust_Rt = $base_fare_cust + $amount;
                        }

                        //adjustment for vendors//
                        if ($vendor_adjustment_type == 2) {
                            $adjust_amount = $records['RateAdjustmentAmount']['vend_amount'];
                            $amount = $adjust_amount;
                            if ($records['RateAdjustment']['amount_type'] == 1) {
                                $amount = $base_fare_vend * $adjust_amount / 100;
                            }
                            if ($records['RateAdjustment']['adjustment_type'] == 1) {
                                $base1 = $base_fare_vend - $amount;
                            } else {
                                $base1 = $base_fare_vend + $amount;
                            }
                            $AdjustArr['adjustment_type'] = $records['RateAdjustment']['adjustment_type'];
                            $AdjustArr['base_fare_vend'] = $base1;
                            $AdjustArr['amount'] = $amount;
                        } else {
                            $adjust_amount = $records['RateAdjustmentAmount']['vend_amount'];
                            $amount = $adjust_amount;
                            if ($records['RateAdjustment']['amount_type'] == 1) {
                                $amount = $base_fare_vend * $adjust_amount / 100;
                            }
                            if ($records['RateAdjustment']['adjustment_type'] == 1) {
                                $base_fare_vend_Rt = $base_fare_vend - $amount;
                            } else {
                                $base_fare_vend_Rt = $base_fare_vend + $amount;
                            }
                        }
                    }
                }



                $saveArr['BookingRateDetail']['booking_id'] = $booking_id;
                $saveArr['BookingRateDetail']['minimum_km'] = $fareData['Rate']['minimum_km'];
                $saveArr['BookingRateDetail']['minimum_km_per_trip'] = $fareData['Rate']['minimum_km_per_trip'];
                $saveArr['BookingRateDetail']['base_fare_cust'] = $base_fare_cust_Rt;
                $saveArr['BookingRateDetail']['base_fare_vend'] = $base_fare_vend_Rt;
                $saveArr['BookingRateDetail']['after_min_km_fare_cust'] = $fareData['RateDetail']['after_min_km_fare_cust'];
                $saveArr['BookingRateDetail']['after_min_km_fare_vend'] = $fareData['RateDetail']['after_min_km_fare_vend'];
                $saveArr['BookingRateDetail']['after_min_hr_fare_cust'] = $fareData['RateDetail']['after_min_hr_fare_cust'];
                $saveArr['BookingRateDetail']['after_min_hr_fare_vend'] = $fareData['RateDetail']['after_min_hr_fare_vend'];
                $saveArr['BookingRateDetail']['driver_fare_cust'] = $fareData['RateDetail']['driver_fare_cust'];
                $saveArr['BookingRateDetail']['driver_fare_vend'] = $fareData['RateDetail']['driver_fare_vend'];
                $saveArr['BookingRateDetail']['total_toll_tax'] = $fareData['RateDetail']['total_toll_tax'];

                $saveArr['BookingRateDetail']['mcd_tax'] = $fareData['RateDetail']['mcd_tax'];
                $saveArr['BookingRateDetail']['total_state_tax'] = $fareData['RateDetail']['total_state_tax'];
                $saveArr['BookingRateDetail']['garage_charges'] = $fareData['RateDetail']['garage_charges'];


                $saveArr['BookingRateDetail']['created'] = date("Y-m-d H:i:s");
                $saveArr['BookingRateDetail']['device_type'] = 1;
                $saveArr['BookingRateDetail']['other_params'] = json_encode($AdjustArr);


                $saveArr['BookingRateDetail']['g_to_g'] = $fareData['RateDetail']['g_to_g'];
                $saveArr['BookingRateDetail']['not_refundable'] = $fareData['RateDetail']['not_refundable'];
                if (isset($fareData['Package']) && !empty($fareData['Package'])) {
                    $saveArr['BookingRateDetail']['kms'] = $fareData['Package']['kms'];
                    $saveArr['BookingRateDetail']['hour'] = $fareData['Package']['hour'];
                }
//pr($saveArr);exit;
                $this->BookingRateDetail->save($saveArr);
                //exit;
//created
//pr($saveArr);
            }
        }
        return true;
    }

    function time_categories() {
        $this->loadModel("TimeCategory");
        $lists = $this->TimeCategory->find('all', array(
        ));
        $rArr = array();
        if (!empty($lists)) {
            foreach ($lists as $ldata) {
                $rArr[$ldata['TimeCategory']['min_hours'] . "_" . $ldata['TimeCategory']['range_type'] . "_" . $ldata['TimeCategory']['max_hours']] = $ldata['TimeCategory']['title_range'];
            }
        }
        return $rArr;
    }

    public function update_vendor_incentive($user_id, $trip_id, $amount) {

        $this->loadModel('Payment');
        $this->Payment->create();
        $arr_pay['Payment']['user_id'] = $user_id;
        $arr_pay['Payment']['trip_id'] = $trip_id;
        $arr_pay['Payment']['amount_type'] = 0;
        $arr_pay['Payment']['type'] = 9;
        $arr_pay['Payment']['created'] = date("Y-m-d H:i:s");
        $arr_pay['Payment']['amount'] = $amount;
        $this->loadModel('User');
        $this->User->create();
        $user_dtls = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ),
            'fields' => array("total_balance"),
        ));

        $total_balance = $user_dtls['User']['total_balance'];
        $balance = $total_balance + $amount;
        $arr_pay['Payment']['balance'] = $balance;
        $description = "Urgent Booking Incentive";
        $arr_pay['Payment']['description'] = $description;
        //pr($arr_pay); exit;
        $this->Payment->save($arr_pay);

        $date_time = date("Y-m-d H:i:s");
        $qry = "update users set users.total_balance=$balance WHERE users.id=" . $user_id;
        $this->User->query($qry);
    }

    public function update_driver_incentive($user_id, $trip_id, $amount) {

        $this->loadModel('DriverSos');
        $this->DriverSos->create();
        $arr_pay['DriverSos']['user_id'] = $user_id;
        $arr_pay['DriverSos']['trip_id'] = $trip_id;
        $arr_pay['DriverSos']['amount_type'] = 0;
        $arr_pay['DriverSos']['type'] = 1;
        $arr_pay['DriverSos']['created'] = date("Y-m-d H:i:s");
        $arr_pay['DriverSos']['amount'] = $amount;
        $this->loadModel('User');
        $this->User->create();
        $user_dtls = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ),
            'fields' => array("total_balance"),
        ));

        $total_balance = $user_dtls['User']['total_balance'];
        $balance = $total_balance + $amount;
        $arr_pay['DriverSos']['balance'] = $balance;
        $description = "Incentive";
        $arr_pay['DriverSos']['description'] = $description;
        //pr($arr_pay); exit;
        $this->DriverSos->save($arr_pay);

        $date_time = date("Y-m-d H:i:s");
        $qry = "update users set users.total_balance=$balance WHERE users.id=" . $user_id;
        $this->User->query($qry);
    }

    public function update_vendor_mounthly_incentive($user_id, $bookingid, $trip_id, $amount, $type) {

        $this->loadModel('Payment');
        $this->Payment->create();
        $arr_pay['Payment']['user_id'] = $user_id;
        $arr_pay['Payment']['trip_id'] = $trip_id;
        if ($type == 'cr') {
            $arr_pay['Payment']['amount_type'] = 0;
            $description = "Booking Rating Incentive";
            $arr_pay['Payment']['type'] = 10;
        } else {
            $arr_pay['Payment']['amount_type'] = 1;
            $description = "Booking Rating Penalties";
            $arr_pay['Payment']['type'] = 11;
        }

        $arr_pay['Payment']['created'] = date("Y-m-d H:i:s");
        $arr_pay['Payment']['amount'] = $amount;
        $this->loadModel('User');
        $this->User->create();
        $user_dtls = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ),
            'fields' => array("total_balance"),
        ));

        $total_balance = $user_dtls['User']['total_balance'];
        if ($type == 'cr') {
            $balance = $total_balance + $amount;
        } else {
            $balance = $total_balance - $amount;
        }
        $arr_pay['Payment']['balance'] = $balance;

        $arr_pay['Payment']['description'] = $description;
        //pr($arr_pay); exit;
        $this->Payment->save($arr_pay);

        $date_time = date("Y-m-d H:i:s");
        $qry = "update users set users.total_balance=$balance WHERE users.id=" . $user_id;
        $this->User->query($qry);

        $date_time = date("Y-m-d H:i:s");
        $qry = "update customer_ratings set customer_ratings.is_paid=1 WHERE customer_ratings.bookingid=" . $bookingid;
        $this->User->query($qry);
    }

    public function update_driver_mounthly_incentive($user_id, $booking_id, $trip_id, $amount, $type) {

        $this->loadModel('DriverSos');
        $this->DriverSos->create();
        $arr_pay['DriverSos']['user_id'] = $user_id;
        $arr_pay['DriverSos']['trip_id'] = $trip_id;
        if ($type == 'Dr') {
            $arr_pay['DriverSos']['amount_type'] = 1;
            $arr_pay['DriverSos']['type'] = 2;
            $description = "Penalties";
        } else {
            $arr_pay['DriverSos']['amount_type'] = 0;
            $arr_pay['DriverSos']['type'] = 1;
            $description = "Incentive";
        }
        $arr_pay['DriverSos']['created'] = date("Y-m-d H:i:s");
        $arr_pay['DriverSos']['amount'] = $amount;
        $this->loadModel('User');
        $this->User->create();
        $user_dtls = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ),
            'fields' => array("total_balance"),
        ));

        $total_balance = $user_dtls['User']['total_balance'];
        if ($type == 'Dr') {
            $balance = $total_balance - $amount;
        } else {
            $balance = $total_balance + $amount;
        }
        $arr_pay['DriverSos']['balance'] = $balance;

        $arr_pay['DriverSos']['description'] = $description;
        //pr($arr_pay); exit;
        $this->DriverSos->save($arr_pay);

        $date_time = date("Y-m-d H:i:s");
        $qry = "update users set users.total_balance=$balance WHERE users.id=" . $user_id;
        $this->User->query($qry);
    }

    public function rate_adjustments($motor_type_id, $booking_type, $from_city_id, $pickup_date, $to_city_name = '', $base_fare, $lat_drop = '', $lng_drop = '') {
        $return = $base_fare;
        $RateAdjustmentID = "";
        $this->loadModel("RateAdjustment");
        $pickup_date = $pickup_date ? $pickup_date : date("Y-m-d");
        $query = " SELECT `RateAdjustmentAmount`.`cust_amount` ,`RateAdjustmentAmount`.`vend_amount`,`RateAdjustment`.`adjustment_type`,`RateAdjustment`.`amount_type`,`RateAdjustment`.`id` from rate_adjustments  as RateAdjustment
					INNER join rate_adjustment_amounts  as RateAdjustmentAmount  on `RateAdjustmentAmount`.`rate_adjustment_id`=`RateAdjustment`.`id` 
					where `RateAdjustment`.`farecategory_id`=$booking_type";
        if ($from_city_id) {
            $query .= " AND FIND_IN_SET($from_city_id,`RateAdjustment`.`city_ids`)";
        }
        if ($motor_type_id) {
            $query .= " AND `RateAdjustmentAmount`.`motor_type_id`=$motor_type_id";
        }
        if ($to_city_name) {
            $query .= " AND (((SUBSTRING_INDEX(`RateAdjustment`.`destination`, ',', 1) = '$to_city_name')) OR (`RateAdjustment`.`dest_lat`='$lat_drop' AND `RateAdjustment`.`dest_long`='$lng_drop'))";
        }


        if ($pickup_date) {
            //$query .= " AND `RateAdjustment`.`start_date` >= '$pickup_date' AND `RateAdjustment`.`end_date` <= '$pickup_date'";
            $query .= " AND (('$pickup_date' BETWEEN `RateAdjustment`.`start_date` AND `RateAdjustment`.`end_date`) OR (`RateAdjustment`.`start_date`='$pickup_date')OR (`RateAdjustment`.`end_date`='$pickup_date'))";
        }

        $query .= " AND `RateAdjustment`.`status`=1";
        $records = $this->RateAdjustment->query($query);

        if (!empty($records)) {
            $records = $records[0];
            $adjust_amount = $records['RateAdjustmentAmount']['cust_amount'];
            $RateAdjustmentID = $records['RateAdjustment']['id'];
            $amount = $adjust_amount;

            if ($records['RateAdjustment']['amount_type'] == 1) {
                $amount = $base_fare * $adjust_amount / 100;
            }
            if ($records['RateAdjustment']['adjustment_type'] == 1) {
                $return = $base_fare - $amount;
            } else {
                $return = $base_fare + $amount;
            }
        }

        $RtArr['BaseFare'] = $return;
        $RtArr['RateAdjustmentID'] = $RateAdjustmentID;
        return $RtArr;
    }

    function mti_update_driver_details($mmtbooking_id, $cab_number, $driver_name, $driver_mobile,$vendor_booking_id) {
        $curl = curl_init();
        $post_arr['type'] = "driverDetail";
        $post_arr['booking_id'] = $mmtbooking_id;
        $post_arr['cab_number'] = $cab_number;
        $post_arr['driver_name'] = $driver_name;
        $post_arr['driver_mobile'] = $driver_mobile;
        $post_arr['vendor_booking_id'] = $vendor_booking_id;
        
        $post_arr = json_encode($post_arr);

        if (URL_DOMAIN == "beta") {
            $url = "122.15.80.250:82/updateCabDriverDetail";
        } else {
            $url = "http://cabs-internal.makemytrip.com/updateCabDriverDetail";
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_arr,
            CURLOPT_HTTPHEADER => array(
                "auth-id: SUPER",
                "auth-token: SUPER123",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        //$this->send_message("917023311807", $response, 1);
        $return_response = 0;
        if (!empty($response)) {
            $response = json_decode($response, true);
            if ($response['status'] == "SUCCESS") {
                $return_response = 1;
            }
        }
        //pr($response);exit;
        curl_close($curl);
        return $return_response;
    }

}
