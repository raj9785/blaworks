<?php
	Router::connect('/requesters/*', array('plugin' => 'usermgmt', 'controller' => 'requesters', 'action' => 'index'));
	Router::connect('/add-requester/*', array('plugin' => 'usermgmt', 'controller' => 'requesters', 'action' => 'add'));
	Router::connect('/edit-requester/*', array('plugin' => 'usermgmt', 'controller' => 'requesters', 'action' => 'edit'));
	Router::connect('/suppliers/*', array('plugin' => 'usermgmt', 'controller' => 'suppliers', 'action' => 'index'));
	Router::connect('/add-supplier/*', array('plugin' => 'usermgmt', 'controller' => 'suppliers', 'action' => 'add'));
	Router::connect('/edit-supplier/*', array('plugin' => 'usermgmt', 'controller' => 'suppliers', 'action' => 'edit'));
	
	
	


