<?php

App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {

    public $name = 'User';
    public $validate = array(
        'full_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Name can\'t be empty',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 3, 50),
                'message' => 'Name must be between %d and %d characters',
            )
        ),
        'email' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Email can\'t be empty',
                'allowEmpty' => false
            ),
            'validEmail' => array(
                'rule' => array('validEmail'),
                'message' => 'Please enter valid email address',
                'allowEmpty' => false
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Email already exists, please use different one',
                'on' => 'create'
            )

        ),
        'mobile' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Mobile number can\'t be empty',
                'allowEmpty' => false
            ),
            'allowNumberOnly' => array(
                'rule' => array('allowNumberOnly'),
                'message' => 'Phone number should be numeric only',
                'allowEmpty' => false
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Phone no already registered, please use different number',
                'on' => 'create'
            )
        ),
        'user_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password can\'t be empty',
                'allowEmpty' => false
            ),
        ),
        'confirm_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm password',
                'allowEmpty' => false
            ),
            'compare' => array(
                'rule' => array('validate_passwords'),
                'message' => 'Both Passwords do not match'
            )
        ),
        'admin_old_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Old Password can\'t be empty',
                'allowEmpty' => false
            )
        ),
        'admin_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password can\'t be empty',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 6, 20),
                'message' => 'Password must be between %d and %d characters',
            )
        ),
        'admin_confirm_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Confirm password can\'t be empty',
                'allowEmpty' => false
            ),
            'compare' => array(
                'rule' => array('validate_passwords_admin'),
                'message' => 'The passwords you entered do not match.',
            )
        )
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
