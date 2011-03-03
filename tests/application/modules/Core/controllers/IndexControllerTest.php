<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
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
        /* Tear Down Routine */
    }

    public function testIndexPageShouldFullFromRightMCA()
    {
        $this->dispatch('/');
        
        $this->assertModule('Core');
        $this->assertController('index');
        $this->assertAction('index');
    }
    
    public function testIndexTitle()
    {
        $this->dispatch('/');
        $this->assertQueryContentContains('h3', 'Install de base ZF');
    }
}
