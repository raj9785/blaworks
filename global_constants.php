<?php

define('SUBDIR', '/');
define('SUBDIR_IMAGE', '/');
define('DBHOST', "mariadb-135.wc1");
define('DBUSERNAME', "2010123_blworku");
define('DBPASSWORD', "Blworks@123");
define('DB', "2010123_blworks_db");
/* * **************************************** End Database details ***************************************** */
/* * **************************************** End Database details ***************************************** */
define('WEBSITE_URL', 'http://www.blahworks.in/jobsite/');
define('WEBSITE_URL_IMAGE', "http://www.blahworks.in/jobsite/");

define('WEBSITE_JS_URL', WEBSITE_URL . 'js/');
define('WEBSITE_CSS_URL', WEBSITE_URL . 'css/');
define('WEBSITE_IMAGE_URL', WEBSITE_URL . 'img/');
define('WEBSITE_IMG_URL', WEBSITE_URL . 'img/');
define('WEBSITE_IMAGES_URL', WEBSITE_URL . 'images/');
define('WEBSITE_APP_WEBROOT_ROOT_PATH', dirname(__FILE__) . '/app/webroot/');
define('WEBSITE_ADMIN_WEBROOT_ROOT_PATH', dirname(__FILE__) . '/admin/');

define('WEBSITE_COMPANY_WEBROOT_ROOT_PATH', dirname(__FILE__) . '/company');

