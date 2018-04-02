<?php
/**
 * Copyright 2012, PromoSoft. (http://www.promosoft.in)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://www.promosoft.in)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cms App Model
 *
 * @package Cms
 * @subpackage cms.models
 */
class UsermgmtAppModel extends AppModel {

/**
 * Plugin name
 *
 * @var string $plugin
 */
	public $plugin = 'Usermgmt';

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable');

/**
 * Customized paginateCount method
 *
 * @param array
 * @param integer
 * @param array
 * @return 
 */
	function paginateCount($conditions = array(), $recursive = 0, $extra = array()) {
		$parameters = compact('conditions');
		if ($recursive != $this->recursive) {
			$parameters['recursive'] = $recursive;
		}
		if (isset($extra['type']) && isset($this->_findMethods[$extra['type']])) {
			$extra['operation'] = 'count';
			return $this->find($extra['type'], array_merge($parameters, $extra));
		} else {
			return $this->find('count', array_merge($parameters, $extra));
		}
	}

}
