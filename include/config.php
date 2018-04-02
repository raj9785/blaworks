<?php
define('DB_USERNAME', '2010123_blworku');
define('DB_PASSWORD', 'Blworks@123');
define('DB_HOST', 'mariadb-135.wc1');
define('DB_NAME', '2010123_blworks_db');
 
define('USER_CREATED_SUCCESSFULLY', 0);
define('USER_CREATE_FAILED', 1);
define('EMAIL_ALREADY_EXISTED', 2);
define('PHONE_ALREADY_EXISTED', 2);
define('USERNAME_ALREADY_EXISTED', 3);

define('USER_ACCOUNT_DEACTVATED', 4);
define('INVALID_EMAIL_PASSWORD', 5);

define('INVALID_EMAIL', 6);
define('UNABLE_TO_PROCEED', 7);
define('SUCCESSFULLY_DONE', 8);

define('INVALID_OLD_PASSWORD', 9);
define('INVALID_USER', 10);

define('PROFILE_UPDATED_SUCCESSFULLY', 11);

define('ALREADY_EXIST', 12);
define('ALREADY_REPLIED', 13);

define('INVALID_REQUEST', 14);


define('APIURL', 'http://www.blahworks.in/jobsite/admin/');
define('ICON_URL', APIURL.'uploads/category_icons/');
define('PROFILEPICPATHWEBROOT', $_SERVER['DOCUMENT_ROOT'] .'/jobsite/admin/webroot/uploads/profilepic/');
define('PROFILEPICPATHHTTP',  APIURL.'uploads/profilepic/');


define('JOB_PROGRAM_WEBROOT', $_SERVER['DOCUMENT_ROOT'] .'/jobsite/admin/webroot/uploads/jobs/');
define('JOB_PROGRAM_HTTP',  APIURL.'uploads/jobs/');


define('PROFILEPIC', APIURL.'uploads/drivers/photos/');
define('STATUSPIC', APIURL.'/app/webroot/img/');
define('PHYSICALPATH',$_SERVER['DOCUMENT_ROOT'].'/app/webroot/');
define('USERDOCS', APIURL.'uploads/user_documents/');



?>
