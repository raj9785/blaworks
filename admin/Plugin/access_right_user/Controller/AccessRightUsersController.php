<?php/** * @license MIT License (http://www.opensource.org/licenses/mit-license.php) * * PHP version 5 * CakePHP version 1.3 *//** * Fares Users Controller * * @package Fares * @subpackage users.controllers */class AccessRightUsersController extends AccessRightUserAppController {    /**     * Controller name     *     * @var string     */    var $name = 'AccessRightUsers';    /**     * Helpers     *     * @var array     */    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');    //public $paginate = array('limit'=>5,'order'=>'Country.id','page'=>1);    /**     * Components     *     * @var array     */    public $components = array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');    public $presetVars = array(        array('field' => 'farecategory_id', 'type' => 'value'),        array('field' => 'state_id', 'type' => 'value'),        array('field' => 'city_id', 'type' => 'value'),    );    // public $presetVars = 	true;    public function beforeFilter() {        parent::beforeFilter();        $this->set('model', $this->modelClass);    }    function index() {        $this->set('tab_open', 'accessrightuser');        $pages[__('Dashboard', true)] = array('plugin' => false, 'controller' => '/');        $breadcrumb = array('pages' => $pages, 'active' => __(' Access Right User', true));        $this->set('breadcrumb', $breadcrumb);        $pageHeading = 'Access Rights Management';        $this->set('pageHeading', $pageHeading);        $page = ((isset($this->params['named']['page']) && $this->params['named']['page'] != NULL) ? $this->params['named']['page'] : 0);        $this->set('page', $page);// Pagging        if (!empty($this->data) && isset($this->data['recordsPerPage'])) {            $limitValue = $limit = $this->data['recordsPerPage'];            $this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);        } else {            $this->Prg->commonProcess();        }        //$limitValue = $limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage') ) ? $this->Session->read($this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');        //$this->set('limitValue', $limitValue);        $limit = 50;        $this->set('limit', $limit);        $this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;        @$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);        //$parsedConditions['access_right_category_id'] = $cate_id;        if (@$this->params->named['from_date'] and @ $this->params->named['to_date']) {            array_push($parsedConditions, array('(from_unixtime(AccessRightUser.created, "%Y-%m-%d") >= ? AND from_unixtime(AccessRightUser.created, "%Y-%m-%d") <= ?)' => array($this->params->named['from_date'], $this->params->named['to_date'])));        } else        if (@$this->params->named['from_date']) {            array_push($parsedConditions, array('from_unixtime(AccessRightUser.created, "%Y-%m-%d") >= ' => @$this->params->named['from_date']));        } else        if (@$this->params->named['to_date']) {            array_push($parsedConditions, array('from_unixtime(AccessRightUser.created, "%Y-%m-%d") <= ' => @$this->params->named['to_date']));        }        $this->set("from_date", @$this->params->named['from_date']);        $this->set("to_date", @$this->params->named['to_date']);        $this->paginate = array(            'conditions' => array($parsedConditions),            'limit' => $limit,            'order' => array($this->modelClass . '.id' => 'desc')        );        $this->set('parsedConditions', $parsedConditions);        //pr($this->paginate());        $this->set('result', $this->paginate());//        $count_new_bookings = $this->AccessRightUser->find('count', array(//            'conditions' => array($parsedConditions),//        ));//        $this->set("count_new_bookings", $count_new_bookings);        $this->loadModel('AccessRightCategory');        $AccessRightCategory = $this->AccessRightCategory->find("list", array('order' => array('AccessRightCategory.created' => 'asc')));        $this->set("AccessRightCategory", $AccessRightCategory);        if (isset($this->passedArgs['access_right_category_id']) && !empty($this->passedArgs['access_right_category_id'])) {            $category_id = $this->passedArgs['access_right_category_id'];            $this->set('category_id', $category_id);        }        if (isset($this->passedArgs['access_right_category_id']) && !empty($this->passedArgs['access_right_category_id'])) {            $category_id = $this->passedArgs['access_right_category_id'];            $this->set('category_id', $category_id);        }        if (isset($this->passedArgs['username']) && !empty($this->passedArgs['username'])) {            $username = $this->passedArgs['username'];            $this->set('username', $username);        }        if (isset($this->passedArgs['employee_id']) && !empty($this->passedArgs['employee_id'])) {            $employee_id = $this->passedArgs['employee_id'];            $this->set('employee_id', $employee_id);        }        if (isset($this->passedArgs['email']) && !empty($this->passedArgs['email'])) {            $email = $this->passedArgs['email'];            $this->set('email', $email);        }        if (isset($this->passedArgs['firstname']) && !empty($this->passedArgs['firstname'])) {            $firstname = $this->passedArgs['firstname'];            $this->set('firstname', $firstname);        }        $this->set('title_for_layout', 'User Details');    }    public function change_status_active() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $data['status'] = 1;                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                $text_action = "activated";                $json_data = json_encode($this->request->data);                $this->global_logs("access_right_users", $this->data['id'], 2, $text_action, $json_data);                echo json_encode(array('succ' => 1, 'msg' => 'Record Status has been changed.'));                die;            }        }        exit;    }    public function change_status_inactive() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $data['status'] = 0;                $this->{$this->modelClass}->id = $this->data['id'];                $this->{$this->modelClass}->save($data, false);                $text_action = "inactivated";                $json_data = json_encode($this->request->data);                $this->global_logs("access_right_users", $this->data['id'], 3, $text_action, $json_data);                echo json_encode(array('succ' => 1, 'msg' => 'Record Status has been changed.'));                die;            }        }        exit;    }    public function deleterow() {        if ($this->request->is('Ajax')) {            if ($this->data['id'] != null) {                $data = $this->{$this->modelClass}->findById($this->data['id']);                if (!empty($data)) {                    if ($this->{$this->modelClass}->delete($this->data['id'])) {                        echo json_encode(array('succ' => 1, 'msg' => 'Record has been deleted'));                        die;                    }                }            }        }        exit;    }    function add($cate_id = 0) {        $this->set('tab_open', 'accessrightuser');        $pages[__('Dashboard', true)] = array('plugin' => false, 'controller' => '/');        $breadcrumb = array('pages' => $pages, 'active' => __('Access Rights User Management', true));        $this->set('breadcrumb', $breadcrumb);        $pageHeading = 'Access Rights User Management';        $this->set('pageHeading', $pageHeading);        $this->set('cate_id', $cate_id);        $this->loadModel('AccessRightCategory');        $access_right_category = $this->AccessRightCategory->find('list');        $this->set('access_right_category', $access_right_category);        //pr($access_right_category);        if (!empty($this->data)) {            //	pr($this->data); die;            $this->{$this->modelClass}->set($this->data);            if ($this->{$this->modelClass}->CheckValidUser()) {                $data['access_right_category_id'] = $this->data['AccessRightUser']['access_right_category_id'];                $data['username'] = $this->data['AccessRightUser']['username'];                $data['user_role_id'] = 6;                $pass = rand(000000, 999999);                $data['password'] = AuthComponent::password($pass);                $data['status'] = 1;                //pr($data); die;                //$this->{$this->modelClass}->save($data, false)                if ($this->{$this->modelClass}->save($data, false)) {                    $userid = $this->{$this->modelClass}->id;                    $text_action = "added";                    $json_data = json_encode($this->request->data);                    $this->global_logs("access_right_users", $userid, 0, $text_action, $json_data);                    $phone_no = "91" . $this->data['AccessRightUser']['mobile'];                    $msg = "Welcome to Super Cabz! Your Username is " . $this->data['AccessRightUser']['username'] . " and Password is " . $pass;                    $this->send_message($phone_no, $msg);                    $this->Session->setFlash('User has been added.', 'success');                    $this->redirect(array('action' => 'index'));                }            }        }        $this->set('title_for_layout', 'Add New User');    }    function edit($id = null) {        $this->set('tab_open', 'accessrightuser');        $pages[__('Dashboard', true)] = array('plugin' => false, 'controller' => '/');        $breadcrumb = array('pages' => $pages, 'active' => __('Access Rights User Management', true));        $this->set('breadcrumb', $breadcrumb);        $pageHeading = 'Access Rights User Management';        $this->set('pageHeading', $pageHeading);        $this->loadModel('AccessRightCategory');        $access_right_category = $this->AccessRightCategory->find('list');        $this->set('access_right_category', $access_right_category);        $this->set('id', $id);        $user = $this->{$this->modelClass}->findById($id);        $this->{$this->modelClass}->set($user);        $this->set('record', $user);        //$this->set('cate_id', $cate_id);        if (!empty($this->data)) {            $this->{$this->modelClass}->id = $id;            $this->{$this->modelClass}->set($this->data);            if ($this->{$this->modelClass}->CheckValidUser()) {                //pr($this->data); die;                $accessdata['username'] = $this->data['AccessRightUser']['username'];                $accessdata['user_role_id'] = 6;                $accessdata['access_right_category_id'] = $this->data['AccessRightUser']['access_right_category_id'];                if (!empty($this->data['AccessRightUser']['password'])) {                    $accessdata['password'] = AuthComponent::password($this->data['AccessRightUser']['password']);                } else {                    $accessdata['password'] = $user['AccessRightUser']['password'];                }                //pr($accessdata); die;                if ($this->{$this->modelClass}->save($accessdata, false)) {                    $userid = $this->{$this->modelClass}->id;                    $text_action = "updated";                    $json_data = json_encode($this->request->data);                    $this->global_logs("access_right_users", $userid, 1, $text_action, $json_data);                    $this->Session->setFlash('User has been updated.', 'success');                    $this->redirect(array('action' => 'index'));                }            }        } else {            $this->request->data = $this->{$this->modelClass}->read();            unset($this->request->data['AccessRightUser']['password']);            //pr($this->request->data);        }        $this->set('title_for_layout', 'Edit User');    }}