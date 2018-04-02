<?php

class TermUsesController extends AppController {

    public $uses = array('TermUse');
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

        $this->set('tab_open', 'cms');
    }

    public function index() {
        $this->paginate = array(
            'fields' => array(
                'TermUse.id', 'TermUse.title', 'TermUse.content', 'TermUse.status', 'TermUse.created', 'TermUse.modified_by', 'TermUse.modified'
            ),
            'limit' => 25,
        );
        $this->set('users_list', $this->paginate());
        $this->set('title_for_layout', 'Terms of Use List');
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->TermUse->save($this->request->data)) {
                $this->Session->setFlash(__('Term Use added successfully.'), 'success');
                $this->redirect(array('controller' => 'term_uses', 'action' => 'index'));
            }
        }
        $this->set('title_for_layout', 'Add New Terms of Use');
    }

    public function edit() {

        $user_id = $this->params->query['id'];
 
        if (!$user_id || $user_id == NULL) {
            $this->Session->setFlash('Invalid request to edit term use', 'error');
            $this->redirect(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'index'));
        } else {
            // check that user exists or not
            $check_user_exists = $this->TermUse->Find('count', array(
                'conditions' => array(
                    'TermUse.id' => $user_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Faq does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'index'));
            }
        }

        $users_data = $this->TermUse->find('first', array(
            'conditions' => array(
                'TermUse.id' => $user_id
            ),
            'fields' => array(
                'TermUse.id', 'TermUse.title', 'TermUse.content'
            )
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['TermUse']['updated'] = date("Y-m-d h:i:s");
            $this->request->data['TermUse']['id'] = $user_id;
			$modified_by = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
			$this->request->data['TermUse']['modified_by'] = $modified_by;
            if ($this->TermUse->save($this->request->data)) {
                $this->Session->setFlash('TermUse updated successfully', 'success');
                $this->redirect(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'index'));
            } else {
                $this->Session->setFlash('TermUse couldn\'t be updated, try again later', 'error');
                // $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        } else {
            $this->data = $users_data;
            $this->set('users_data', $users_data);
        }
        $this->set('title_for_layout', 'Edit Terms of Use');
    }

    public function status() {
        $item_id = $this->params['named']['id'];
        $item_status = $this->params['named']['status'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, term use id not found', 'error');
            $this->redirect(array('controller' => 'term_uses', 'action' => 'index'));
        } else {

            // check that item exists or not
            $check_user_exists = $this->TermUse->Find('count', array(
                'conditions' => array(
                    'TermUse.id' => $item_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('TermUse does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'index'));
            }
        }

        // update status of template as per condition 
        $update_status = $this->TermUse->updateAll(array('TermUse.status' => "'" . $item_status . "'"), array('TermUse.id' => $item_id));
        $this->Session->setFlash('TermUse status has been changed successfully', 'success');
        $this->redirect(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'index'));

        exit;
    }

    public function delete() {
        $item_id = $this->params->query['id'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, TermUse id not found', 'error');
            echo json_encode(array('succ' => 0, 'msg' => 'Invalid Request, TermUse id not found'));
            die;
        } else {

            // fetch order's of user
            $orders_list = $this->TermUse->find('first', array(
                'conditions' => array(
                    'TermUse.id' => $item_id
                ),
                'fields' => array(
                    'TermUse.id'
                ),
                'recursive' => -1
            ));

            if (!empty($orders_list)) {
                $this->TermUse->delete($orders_list['TermUse']['id']);
                $this->Session->setFlash('Term Use deleted successfully', 'success');
                echo json_encode(array('succ' => 1, 'msg' => 'Term Use deleted successfully'));
                die;
            } else {
                $this->Session->setFlash('TermUse couldn\'t be deleted, please try again later', 'error');
                echo json_encode(array('succ' => 0, 'msg' => 'Term Use couldn\'t be deleted, please try again later'));
                die;
            }
        }
        exit;
    }

}

?>
