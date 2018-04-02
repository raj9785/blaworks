<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     * @throws NotFoundException When the view file could not be found
     * 	or MissingViewException in debug mode.
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('home', 'disclaimer', 'aboutus', 'privacy');
    }

    public function index() {
        $this->paginate = array(
            'conditions' => array('Page.slug !=' => 'terms_of_use'),
            'fields' => array(
                'Page.title', 'Page.created', 'Page.id', 'Page.modified', 'Page.modified_by'
            ),
            'limit' => 25,
        );
        $this->set('users_list', $this->paginate());
        $this->set('tab_open', 'cms');
        $this->set('title_for_layout', 'Pages List');
    }
    public function disclaimer() {
        $this->layout = 'staticlayout';
    }
    public function aboutus() {
        $this->layout = 'staticlayout';
    }
    public function privacy() {
        $this->layout = 'staticlayout';
    }
    public function add() {
        $this->set('tab_open', 'cms');
        if ($this->request->is('post')) {
            if (!isset($this->request->data['Page']['content']) || $this->request->data['Page']['content'] == "") {
                $this->Session->setFlash(__('Please enter content'), 'error');
                $this->data = $this->request->data;
            } else {
                $this->request->data['Page']['slug'] = $this->slug_by_title($this->request->data['Page']['title']);
                if ($this->Page->save($this->request->data)) {
                    $this->Session->setFlash(__('Page added successfully.'), 'success');
                    $this->redirect(array('controller' => 'pages', 'action' => 'index'));
                }
            }
        }
    }

    public function slug_by_title($title) {
        $slug = strtolower($title);
        $slug = str_replace(" ", "_", $slug);
        return $slug;
    }

    public function edit() {
        $user_id = $this->params->query['id'];
        $this->set('tab_open', 'cms');
        if (!$user_id || $user_id == NULL) {
            $this->Session->setFlash('Invalid request to edit page', 'error');
            $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'index'));
        } else {
            // check that user exists or not
            $check_user_exists = $this->Page->Find('count', array(
                'conditions' => array(
                    'Page.id' => $user_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Page does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'index'));
            }
        }

        $users_data = $this->Page->find('first', array(
            'conditions' => array(
                'Page.id' => $user_id
            ),
            'fields' => array(
                'Page.id', 'Page.title', 'Page.content', 'Page.meta_title', 'Page.meta_title',
                'Page.meta_keywords', 'Page.meta_description'
            )
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            //$this->request->data['Page']['slug'] = $this->slug_by_title($this->request->data['Page']['title']);
            $this->request->data['Page']['updated'] = date("Y-m-d h:i:s");
            $modified_by = $this->Auth->user('firstname') ? $this->Auth->user('firstname') . " " . $this->Auth->user('lastname') : $this->Auth->user('username');
            $this->request->data['Page']['modified_by'] = $modified_by;
            $this->request->data['Page']['id'] = $user_id;
            if ($this->Page->save($this->request->data)) {
                $this->Session->setFlash('Page updated successfully', 'success');
                $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Page couldn\'t be updated, try again later', 'error');
                // $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        } else {
            $this->data = $users_data;
            $this->set('users_data', $users_data);
        }
        $this->set('title_for_layout', 'Edit Page');
    }

}
