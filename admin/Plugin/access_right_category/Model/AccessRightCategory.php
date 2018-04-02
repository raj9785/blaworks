<?phpclass AccessRightCategory extends AccessRightCategoryAppModel {    var $name = 'AccessRightCategory';    public $actsAs = array('Containable', 'Search.Searchable');       public $filterArgs = array(	array('name' => 'farecategory_id', 'type' => 'string'),	array('name' => 'state_id', 'type' => 'string'),	array('name' => 'city_id', 'type' => 'string'),    );         public $hasMany = array('AccessPermission' => array('className' => 'AccessRightCategory.AccessPermission','foreignkey' => 'access_right_category_id'));    /* public $belongsTo = array(      'Timemgmt',      'Airport',      'State' => array(      'className' => 'State',      //'conditions' => array('State.id' => 'Fare.state_id')      ),      'City' => array(      'className' => 'City',      //'conditions' => array('City.id' => 'Fare.city_id')      ),      'Farecategory' => array(      'className' => 'Farecategory',      //'conditions' => array('Farecategory.id' => 'Fare.farecategory_id')      ),      'Motortype' => array(      'className' => 'MotorType',      //'conditions' => array('Motortype.id' => 'Fare.motortype_id')      )      ); */    function CheckValidCategory() {	$validate1 = array(	    'name' => array(		'valid' => array(		    'rule' => 'notEmpty',		    'required' => true,		    'allowEmpty' => false,		    'message' => 'Please enter category name.'		),		'mustUnique' => array(		    'rule' => 'isUnique',		    //'on'=>'create',		    'message' => 'This category is already exist',		),	    )	);	$this->validate = $validate1;	return $this->validates();    }}?>