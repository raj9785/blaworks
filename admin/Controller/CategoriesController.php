<?php

class CategoriesController extends AppController {

    public $uses = array('Category');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        $parent_id = ((!isset($this->params->query['parent_id']) || $this->params->query['parent_id'] == "") ? '-1' : $this->params->query['parent_id']);
        $this->paginate = array(
            'conditions' => array(
                'Category.parent_id' => $parent_id
            ),
            'fields' => array(
                'Category.id', 'Category.name', 'Category.created', 'Category.status', 'Category.parent_id'
            ),
            'limit' => 35,
        );
        $this->set('categories_list', $this->paginate());
        $this->set('tab_open', 'categories');
        $this->set('parent_id', $parent_id);
        // fetch parent id of parent_id
        $fetch_parent_of_parent = $this->Category->find('first', array(
            'fields' => array(
                'Category.parent_id'
            ),
            'conditions' => array(
                'Category.id' => $parent_id
            )
        ));
        if (isset($fetch_parent_of_parent['Category']['parent_id']))
            $this->set('parent_of_parent', $fetch_parent_of_parent['Category']['parent_id']);
    }

    public function add() {
        if ($this->request->is('post')) {

            if (!isset($this->request->data['Category']['parent_id']) || $this->request->data['Category']['parent_id'] == "")
                $this->request->data['Category']['parent_id'] = '-1';

            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Category has been added successfully'), 'success');
                if ($this->request->data['Category']['parent_id'] == '-1')
                    $this->redirect(array('plugin' => false, 'controller' => 'categories', 'action' => 'index'));
                else
                    $this->redirect(array('plugin' => false, 'controller' => 'categories', 'action' => 'index', '?' => array('parent_id' => $this->request->data['Category']['parent_id'])));
            }
        }
        $categories_list = $this->Category->find('list', array(
            'order' => array(
                'Category.id' => 'ASC'
            )
        ));

        $this->set('categories_list', $categories_list);
        $this->set('tab_open', 'categories');
    }

    public function status() {
        $item_id = $this->params['named']['id'];
        $item_status = $this->params['named']['status'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, category id not found', 'error');
            $this->redirect(array('controller' => 'categories', 'action' => 'index'));
        } else {

            // check that item exists or not
            $check_user_exists = $this->Category->Find('count', array(
                'conditions' => array(
                    'Category.id' => $item_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Category does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'categories', 'action' => 'index'));
            }
        }

        // update status of template as per condition 
        $update_status = $this->Category->updateAll(array('Category.status' => "'" . $item_status . "'"), array('Category.id' => $item_id));
        $this->Session->setFlash('Category status has been changed successfully', 'success');
        $this->redirect(array('plugin' => false, 'controller' => 'categories', 'action' => 'index'));
        exit;
    }

    public function delete() {
        $item_id = $this->params->query['id'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, category id not found', 'error');
            echo json_encode(array('succ' => 0, 'msg' => 'Invalid Request, category id not found'));
            die;
        } else {

            // fetch order's of user
            $category_list = $this->Category->find('first', array(
                'conditions' => array(
                    'Category.id' => $item_id
                ),
                'fields' => array(
                    'Category.id'
                ),
                'recursive' => -1
            ));

            if (!empty($category_list)) {

                // check that inner categories available or not
                $check_inner_categories = $this->Category->find('count', array(
                    'conditions' => array(
                        'Category.parent_id' => $item_id
                    ),
                    'recursive' => -1
                ));
                if ($check_inner_categories == 0) {

                    $this->Category->delete($category_list['Category']['id']);
                    $this->Session->setFlash('Category deleted successfully', 'success');
                    echo json_encode(array('succ' => 1, 'msg' => 'Category deleted successfully'));
                    die;
                } else {
                    echo json_encode(array('succ' => 0, 'msg' => 'Category couldn\'t be deleted, please delete child categories first'));
                    die;
                }
            } else {
                $this->Session->setFlash('Category couldn\'t be deleted, please try again later', 'error');
                echo json_encode(array('succ' => 0, 'msg' => 'Category couldn\'t be deleted, please try again later'));
                die;
            }
        }
        exit;
    }

}

?>