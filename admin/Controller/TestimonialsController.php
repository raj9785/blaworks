<?php

class TestimonialsController extends AppController {

    public $uses = array('Testimonial');
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
        $this->Auth->allow('login');
    }

    public function index() {
        $this->paginate = array(
            'fields' => array(
                'Testimonial.id', 'Testimonial.name', 'Testimonial.icon_image', 'Testimonial.testimonial', 
                'Testimonial.status', 'Testimonial.created'
            ),
            'limit' => 25,
        );
        $this->set('users_list', $this->paginate());
        $this->set('tab_open', 'cms');
        $this->set('title_for_layout', 'Testimonials List');
    }

    public function add() {
        $this->set('tab_open', 'cms');
        $is_success = 1;
        if ($this->request->is('post')) {
            $upload_folder = WEBSITE_ADMIN_WEBROOT_ROOT_PATH . DS . 'webroot' . DS . 'uploads' . DS . 'testimonials';
            $thumb_folder = WEBSITE_ADMIN_WEBROOT_ROOT_PATH . DS . 'webroot' . DS . 'uploads' . DS . 'testimonials' . DS . 'icon_image';
            
            if (isset($this->request->data['Testimonial']['icon_image']) && $this->request->data['Testimonial']['icon_image']['name'] != "") {
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $uploaded_image = $this->request->data['Testimonial']['icon_image']['name'];
                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);                
                $uploadedImagesize = getimagesize($this->request->data['Testimonial']['icon_image']['tmp_name']);
                $uploadedImageWidth = $uploadedImagesize[0];
                $uploadedImageHeight = $uploadedImagesize[1];
                if (!in_array($imgExtension, $allowed_extensions)) {
                    $this->data = $this->request->data;
                    $this->Session->setFlash(__('Icon image extension should be of ' . implode(",", $allowed_extensions) . ' only'),'error');
                    $is_success = 0;
                }
                $uploadimageArray = $this->request->data['Testimonial']['icon_image'];
                unset($this->request->data['Testimonial']['icon_image']);
            } else {
                unset($this->request->data['Testimonial']['icon_image']);
            }
            if ($is_success == 1 && $this->Testimonial->save($this->request->data)) {
                if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {
                    $file_name = $this->Testimonial->id . '_' . time() . '_' . basename($uploadimageArray['name']);
                    if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_folder . DS . $file_name)) {                        
                        $this->resize($file_name, 50, 50, $upload_folder, $thumb_folder);
                        $this->Testimonial->updateAll(array('Testimonial.icon_image' => "'" . $file_name . "'"), array('Testimonial.id' => $this->Testimonial->id));
                        unlink($upload_folder . DS . $file_name);
                    } else {
                        $is_file_uploaded = 0;
                    }
                }
                $this->Session->setFlash(__('Testimonial added successfully.'), 'success');
                $this->redirect(array('controller' => 'testimonials', 'action' => 'index'));
            }
        }
        $this->set('title_for_layout', 'Add Testimonial');
    }

    public function edit() {

        $user_id = $this->params->query['id'];
        $this->set('tab_open', 'cms');
        if (!$user_id || $user_id == NULL) {
            $this->Session->setFlash('Invalid request to edit testimonial', 'error');
            $this->redirect(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'index'));
        } else {
            // check that user exists or not
            $check_user_exists = $this->Testimonial->Find('count', array(
                'conditions' => array(
                    'Testimonial.id' => $user_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Testimonial does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'index'));
            }
        }

        $users_data = $this->Testimonial->find('first', array(
            'conditions' => array(
                'Testimonial.id' => $user_id
            ),
            'fields' => array(
                'Testimonial.id', 'Testimonial.name', 
                'Testimonial.testimonial','Testimonial.icon_image'
            )
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            $upload_folder = WEBSITE_ADMIN_WEBROOT_ROOT_PATH . DS . 'webroot' . DS . 'uploads' . DS . 'testimonials';
            $thumb_folder = WEBSITE_ADMIN_WEBROOT_ROOT_PATH . DS . 'webroot' . DS . 'uploads' . DS . 'testimonials' . DS . 'icon_image';
            
            if (isset($this->request->data['Testimonial']['icon_image']) && $this->request->data['Testimonial']['icon_image']['name'] != "") {
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                $uploaded_image = $this->request->data['Testimonial']['icon_image']['name'];
                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);
                $uploadedImagesize = getimagesize($this->request->data['Testimonial']['icon_image']['tmp_name']);
                $uploadedImageWidth = $uploadedImagesize[0];
                $uploadedImageHeight = $uploadedImagesize[1];
                if (!in_array($imgExtension, $allowed_extensions)) {
                    $this->data = $this->request->data;
                    $this->Session->setFlash(__('Icon image extension should be of ' . implode(",", $allowed_extensions) . ' only'), 'default', array('class' => 'error'));
                }
                $uploadimageArray = $this->request->data['Testimonial']['icon_image'];
                unset($this->request->data['Testimonial']['icon_image']);
            } else {
                unset($this->request->data['Testimonial']['icon_image']);
            }
            $this->request->data['Testimonial']['updated'] = date("Y-m-d h:i:s");
            $this->request->data['Testimonial']['id'] = $user_id;
            if ($this->Testimonial->save($this->request->data)) {
                if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {
                    $file_name = $this->Testimonial->id . '_' . time() . '_' . basename($uploadimageArray['name']);
                    if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_folder . DS . $file_name)) {                        
                        $this->resize($file_name, 50, 50, $upload_folder, $thumb_folder);
                        $this->Testimonial->updateAll(array('Testimonial.icon_image' => "'" . $file_name . "'"), array('Testimonial.id' => $user_id));
                        unlink($upload_folder . DS . $file_name);
                    } else {
                        $is_file_uploaded = 0;
                    }
                }
                $this->Session->setFlash('Testimonial updated successfully', 'success');
                $this->redirect(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Testimonial couldn\'t be updated, try again later', 'error');
                // $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        } else {
            $this->data = $users_data;
            $this->set('users_data',$users_data);
        }
        $this->set('title_for_layout', 'Edit Testimonial');
    }
    
    public function status() {
        $item_id = $this->params['named']['id'];
        $item_status = $this->params['named']['status'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, testimonial id not found', 'error');
            $this->redirect(array('controller' => 'testimonials', 'action' => 'index'));
        } else {

            // check that item exists or not
            $check_user_exists = $this->Testimonial->Find('count', array(
                'conditions' => array(
                    'Testimonial.id' => $item_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Testimonial does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'index'));
            }
        }

        // update status of template as per condition 
        $update_status = $this->Testimonial->updateAll(array('Testimonial.status' => "'" . $item_status . "'"), array('Testimonial.id' => $item_id));
        $this->Session->setFlash('Testimonial status has been changed successfully', 'success');
        $this->redirect(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'index'));

        exit;
    }
    
    public function delete() {
        $item_id = $this->params->query['id'];
        if (!$item_id) {
            $this->Session->setFlash('Invalid Request, testimonial id not found', 'error');
            echo json_encode(array('succ' => 0, 'msg' => 'Invalid Request, testimonial id not found'));
            die;
        } else {

            // fetch order's of user
            $orders_list = $this->Testimonial->find('first', array(
                'conditions' => array(
                    'Testimonial.id' => $item_id
                ),
                'fields' => array(
                    'Testimonial.id','Testimonial.icon_image'
                ),
                'recursive' => -1
            ));

            if (!empty($orders_list)) {
                // delete image
                if($orders_list['Testimonial']['icon_image']!="" && file_exists(WEBSITE_ADMIN_WEBROOT_ROOT_PATH.'/webroot/uploads/testimonials/icon_image/'.$orders_list['Testimonial']['icon_image']))
                    unlink(WEBSITE_ADMIN_WEBROOT_ROOT_PATH.'/webroot/uploads/testimonials/icon_image/'.$orders_list['Testimonial']['icon_image']);
                
                $this->Testimonial->delete($orders_list['Testimonial']['id']);
                $this->Session->setFlash('Testimonial deleted successfully', 'success');
                echo json_encode(array('succ' => 1, 'msg' => 'Testimonial deleted successfully'));
                die;
            } else {
                $this->Session->setFlash('Testimonial couldn\'t be deleted, please try again later', 'error');
                echo json_encode(array('succ' => 0, 'msg' => 'Testimonial couldn\'t be deleted, please try again later'));
                die;
            }
        }
        exit;
    }

}

?>
