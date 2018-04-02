<?php

App::uses('Security', 'Utility');
App::import('model', 'City');

class AccessPermission extends AccessRightCategoryAppModel {

    public $name = 'AccessPermission';
    public $validate = array();

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    }

    function savePermission($userId, $postData) {
        //$db = $this->getDataSource();
        //$city_list = $db->fetchAll('SELECT * FROM cities where status="A"');

        if (isset($postData['AccessRightCategory']['Language'])) {
            $userDetails['Language'] = $postData['AccessRightCategory']['Language'];
        }

        if (isset($postData['AccessRightCategory']['State'])) {
            $userDetails['State'] = $postData['AccessRightCategory']['State'];
        }
        
        if (isset($postData['AccessRightCategory']['Disctict'])) {
            $userDetails['Disctict'] = $postData['AccessRightCategory']['Disctict'];
        }
        if (isset($postData['AccessRightCategory']['Block'])) {
            $userDetails['Block'] = $postData['AccessRightCategory']['Block'];
        }

        
        if (isset($postData['AccessRightCategory']['Education'])) {
            $userDetails['Education'] = $postData['AccessRightCategory']['Education'];
        }
        if (isset($postData['AccessRightCategory']['Technical_Courses'])) {
            $userDetails['Technical_Courses'] = $postData['AccessRightCategory']['Technical_Courses'];
        }
        if (isset($postData['AccessRightCategory']['Job_Categories'])) {
            $userDetails['Job_Categories'] = $postData['AccessRightCategory']['Job_Categories'];
        }
        
        
        if (isset($postData['AccessRightCategory']['Training_Categories'])) {
            $userDetails['Training_Categories'] = $postData['AccessRightCategory']['Training_Categories'];
        }
        if (isset($postData['AccessRightCategory']['Jobs'])) {
            $userDetails['Jobs'] = $postData['AccessRightCategory']['Jobs'];
        }
        if (isset($postData['AccessRightCategory']['Trainings'])) {
            $userDetails['Trainings'] = $postData['AccessRightCategory']['Trainings'];
        }
        
        if (isset($postData['AccessRightCategory']['System_Roles'])) {
            $userDetails['System_Roles'] = $postData['AccessRightCategory']['System_Roles'];
        }
        if (isset($postData['AccessRightCategory']['System_Users'])) {
            $userDetails['System_Users'] = $postData['AccessRightCategory']['System_Users'];
        }
        
        if (isset($postData['AccessRightCategory']['masters'])) {
            $userDetails['masters'] = $postData['AccessRightCategory']['masters'];
        }
        if (isset($postData['AccessRightCategory']['jobtraining'])) {
            $userDetails['jobtraining'] = $postData['AccessRightCategory']['jobtraining'];
        }
        if (isset($postData['AccessRightCategory']['accesscontrol'])) {
            $userDetails['accesscontrol'] = $postData['AccessRightCategory']['accesscontrol'];
        }
        
        
       

        if (!empty($userDetails)) {
            foreach ($userDetails as $field => $value) {
                $newDetail = array();
                $this->create();
                $newDetail['AccessPermission']['access_right_category_id'] = $userId;
                $newDetail['AccessPermission']['field_name'] = $field;
                $newDetail['AccessPermission']['field_value'] = $value;
                $this->save($newDetail, false);
            }
        }
    }

}
