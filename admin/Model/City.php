<?php

App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class City extends AppModel {

    public $name = 'City';

    public $belongsTo = array(
	'State' => array(
		'className' => 'State',
		'foreignKey' => 'state_id'		
	),

	'Country' => array(
		'className' => 'Country',
		'foreignKey' => 'country_id'		
	)
    );	

}
