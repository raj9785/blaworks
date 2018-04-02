<?php

class MotorModel extends MotorModelAppModel {

    var $name = 'MotorModel';
    public $actsAs = array('Containable', 'Search.Searchable',
    );
    // var $actsAs 		= 	array('Tree');
    public $belongsTo = array("Motor", "MotorType");
    public $filterArgs = array(
        array('name' => 'name', 'type' => 'string')
    );
    public $validate = array(
        'name' => array(
            'valid' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Please enter a value for MotorModel .'
            )
        )
    );

}

?>
