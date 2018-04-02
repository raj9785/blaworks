<?php
/**
 * This file is part of Cms.
 * Routes configuration
 *
 * Author:  Bharat Singh <007bharatsingh@gmail.com>
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * Copyright 2012, PromoSoft. (http://www.promosoft.in)
 *
 * @copyright Copyright 2010, PromoSoft. (http://www.promosoft.in)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * PHP version 5
 * CakePHP version 1.3
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, PromoSoft. (http://www.promosoft.in)
 * @link          http://www.promosoft.in
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	
/**
 * Here, we are connecting 'admin/cms-pages/*' (base path) to plugin frontusers and controller called 'cms_pages' for Routing.prefixes admin,
 * its action called 'admin_index', and we pass a param to select the view file
 * to use (in this case, /app/plugins/frontusers/views/cms_pages/admin_index.ctp)...
 */		 
	
	Router::connect('/fare/add/*', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'add'));
	Router::connect('/fare/get_users', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'get_users'));
	Router::connect('/fare/gallary', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'list_gallery'));
	Router::connect('/fare/edit/*', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'edit'));
	Router::connect('/fare/delete/*', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'delete'));
	Router::connect('/fare/change-status/*', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'ChangeStatus'));
	Router::connect('/fare/image-gallary/:action/*', array('plugin'=>'fare','controller' => 'image_galleries', 'action' => 'index'));
	Router::connect('/fare/gallary/:action/*', array('plugin'=>'fare','controller' => 'image_galleries', 'action' => 'image_slide'));
	Router::connect('/fare/*', array('plugin'=>'fare','controller' => 'image_albums', 'action' => 'index'));
?>