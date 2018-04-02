<?php

App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Page extends AppModel {

    public $name = 'Page';
    public $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Page title can\'t be empty',
                'allowEmpty' => false
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Page with this title already exists, please use different one',
                'on' => 'create'
            )

        ),      
    );

    public function validEmail($email) {
        $regExp = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
        if (!preg_match($regExp, $email['email'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_passwords() {
        return $this->data[$this->alias]['user_password'] === $this->data[$this->alias]['confirm_password'];
    }

    public function validate_passwords_admin() {
        return $this->data[$this->alias]['admin_password'] === $this->data[$this->alias]['admin_confirm_password'];
    }

    public function allowNumberOnly($number) {
        if (!is_numeric($number['mobile'])) {
            return FALSE;
        } else {
            return true;
        }
    }

}
