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
 * @desc	   Zend_Application_Resource_Zfdebug
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
 * @desc	   Zend_Application_Resource_Zfdebug
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    1.0 2010-10-10
 * @author	   Dev 17 <dev@ip-formation.com>
 * @copyright  Copyright (c) 2011 DEV 17 
 * @version	   Release : 1.0.1 (2011-02-28)
 * @see Zend_Application_Resource_ResourceAbstract
 */
class Ip_Application_Resource_Zfdebug extends Zend_Application_Resource_ResourceAbstract
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
            $this->_view = new Ip_View($this->_localOptions);
        }
		 
		 if( !$this->_localOptions['run'] ) 
             return;
         $autoloader = Zend_Loader_Autoloader::getInstance();
         $autoloader->registerNamespace('ZFDebug');
        
         $options = array(
             'plugins' => array('Variables', 
                                'File' => array('base_path' => APPLICATION_PATH),
                                'Html', 
                                'Memory', 
                                'Time', 
                                //'Registry', 
                                'Exception')
         );
        
         # Instantiate the database adapter and setup the plugin.
         # Alternatively just add the plugin like above and rely on the autodiscovery feature.
		 $bootstrap = $this->getBootstrap();
         if ($bootstrap->hasPluginResource('db')) {
             $bootstrap->bootstrap('db');
             $db = $bootstrap->getPluginResource('db')->getDbAdapter();
             $options['plugins']['Database']['adapter'] = $db;
         }

         # Setup the cache plugin
          if ($bootstrap->hasPluginResource('cacheManager')) {
              $bootstrap->bootstrap('cacheManager');
              $cache = $bootstrap->getPluginResource('cacheManager')->getOptions();
              $options['plugins']['Cache']['backend'] = $cache['frontcore']['backend'];
          }

         $debug = new ZFDebug_Controller_Plugin_Debug($options);
        
         $bootstrap->bootstrap('frontController');
         $frontController = $bootstrap->getResource('frontController');
         $frontController->registerPlugin($debug);
    }


}