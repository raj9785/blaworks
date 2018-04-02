<?php

class VendorVehicle extends MotorModelAppModel {

    var $name = 'VendorVehicle';
    public $actsAs = array('Containable', 'Search.Searchable',
    );
    // var $actsAs 		= 	array('Tree');
    //public $belongsTo = array("Motor", "MotorType");
     public $belongsTo = array(
     "Vendor"=>array('className'=>'User','foreignKey'=>'vendor_id'),
							  "Taxi"=>array('className'=>'Taxi','foreignKey'=>'taxi_id'));
							
    public $filterArgs = array(
        array('name' => 'name', 'type' => 'string')
    );
    public $validate = array(
        'name' => array(
            'valid' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Please enter a value for Vendor Vehicle .'
            )
        )
    );

}

?>
