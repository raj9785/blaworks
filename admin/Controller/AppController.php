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
        $scope = array('User.status' => 1);
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

        $this->layout = 'admin';
        $this->Auth->loginRedirect = $loginRedirect;
        $this->Auth->logoutRedirect = $logoutRedirect;
        $this->Auth->loginAction = $loginAction;
        $this->Auth->allow('login', 'download');
        $alerts_Arr = array();

        $this->loadModel('User');
        $id_user = $this->Auth->user('id');
        $user_dtl = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $id_user,
            ),
        ));

        $this->set('loggedin_user', $this->Auth->user());
        $this->loggedin_user = $this->Auth->user();

        $this->loadModel('Language');
        $language_list = $this->Language->find('all', array(
            'conditions' => array(
                'is_active' => 1,
            ),
        ));
        $this->set('language_list', $language_list);
        //$permissions=array();
        if($user_dtl['User']['user_role_id']!=1){
        $this->loadModel('AccessPermission');
        $permissions = $this->AccessPermission->find('list', array('fields' => array('field_name', 'field_value'), 'conditions' => array('access_right_category_id' => $user_dtl['User']['access_right_category_id'])));
        //pr($permissions);
        $this->set('permissions', $permissions);
        }
        //$this->permissions = $permissions;
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

    public function send_message($phone_no, $msg, $no_response = '') {
        if ($phone_no) {
            $url = "http://www.onextelbulksms.in/shn/api/pushsms.php?usr=621708&key=010Bs0BM003kiGZBElNV40iLv9JhqD&sndr=ALERTS&ph=" . $phone_no . "&text=" . $msg . "&rpt=1";

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

    public function isAuthorized() {
        return true;
    }

    function download($filename, $type = '') {
        if ($type == 'doc') {
            $downloadPath = USER_DOC_STORE_PATH;
        } else if ($type == 'taxiimg') {
            $downloadPath = TAXI_IMAGE_STORE_PATH_IMAGE;
        } else if ($type == 'userdoc') {
            $downloadPath = USERDOCS;
        } else if ($type == 'taxidoc') {
            $downloadPath = TAXIIMAGE;
        } else if ($type == "driverdoc") {
            $downloadPath = USER_DOC_STORE_PATH;
        } else if ($type == "vendrodoc") {
            $downloadPath = ALBUM_UPLOAD_IMAGE_PATH;
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

}
