<?php
/**
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 * 
 * @category   Ip
 * @package    Ip_Controller
 * @subpackage Ip_Controller_Action
 * @desc	   Ip_Controller_Action_Helper_GetDb
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    1.0 2010-10-10
 * @author	   Dev 17 <dev@ip-formation.com>
 * @copyright  Copyright (c) 2011 DEV 17 
 * @version	   Release : 1.0.1 (2011-02-28)
 */


/**
 * 
 * @category   Ip
 * @package    Ip_Controller
 * @subpackage Ip_Controller_Action
 * @desc	   Ip_Controller_Action_Helper_GetDb
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    1.0 2010-10-10
 * @author	   Dev 17 <dev@ip-formation.com>
 * @copyright  Copyright (c) 2011 DEV 17 
 * @version	   Release : 1.0.1 (2011-02-28)
 */
class Ip_Controller_Action_Helper_GetDb extends Ip_Controller_Action_Helper_Abstract
{

    /**
     * accesses Zend_Db ressource
     * @return Zend_Db|null
     */
    public function direct( )
    {
        return $this->_getResource('db');
    }
}