define('WEBSITE_APP_WEBROOT_IMG_ROOT_PATH', dirname(__FILE__) . '/app/webroot/img/');
define('PROFILE_PIC_STORE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH . 'uploads/users/');
define('DEFAULT_DATE_FORMAT', "m/d/Y");

define('CATEGORY_WBROOT_PATH_ICONS', WEBSITE_ADMIN_WEBROOT_ROOT_PATH . "webroot/uploads/category_icons/");
define("HTTP_PATH_CATEGORY_ICONS", WEBSITE_URL . '/admin/uploads/category_icons/');

define('JOB_WBROOT_PATH_ICONS', WEBSITE_ADMIN_WEBROOT_ROOT_PATH . "webroot/uploads/jobs/");
define("HTTP_PATH_JOB_ICONS", WEBSITE_URL . '/admin/uploads/jobs/');

/* * **************************************** Include all settings ***************************************** */
require_once('settings.php');

$config['defaultPaginationLimit'] = 10;
/* Admin Configuration */
if (!defined('APP_CACHE_PATH')) {
    define("APP_CACHE_PATH", ROOT . '/app/tmp/cache');
}
if (!defined('ADMIN_FOLDER')) {
    define("ADMIN_FOLDER", "admin");
}
if (!defined('WEBSITE_ADMIN_URL')) {
    define("WEBSITE_ADMIN_URL", WEBSITE_URL . ADMIN_FOLDER . '/');
}
if (!defined('WEBSITE_ADMIN_IMG_URL')) {
    define("WEBSITE_ADMIN_IMG_URL", WEBSITE_ADMIN_URL . 'img/');
}
if (!defined('WEBSITE_ADMIN_JS_URL')) {
    define("WEBSITE_ADMIN_JS_URL", WEBSITE_ADMIN_URL . 'js/');
}
if (!defined('WEBSITE_ADMIN_CS_URL')) {
    define("WEBSITE_ADMIN_CS_URL", WEBSITE_ADMIN_URL . 'css/');
}






if (!defined('APP_WEBROOT_ROOT_PATH')) {
    define("APP_WEBROOT_ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . SUBDIR . 'app/webroot/');
}
if (!defined('APP_WEBROOT_ROOT_PATH_IMAGE')) {
    define("APP_WEBROOT_ROOT_PATH_IMAGE", $_SERVER['DOCUMENT_ROOT'] . SUBDIR_IMAGE . 'app/webroot/');
}

if (!defined('APP_UPLOADS_ROOT_PATH_IMAGE')) {
    define("APP_UPLOADS_ROOT_PATH_IMAGE", APP_WEBROOT_ROOT_PATH_IMAGE . 'uploads/');
}
if (!defined('APP_UPLOADS_HTTP_PATH_IMAGE')) {
    define("APP_UPLOADS_HTTP_PATH_IMAGE", WEBSITE_URL_IMAGE . 'uploads/');
}


$config['USER_ROLE_ID'] = array('admin' => 1, 2 => 'company', 3 => 'customer', 4 => 'driver', 5 => 'individual', 6 => 'Employee', '7' => 'Dispatcher');



if (!defined('SETTING_FILE_PATH')) {
    define("SETTING_FILE_PATH", ROOT . '/settings.php');
}




$config['valid_mime_types'] = array('image/jpeg', 'image/png', 'image/gif', 'image/pjpeg');
$config['file_valid_mime_types'] = array('text/plain', 'text/plain', 'text/plain', 'text/plain');
$config['valid_image_types'] = array('jpg', 'jpeg', 'png', 'gif', 'pjpeg');
$config['valid_image_size'] = 52428800; //50MB
$config['global_ids'] = array(
    'email_template' =>
    array(
        'registration_successfull' => 1,
        'verification_email' => 2,
        'forgot_password' => 3,
        'user_password_changed_successfully' => 4,
        'campaign_highlight_confirmation' => 14,
        'campaign_activated' => 6,
        'social_register' => 16,
        'subscription' => 17,
    ),
    'admin_default_image' =>
    array(
        'setting_default_image' => 72)
);
$config['date_format'] = array('basic' => 'd M, Y h:i a', 'profile' => 'F d, Y');
$config['front_date_format'] = array('basic' => 'M d, Y h:i a', 'profile' => 'd/m/Y');
$config['date_picker_formate'] = 'dd/mm/yy';
$config['Action_options'] = array('Registration' => 'Registration', 'VerificationMail' => 'Verification Email', 'Forgot Password' => 'Forgot Password', 'UserPasswordChangedSuccessfully' => 'Reset Forgot Password', 'campaign_activated' => 'Campaign Activated', 'subscription' => 'Subscription');
$config['registration'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL', 'verify_link' => 'VERIFY_LINK');
$config['register_verify'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL');
$config['forgot_password'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL', 'reset_link' => 'RESET');
$config['reset_forgot_password'] = array('email' => 'EMAIL_ADDRESS', 'website_url' => 'WEBSITE_URL');
$config['campaign_activated'] = array('partner_name' => 'PARTNER_NAME', 'campaign_name' => 'CAMPAIGN_NAME', 'start_date' => 'START_DATE', 'end_date' => 'END_DATE', 'price' => 'PRICE');


define('PDF_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><script  type="text/php">$pdf->page_text(550, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, $color);</script><div style="text-align:right;float;right"><img src="' . WEBSITE_APP_WEBROOT_ROOT_PATH . 'img/main-logo.png' . '" ></div><br/><br/><table class="Table" width="100%" colspan="0" cellpadding="0" cellspacing="0" style="border:1px solid #000;"><tr>');

define('PRINT_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><img src="' . WEBSITE_APP_WEBROOT_ROOT_PATH . 'img/main-logo.png' . '"><br/><br/>');


define('PDF_FOOTER_HTML', '</br></br>&nbsp;' . Configure::read('Site.Copyright_text'));


define('MAIL_PORT', 25);
define('PAGELIMIT', 1);
define('MAIL_HOST', 'mail.uptostart.com');
define('MAIL_USERNAME', 'aniima@aniima.uptostart.com');
define('MAIL_PASSWORD', 'Champ@123');
define('MAIL_CLIENT', 'gmail.com');



define('VERIFY_SMS_MESSAGE', 'Hi,please use OTP %d to verify your iCab account.Code valid only for 10 minutes.');
define('NEWPASSWORD_SMS_MESSAGE', 'Hi,Your new password is %d.Please change your password next time you log in.');



define('URL_DOMAIN', "live"); 



define("SITE_ADDRESS_LINE1", "");
define("SITE_ADDRESS_LINE2", "");
define("SITE_ADDRESS_LINE3", "");
define("SITE_ADDRESS_LINE4", "");
define("SITE_ADDRESS_LINE5", "");
define("SITE_ADDRESS_LINE6", "");



if (!defined('HOTEL_MOB_IMAGE_PATH')) {
    define("HOTEL_MOB_IMAGE_PATH", APP_UPLOADS_ROOT_PATH_IMAGE . 'hotel/mobile/');
}
if (!defined('HOTEL_MOB_LARGE_IMAGE_PATH')) {
    define("HOTEL_MOB_LARGE_IMAGE_PATH", APP_UPLOADS_ROOT_PATH_IMAGE . 'hotel/mobile/large/');
}
if (!defined('HOTEL_MOB_MID_IMAGE_PATH')) {
    define("HOTEL_MOB_MID_IMAGE_PATH", APP_UPLOADS_ROOT_PATH_IMAGE . 'hotel/mobile/middle/');
}
if (!defined('HOTEL_MOB_SMALL_IMAGE_PATH')) {
    define("HOTEL_MOB_SMALL_IMAGE_PATH", APP_UPLOADS_ROOT_PATH_IMAGE . 'hotel/mobile/small/');
}


define("DATETIME_FORMAT", "d-m-y h:i A");

define("COPYWRITE", "SkillsHaat. A Property of Bhilwara Group. All Rights Reserved."); //% amount increase
define('SITETITLE', "SkillsHaat"); 


?>
