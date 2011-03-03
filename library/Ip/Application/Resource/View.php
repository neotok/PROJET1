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
 * @package    Ip_Application
 * @subpackage Ip_Application_Resource
 * @desc	   Zend_Application_Resource_View override
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    1.0 2010-10-10
 * @author	   Dev 17 <dev@ip-formation.com>
 * @copyright  Copyright (c) 2011 DEV 17 
 * @version	   Release : 1.0.1 (2011-02-28)
 */


/**
 * 
 * @category   Ip
 * @package    Ip_Application
 * @subpackage Ip_Application_Resource
 * @desc	   Zend_Application_Resource_View override
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    1.0 2010-10-10
 * @author	   Dev 17 <dev@ip-formation.com>
 * @copyright  Copyright (c) 2011 DEV 17 
 * @version	   Release : 1.0.1 (2011-02-28)
 * @see Zend_Application_Resource_ResourceAbstract
 */

class Ip_Application_Resource_View extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * 
     * Config options
     * @var array|Zend_Config
     * @access protected
     */
    protected $_localOptions;
    
    /**
     * Zend_View container.
     * @var Zend_View
     * @access protected
     */
    protected $_view;
 
	
    /* *
     * 
     * Class pseudo contructor
     * @see Zend_Application_Resource_Resource::init()
     * @return Zend_View
     */
    public function init()
    {
	
		$this->_localOptions = $this->getOptions();

        # Returns view so bootstrap will store it in the registry
        if (null === $this->_view) {
            $this->_view = new Ip_View($this->_options);
        } 
		
		$this->_setupCss();
		$this->_setupJs();
		$this->_setupHeadOptions();
		
		$viewRenderer =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'ViewRenderer'
                );
        $viewRenderer->setView($this->_view);
		return $this->_view;
    }

	/**
	 * Setup css stylesheet in headStyle stack
	 * @return null
	 */
	protected function _setupCss()
	{
        $this->_view->headLink()->appendStylesheet( '/css/style.css' );
        $this->_view->headLink()->appendStylesheet( '/css/print.css' , 'print');
	}
	/**
	 * Setup js scripts in headStyle stack
	 * @return null
	 */
	protected function _setupJs()
	{
		$this->_view->headScript()->appendFile('/js/jquery-1.4.2.min.js', $type = 'text/javascript');
	}
	/**
	 * Setup head block
	 * @return null
	 */
	protected function _setupHeadOptions()
	{
		// Défini le charset
		$this->_view->headMeta()->setHttpEquiv( 'Content-Type', 'text/html; charset=' . $this->_localOptions['encoding'] );
		// Défini le doctype
		$this->_view->doctype($this->_localOptions['doctype']);
	}


}