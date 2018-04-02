<?php

App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class Category extends AppModel {

    public $name = 'Category';
    
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Name can\'t be empty',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 3, 50),
                'message' => 'Name must be between %d and %d characters',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Category already exist, please use different name',
                'on' => 'create'
            )
        )
    );

}

?>