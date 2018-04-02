<?php
class Motor extends MotorAppModel {
	var $name 			= 	'Motor';
	public $actsAs = array('Containable','Search.Searchable',
						
						  );

	// var $actsAs 		= 	array('Tree');
	 
	public $filterArgs 	= 	array(
		array('name' => 'name', 'type' => 'string')
	);
	
	
	public $validate 	= 	array(
								'name' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter a value for Motor .'
											)
									)
							); 

}
?>