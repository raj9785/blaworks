<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'users', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
    Router::connect('/admin', array('controller' => 'users', 'action' => 'login'));
	
	//Router::connect('/register/', array('controller' => 'users', 'action' => 'register'));
 Router::connect('/biodata/*', array('plugin'=>'applicant','controller' => 'applicants', 'action' => 'download_biodata_by_app')); 	

Router::connect('/customer', array('plugin'=>'customer','controller' => 'customers', 'action' => 'index'));
Router::connect('/customer/add', array('plugin'=>'customer','controller' => 'customers', 'action' => 'add_customer'));
Router::connect('/customer/edit/*', array('plugin'=>'customer','controller' => 'customers', 'action' => 'edit_customer'));

Router::connect('/employee', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'employee'));
Router::connect('/employee/add', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'add_employee'));
Router::connect('/employee/edit/*', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'edit_employee'));

Router::connect('/driver', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'driver'));
Router::connect('/driver/add', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'add_driver'));
Router::connect('/driver/edit/*', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'edit_driver'));

Router::connect('/individual', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'individual'));
Router::connect('/individual/add', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'add_individual'));
Router::connect('/individual/edit', array('plugin'=>'usermgmt','controller' => 'usermgmt', 'action' => 'edit_individual'));

Router::connect('/country', array('plugin'=>'country','controller' => 'country', 'action' => 'index'));
Router::connect('/country/add', array('plugin'=>'country','controller' => 'country', 'action' => 'add'));
Router::connect('/country/edit', array('plugin'=>'country','controller' => 'country', 'action' => 'edit'));

Router::connect('/state', array('plugin'=>'state','controller' => 'state', 'action' => 'index'));
Router::connect('/state/add', array('plugin'=>'state','controller' => 'state', 'action' => 'add'));
Router::connect('/state/edit', array('plugin'=>'state','controller' => 'state', 'action' => 'edit'));

Router::connect('/city', array('plugin'=>'city','controller' => 'city', 'action' => 'index'));
Router::connect('/city/add', array('plugin'=>'city','controller' => 'city', 'action' => 'add'));
Router::connect('/city/edit', array('plugin'=>'city','controller' => 'city', 'action' => 'edit'));
Router::connect('/city/advance_payment', array('plugin'=>'city','controller' => 'city', 'action' => 'advance_payment_required'));

Router::connect('/locality', array('plugin'=>'locality','controller' => 'locality', 'action' => 'index'));
Router::connect('/locality/add', array('plugin'=>'locality','controller' => 'locality', 'action' => 'add'));
Router::connect('/locality/edit', array('plugin'=>'locality','controller' => 'locality', 'action' => 'edit'));

Router::connect('/feedback', array('plugin'=>'feedback','controller' => 'feedback', 'action' => 'index'));
Router::connect('/feedback/add', array('plugin'=>'feedback','controller' => 'feedback', 'action' => 'add'));
Router::connect('/feedback/edit', array('plugin'=>'feedback','controller' => 'feedback', 'action' => 'edit'));
Router::connect('/feedback/detail', array('plugin'=>'feedback','controller' => 'feedback', 'action' => 'detail'));
Router::connect('/feedback/reply', array('plugin'=>'feedback','controller' => 'feedback', 'action' => 'reply'));


Router::connect('/airport', array('plugin'=>'airport','controller' => 'airport', 'action' => 'index'));
Router::connect('/airport/add', array('plugin'=>'airport','controller' => 'airport', 'action' => 'add'));
Router::connect('/airport/edit', array('plugin'=>'airport','controller' => 'airport', 'action' => 'edit'));

Router::connect('/invoice', array('plugin'=>'invoice','controller' => 'invoices', 'action' => 'index'));
Router::connect('/airport/add', array('plugin'=>'airport','controller' => 'airport', 'action' => 'add'));
Router::connect('/airport/edit', array('plugin'=>'airport','controller' => 'airport', 'action' => 'edit'));
Router::connect('/airport/cities_list', array('plugin'=>'airport','controller' => 'airport', 'action' => 'cities_list'));



/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
