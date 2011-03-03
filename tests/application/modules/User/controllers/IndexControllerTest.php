<?php

class User_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
	protected $_application;
	
    public function setUp()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        return parent::setUp();
    }
    
    public function appBootstrap()
    {
    	$this->_application = new Zend_Application(
    		APPLICATION_ENV, 
    		APPLICATION_PATH . '/configs/application.ini'
    	);
    	
    	$this->_application->bootstrap();
    	/** Fix for bug ZF-8193 */
    	$front = Zend_Controller_Front::getInstance();
    	if( $front->getParam('bootstrap') === null ){
    		$front->setParam('bootstrap', $this->_application->getBootstrap());
    	}
    }

    public function tearDown()
    {
    	parent::tearDown();
        /* Tear Down Routine */
    }
    

    
    public function testValidCredentialsShouldResultInRedisplayOfLoginForm()
    {
    	$this->getRequest()->setMethod('POST')
        				   ->setPost('login', 'test')
        				   ->setPost('password', 'test');

        $this->dispatch('/User/index/login');  
        $this->assertTrue( Zend_Auth::getInstance()->hasIdentity());

    }
    
}
