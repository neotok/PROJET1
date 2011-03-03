<?php

$_SERVER['REQUEST_URI'] = '/';
$_SERVER['HTTP_HOST'] = 'yapuca.ip-formation.local';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';


defined('APPLICATION_PATH') || 
    define(
        'APPLICATION_PATH', 
        realpath(dirname(__FILE__) . '/../application')
    );

defined('ROOT_PATH') || 
    define(
        'ROOT_PATH', 
        realpath(dirname(dirname(__FILE__)))
    );
        
defined('CONFIG_PATH') || 
    define(
        'CONFIG_PATH', 
        APPLICATION_PATH . '/configs'
    );
        
define('APPLICATION_ENV', 'testing');



/**
 * Defines absolute & relative URIs
 */ 
defined('URL_MAIN_REL') ||
    define('URL_MAIN_REL', rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/');
defined('URL_MAIN_ABS') ||
    define('URL_MAIN_ABS', 'http://' . $_SERVER['HTTP_HOST'] . URL_MAIN_REL);
/**
 * Defines some usefull constants
 */ 
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('TAB', "\t");

/**
 * Ensures library/ is on include_path
 */ 
set_include_path(
    implode(
        PATH_SEPARATOR, 
        array(realpath(ROOT_PATH . DS . 'library'), get_include_path())
    )
);

require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
spl_autoload_unregister(array($autoloader, 'autoload'));

Zend_Loader_Autoloader::resetInstance();
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('PHPUnit_');

Zend_Session::$_unitTestEnabled = true; 



