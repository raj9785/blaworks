<?php

class FaqsController extends AppController {

    public $uses = array('Faq');
    public $components = array('Session', 'Paginator', 'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            )
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index(){
        $this->paginate = array(
            'fields' => array(
                'Faq.id', 'Faq.question', 'Faq.answer','Faq.status', 'Faq.created', 'Faq.modified', 'Faq.modified_by'
            ),
            'limit' => 25,
        );
        $this->set('users_list', $this->paginate());
        $this->set('tab_open', 'cms');
        $this->set('title_for_layout', 'FAQs List');
    }
    
    public function add() {
        $this->set('tab_open', 'cms');
        if ($this->request->is('post')) {            
            if ($this->Faq->save($this->request->data)) {                
                $this->Session->setFlash(__('Faq added successfully.'), 'success');
                $this->redirect(array('controller' => 'faqs', 'action' => 'index'));
            }
        }
        $this->set('title_for_layout', 'Add New FAQ');
    }

    public function edit() {

        $user_id = $this->params->query['id'];
        $this->set('tab_open', 'cms');
        if (!$user_id || $user_id == NULL) {
            $this->Session->setFlash('Invalid request to edit faq', 'error');
            $this->redirect(array('plugin' => false, 'controller' => 'faqs', 'action' => 'index'));
        } else {
            // check that user exists or not
            $check_user_exists = $this->Faq->Find('count', array(
                'conditions' => array(
                    'Faq.id' => $user_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Faq does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'faqs', 'action' => 'index'));
            }
        }

        $users_data = $this->Faq->find('first', array(
            'conditions' => array(
                'Faq.id' => $user_id
            ),
            'fields' => array(
                'Faq.id', 'Faq.question','Faq.answer'
            )
        ));

        if ($this->request->is('post') || $this->request->is('put')) {            
            $this->request->data['Faq']['updated'] = date("Y-m-d h:i:s");
			$modified_by = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
			$this->request->data['Faq']['modified_by'] = $modified_by;
            $this->request->data['Faq']['id'] = $user_id;
            if ($this->Faq->save($this->request->data)) {                
                $this->Session->setFlash('Faq updated successfully', 'success');
                $this->redirect(array('plugin' => false, 'controller' => 'faqs', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Faq couldn\'t be updated, try again later', 'error');
                // $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        } else {
            $this->data = $users_data;
            $this->set('users_data',$users_data);
        }
        $this->set('title_for_layout', 'Edit FAQs');
    }
    
    public function status() {
        $item_id = $this->params['named']['id'];
        $item_status = $this->params['named']['status'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, faq id not found', 'error');
            $this->redirect(array('controller' => 'faqs', 'action' => 'index'));
        } else {

            // check that item exists or not
            $check_user_exists = $this->Faq->Find('count', array(
                'conditions' => array(
                    'Faq.id' => $item_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Faq does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'faqs', 'action' => 'index'));
            }
        }

        // update status of template as per condition 
        $update_status = $this->Faq->updateAll(array('Faq.status' => "'" . $item_status . "'"), array('Faq.id' => $item_id));
        $this->Session->setFlash('Faq status has been changed successfully', 'success');
        $this->redirect(array('plugin' => false, 'controller' => 'faqs', 'action' => 'index'));

        exit;
    }
    
    public function delete() {
        $item_id = $this->params->query['id'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, Faq id not found', 'error');
            echo json_encode(array('succ' => 0, 'msg' => 'Invalid Request, Faq id not found'));
            die;
        } else {

            // fetch order's of user
            $orders_list = $this->Faq->find('first', array(
                'conditions' => array(
                    'Faq.id' => $item_id
                ),
                'fields' => array(
                    'Faq.id'
                ),
                'recursive' => -1
            ));

            if (!empty($orders_list)) {                
                $this->Faq->delete($orders_list['Faq']['id']);
                $this->Session->setFlash('Faq deleted successfully', 'success');
                echo json_encode(array('succ' => 1, 'msg' => 'Faq deleted successfully'));
                die;
            } else {
                $this->Session->setFlash('Faq couldn\'t be deleted, please try again later', 'error');
                echo json_encode(array('succ' => 0, 'msg' => 'Faq couldn\'t be deleted, please try again later'));
                die;
            }
        }
        exit;
    }
}
?>
