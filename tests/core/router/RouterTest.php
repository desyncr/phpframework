<?php

namespace Core\Router;

require_once dirname(__FILE__) . '/../../../core/Exception.php';
require_once dirname(__FILE__) . '/../../../core/router/utils/Utils.php';
require_once dirname(__FILE__) . '/../../../core/router/Router.php';

/**
 * Test class for Router.
 * Generated by PHPUnit on 2012-05-27 at 21:28:03.
 */
class RouterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Router
     */
    protected $object;
    private $namespace  = 'Application';
    private $controller = 'Index';
    private $action     = 'index';
    private $params     = array('name','Dario');

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->path = dirname(__FILE__);

        $url = "/" . $this->controller . "/" . $this->action . "/" . join("/",$this->params);
        $this->assertEquals($url, '/Index/index/name/Dario');
        
        $params = array(
            'namespace' => 'Application',
            'controller' => 'Index',
            'action' => 'index',
            'includePath' => '/home/asphyxia/projects/phpframework/application/controllers/',
        );
        
        $this->object = new Router();

    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testProcessPath() {
        $path = '/namespace/controller/action/param1/value1/param2/value2';
        $this->object->processPath($path);
        $this->assertTrue($this->object->getController() == 'Controller');
        $this->assertTrue($this->object->getAction() == 'action');
    }
    
    /**
     * @covers {className}::{origMethodName}
     */
    public function testSetController() {      
        $controllers = array(
          'Index'  , 'Test', 'Other'
        );
        foreach ($controllers as $controller) {
            $this->object->setController($controller);
            $this->assertTrue($controller == $this->object->getController());
        }
        
        $this->setExpectedException('Core\Exception');
        $this->object->setController('3333dsd00:::\\/');
        $this->object->setController('/var/');
    }
    
    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetController() {
        $test = 'Index';
        $this->object->setController($test);
        $this->assertEquals($test, $this->object->getController());
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testSetAction() {
        //$this->setExpectedException('Core\Exception');
        //$this->object->setAction('__construct');
    }
    
    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetAction() {
        $test = 'index';
        $this->object->setAction($test);
        $this->assertEquals($test, $this->object->getAction());
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testSetParams() {
        $test = array('rape', 'is', 'fun');
        $this->assertEquals($test, $this->object->setParams($test));
    }
    
    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetParams() {
        $test = Array('name' => 'Dario');
        $this->object->setParams($test);
        $this->assertEquals($test, $this->object->getParams());
    }

    /**
     * @covers {className}::{origMethodName}
     */
    public function testSetIncludePath() {
        $this->setExpectedException('Core\Exception');
        $test = 'C:\Windows\XP/var/tmp/bin:/usr/bin/perl -w';
        $this->object->setIncludePath($test);
        
        $test = '../un/exis/ten/t/pat/hcla/ss/';
        $this->object->setIncludePath($test);
        
        $test = $this->path . '/core/../application/controllers/';
        $this->assertEquals($test, $this->object->setIncludePath($path));
    }
    
    /**
     * @covers {className}::{origMethodName}
     */
    public function testGetIncludePath() {
       $test = $this->path . '/../../../application/controllers/';
       $this->object->setIncludePath($test);
       $this->assertEquals($test, $this->object->getIncludePath());
    }
    
    /**
     * @covers {className}::{origMethodName}
     */
    public function testRouteController() {
        $test = $this->path . '/../../../application/controllers/';
        $this->object->setIncludePath($test);
        
        $action = 'index';
        $this->object->setAction($action);
        
        $controller = 'Index';
        $this->object->setController($controller);

        $namespace = 'Application';
        $this->object->setNamespace($namespace);
        
        $test = array('name' => 'Anonymous');
        $res = $this->object->routeController();
        $this->assertEquals($test['name'], $res['name']);
        
        $param = 'Adarioasd';
        $test = array('name' => $param);
        $this->object->setParams($test);
        $res = $this->object->routeController();
        $this->assertEquals($test['name'], $res['name']);
    }
}

?>
