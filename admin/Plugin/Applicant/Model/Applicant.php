<?phpclass Applicant extends ApplicantAppModel {    var $name = 'Applicant';    public $actsAs = array(        'Containable', 'Search.Searchable',    );    public $filterArgs = array(        array('name' => 'Invoice_invoice_number', 'type' => 'query', 'method' => 'filterQuery'),    );    public $hasOne = array(        "ApplicantExtendedProfile" => array(            "foreignKey" => "applicant_id"        ),    );    public $belongsTo = array(        "Education" => array(            //"foreignKey" => "applicant_id"            'fields' => array("id", "name"),        ),        "State" => array(            //"foreignKey" => "applicant_id"            'fields' => array("id", "name"),        ),        "District" => array(            //"foreignKey" => "applicant_id"            'fields' => array("id", "name"),        ),        "Block" => array(            //"foreignKey" => "applicant_id"            'fields' => array("id", "name"),        ),        "Panchayat" => array(            //"foreignKey" => "applicant_id"            'fields' => array("id", "name"),        ),        "TechnicalCourse" => array(            //"foreignKey" => "applicant_id"            'fields' => array("id", "name"),        ),    );    public $hasMany = array(        "ApplicantLanguage" => array(            'className' => 'ApplicantLanguage',            "foreignKey" => "applicant_id"        )    );    public $validate = array();    public function state_filterQuery($data = array()) {        if (!isset($data['customer_name'])) {            return array();        }        $query = '%' . $data['customer_name'] . '%';        return array(            'Booking.customer_name LIKE' => $query        );    }}?>