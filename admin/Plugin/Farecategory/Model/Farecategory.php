<?php
class Farecategory extends FarecategoryAppModel {
	

/**
 * Name
 *
 * @var string
 */
	public $name = 'Farecategory';
	

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable','Search.Searchable'/* ,
							'Utils.Sluggable' => array('label' => 'page_type',
														'method' => 'multibyteSlug'
													  ) */
						  );

/**
 * Additional Find methods
 *
 * @var array
 */
	public $_findMethods = array('search' => true);

/**
 * @todo comment me
 *
 * @var array
 */
	public $filterArgs = array(
									array('name' => 'name', 
										  'type' => 'string'
										 )
							  );

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'name';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array();

/**
 * Validation parameters
 *
 * @var array
 */
	public $validate = array();

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	 public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);
		}
		
	function validateAdd() {
		$my_validate 	= 	array(
								'name' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => 'Please enter Fare category.'
											),
											
											'mustUnique'=>array(
													'rule' =>'isUnique',
													'message' => __('This name is already exist in our system.'),
												)
									)
							); 
		$this->validate=$my_validate;
		return $this->validates();					
		
	}
}
?>