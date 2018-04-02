<?php/** * @license MIT License (http://www.opensource.org/licenses/mit-license.php) * * PHP version 5 * CakePHP version 1.3 *//** * MotorTypes Users Controller * * @package MotorTypes * @subpackage users.controllers */class TrainingsController extends TrainingAppController {    /**     * Controller name     *     * @var string     */    var $name = 'Trainings';    /**     * Helpers     *     * @var array     */    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');    //public $paginate = array('limit'=>5,'order'=>'MotorType.id','page'=>1);    /**     * Components     *     * @var array     */    public $components = array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');    public $presetVars = array(        array('field' => 'name', 'type' => 'value')    );    // public $presetVars = 	true;    public function beforeFilter() {        parent::beforeFilter();        $this->set('tab_open', 'jobs_training');        $this->set('model', $this->modelClass);        $this->loadModel('Education');        $education_list = $this->Education->find('list', array(            'conditions' => array(                'is_active' => 1,            ),        ));        $this->set('education_list', $education_list);        $this->loadModel('State');        $state_list = $this->State->find('list', array(            'conditions' => array(                'is_active' => 1,            ),        ));        $this->set('state_list', $state_list);        $this->loadModel('TrainingCategory');        $trainingcat_list = $this->TrainingCategory->find('list', array(            'conditions' => array(                'is_active' => 1,            ),        ));        $this->set('trainingcat_list', $trainingcat_list);    }    /**     * Admin Index     *     * @return void     */    function index() {//echo "yo";die;        // Breadcrumb        if (!empty($this->data)) {            $this->Prg->commonProcess();        }        $page = ((isset($this->params->named['page']) && $this->params->named['page'] != "") ? $this->params->named['page'] : 0);        $limitValue = $limit = 50;        $this->set('limitValue', $limitValue);        $this->set('limit', $limit);        $this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;        $parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);                if (!empty($this->request->query)) {            if (isset($this->request->query['code']) && $this->request->query['code'] != "") {                array_push($parsedConditions, array('Training.code' => $this->request->query['code']));                $this->set("code", $this->request->query['code']);            }            if (isset($this->request->query['state_id']) && $this->request->query['state_id'] != "") {                array_push($parsedConditions, array('Training.state_id' => $this->request->query['state_id']));                $this->set("state_id", $this->request->query['state_id']);            }            if (isset($this->request->query['training_category_id']) && $this->request->query['training_category_id'] != "") {                array_push($parsedConditions, array('Training.training_category_id' => $this->request->query['training_category_id']));                $this->set("training_category_id", $this->request->query['training_category_id']);            }        }        $this->paginate = array(            'conditions' => array($parsedConditions),            'limit' => $limit,            'order' => array($this->modelClass . '.id' => 'desc')        );        //pr($this->paginate());        $this->set('result', $this->paginate());        $this->set('page', $page);        $this->set('title_for_layout', 'Trainings');    }    function add() {        if (!empty($this->data)) {            $this->{$this->modelClass}->set($this->data);            //if ($this->{$this->modelClass}->validateAdd()) {            //pr($this->data);exit;            if ($this->data['LanguageMapTraining'][1]['training_name']) {                $datas = array(                    'training_name' => $this->data['LanguageMapTraining'][1]['training_name'],                    'state_id' => $this->data['Training']['state_id'],                    'district_id' => $this->data['Training']['district_id'],                    'code' => $this->data['Training']['code'],                    'training_category_id' => $this->data['Training']['training_category_id'],                    'duration' => $this->data['Training']['duration'],                    'is_active' => 1,                    'created_on' => date("Y-m-d H:i:s"),                    'created_by' => $this->Auth->user('id'),                );                if ($this->{$this->modelClass}->save($datas)) {                    //education_id//                    $latest_id = $this->{$this->modelClass}->id;                    if (!empty($this->data['Training']['education_id'])) {                        $this->loadModel('TrainingEducation');                        $eds = $this->data['Training']['education_id'];                        if (!empty($eds)) {                            foreach ($eds as $ind => $ivalue) {                                $this->TrainingEducation->create();                                $datas2 = array();                                $datas2['TrainingEducation']['education_id'] = $ivalue;                                $datas2['TrainingEducation']['training_id'] = $latest_id;                                $this->TrainingEducation->save($datas2);                            }                        }                    }                    //ALL//                    $j = 0;                    if ($this->data['Training']['district_id']) {                        if ($this->data['Training']['district_id'] == "ALL") {                            $this->loadModel('District');                            $states_list = $this->District->find('all', array(                                'conditions' => array(                                    'District.state_id' => $this->data['Training']['state_id']                                ),                                'fields' => array(                                    'District.id', 'District.name'                                ),                                'recursive' => '-1'                            ));                            if (!empty($states_list)) {                                foreach ($states_list as $datsss) {                                    $d1['TrainingDistrict'][$j]['district_id'] = $datsss['District']['id'];                                    $d1['TrainingDistrict'][$j]['training_id'] = $latest_id;                                    $j++;                                }                            }                        } else {                            $d1['TrainingDistrict'][$j]['district_id'] = $this->data['Training']['district_id'];                            $d1['TrainingDistrict'][$j]['training_id'] = $latest_id;                        }                        //pr($d1['TrainingDistrict']);exit;                        $this->loadModel('TrainingDistrict');                        $this->TrainingDistrict->saveAll($d1['TrainingDistrict']);                    }                    $this->loadModel('LanguageMapTraining');                    $languageStates = $this->data['LanguageMapTraining'];                    foreach ($languageStates as $lang_id => $ldata) {                        $datas2 = array();                        $this->LanguageMapTraining->create();                        $datas2['LanguageMapTraining']['training_name'] = $ldata['training_name'];                        $datas2['LanguageMapTraining']['description'] = $ldata['description'];                        $datas2['LanguageMapTraining']['training_id'] = $latest_id;                        $datas2['LanguageMapTraining']['language_id'] = $lang_id;                        $this->LanguageMapTraining->save($datas2);                    }                    $this->Session->setFlash('Training has been added.', 'success');                    $this->redirect(array('action' => 'index'));                }            } else {                $this->Session->setFlash('Enter in English.', 'error');                $this->redirect(array('action' => 'add'));            }            //}        }        $this->set('title_for_layout', 'Add New Training');    }    function edit($id = null) {        $this->set('id', $id);        $user = $this->{$this->modelClass}->findById($id);        $lanArr = array();        $lanArrD = array();        $educationArr = array();        if (!empty($user)) {            $statl = $user['LanguageMapTraining'];            foreach ($statl as $new) {                $lanArr[$new['language_id']] = $new;            }            if (!empty($user['TrainingEducation'])) {                foreach ($user['TrainingEducation'] as $edArr) {                    $educationArr[] = $edArr['education_id'];                }            }        }        $user['LanguageMapTraining'] = $lanArr;        $user['Training']['education_id'] = $educationArr;        $this->{$this->modelClass}->set($user);        $this->set('record', $user);        //pr($user);        if (empty($this->data)) {            $this->data = $user;        } else {            $this->{$this->modelClass}->set($this->data);            //if ($this->{$this->modelClass}->validateUpdate()) {            if ($this->data['LanguageMapTraining'][1]['training_name']) {                $datas = array(                    'training_name' => $this->data['LanguageMapTraining'][1]['training_name'],                    'state_id' => $this->data['Training']['state_id'],                    'district_id' => $this->data['Training']['district_id'],                    'code' => $this->data['Training']['code'],                    'training_category_id' => $this->data['Training']['training_category_id'],                    'duration' => $this->data['Training']['duration'],                    'is_active' => 1,                    'modified_by' => $this->Auth->user('id'),                    'modified_on' => date("Y-m-d H:i:s"),                    'id' => $this->data['Training']['id'],                );                if ($this->{$this->modelClass}->save($datas)) {                    //education_id//                    $this->loadModel('TrainingEducation');                    $latest_id = $id;                    $this->TrainingEducation->deleteAll(array("TrainingEducation.training_id" => $id));                    if (!empty($this->data['Training']['education_id'])) {                        $eds = $this->data['Training']['education_id'];                        if (!empty($eds)) {                            foreach ($eds as $ind => $ivalue) {                                $this->TrainingEducation->create();                                $datas2 = array();                                $datas2['TrainingEducation']['education_id'] = $ivalue;                                $datas2['TrainingEducation']['training_id'] = $latest_id;                                $this->TrainingEducation->save($datas2);                            }                        }                    }                    //ALL//                    $j = 0;                    $this->loadModel('TrainingDistrict');                    $this->TrainingDistrict->deleteAll(array("TrainingDistrict.training_id" => $id));                    if ($this->data['Training']['district_id']) {                        if ($this->data['Training']['district_id'] == "ALL") {                            $this->loadModel('District');                            $states_list = $this->District->find('all', array(                                'conditions' => array(                                    'District.state_id' => $this->data['Training']['state_id']                                ),                                'fields' => array(                                    'District.id', 'District.name'                                ),                                'recursive' => '-1'                            ));                            if (!empty($states_list)) {                                foreach ($states_list as $datsss) {                                    $d1['TrainingDistrict'][$j]['district_id'] = $datsss['District']['id'];                                    $d1['TrainingDistrict'][$j]['training_id'] = $latest_id;                                    $j++;                                }                            }                        } else {                            $d1['TrainingDistrict'][$j]['district_id'] = $this->data['Training']['district_id'];                            $d1['TrainingDistrict'][$j]['training_id'] = $latest_id;                        }                        //pr($d1['TrainingDistrict']);exit;                        $this->TrainingDistrict->saveAll($d1['TrainingDistrict']);                    }                    $this->loadModel('LanguageMapTraining');                    $this->LanguageMapTraining->deleteAll(array("LanguageMapTraining.training_id" => $id));                    $languageStates = $this->data['LanguageMapTraining'];                    foreach ($languageStates as $lang_id => $ldata) {                        $datas2 = array();                        $this->LanguageMapTraining->create();                        $datas2['LanguageMapTraining']['training_name'] = $ldata['training_name'];                        $datas2['LanguageMapTraining']['description'] = $ldata['description'];                        $datas2['LanguageMapTraining']['training_id'] = $latest_id;                        $datas2['LanguageMapTraining']['language_id'] = $lang_id;                        $this->LanguageMapTraining->save($datas2);                    }                    $this->Session->setFlash('Training has been updated.', 'success');                    $this->redirect(array('action' => 'index'));                }            }            //}        }        $this->set('title_for_layout', 'Update Training');    }    public function change_status() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $data['is_active'] = $this->data['status'] == 1 ? false : true;                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                echo json_encode(array('succ' => 1, 'msg' => 'Status has been changed.'));                die;            }        }        exit;    }    public function get_district_list() {        $this->autoLayout = false;        $this->autoRender = false;        $state_id = $this->request->data('state_id');        $district_id = @$this->request->data('district_id');        if ($this->request->is('ajax')) {            $this->loadModel('District');            $states_list = $this->District->find('all', array(                'conditions' => array(                    'District.state_id' => $state_id                ),                'fields' => array(                    'District.id', 'District.name'                ),                'recursive' => '-1'            ));            $html = "<option value=''>Select</option>";            if ($district_id == "ALL") {                $html .= "<option selected='selected' value='ALL'>All District</option>";            } else {                $html .= "<option value='ALL'>All District</option>";            }            foreach ($states_list as $state) {                $selected = "";                if ($district_id) {                    if ($district_id == $state['District']['id']) {                        $selected = 'selected="selected"';                    }                }                $html .= "<option " . $selected . " value='" . $state['District']['id'] . "'>" . $state['District']['name'] . "</option>";            }            echo $html;        }    }}