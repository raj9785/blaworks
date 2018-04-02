<?phpclass JobCategory extends JobCategoryAppModel {    var $name = 'JobCategory';    public $actsAs = array('Containable', 'Search.Searchable',    );    // var $actsAs 		= 	array('Tree');    public $filterArgs = array(        array('name' => 'name', 'type' => 'string')    );    public $validate = array();    public $belongsTo = array(        "Created" => array(            "className" => "User",            "foreignKey" => "created_by",            'fields' => array("id", "firstname", "lastname"),        ),        "Modified" => array(            "className" => "User",            "foreignKey" => "modified_by",            'fields' => array("id", "firstname", "lastname"),        ),//        "Education" => array(//            "className" => "Education",//            "foreignKey" => "education_id",//            'fields' => array("id", "name"),//        ),    );    public $hasMany = array(        'LanguageMapJobCategory',    );    public function validateAdd() {        $my_validate = array(            'code' => array(                'valid' => array(                    'rule' => 'notEmpty',                    'required' => true,                    'allowEmpty' => false,                    'on' => 'create',                    'message' => 'Please enter code .'                ),                'mustUnique' => array(                    'rule' => 'isUnique',                    'message' => __('This value is already exist.'),                )            )        );        $this->validate = $my_validate;        return $this->validates();    }    public function validateUpdate() {        $my_validate = array(            'code' => array(                'valid' => array(                    'rule' => 'notEmpty',                    'required' => true,                    'allowEmpty' => false,                    'on' => 'update',                    'message' => 'Please enter code .'                ),                'mustUnique' => array(                    'rule' => 'isUnique',                    'message' => __('This value is already exist.'),                )            )        );        $this->validate = $my_validate;        return $this->validates();    }}?>