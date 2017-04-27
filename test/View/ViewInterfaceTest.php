<?php

namespace FindCode\Test\View;

use FindCode\Api\View\ViewInterface;
use stdClass;
use FormationView\MVC\AbstractSubject;
use FormationView\MVC\SubjectInterface;

abstract class ViewInterfaceTest extends \PHPUnit\Framework\TestCase
{
    abstract public function getViewInterface (): ViewInterface;
    
    /**
     * 
     * testHello
     */
    public function  testInstanceofViewInterface()
    {
        
        $this->assertTrue(
            $this->getViewInterface() instanceof ViewInterface
        );
    }
    /**
     * testMethods
     */
    public function  testMethods()
    {
        $mock = $this->getViewInterface();
        $this->assertTrue(
            method_exists($mock, "render")
        &&  method_exists($mock, "update")
        );    
    }
    
    /**
     * @expectedException TypeError
     */
    public function testTypeError()
    {
        $this->getViewInterface()
        ->update("Dummy");
    }
    
    /**
     * testRenderJSONOnly
     */
     public function testRenderJSONOnly ()
     {
         $mock = $this->getViewInterface();
         $this->assertTrue(
             is_string($mock->render()) &&
             json_decode($mock->render()) instanceof stdClass            
         );
     }  
    /**
     * testUpdate
     */
    public function testUpdate ()
    {
        $subjectMock = (new \ReflectionClass(DummyTest::class))
                        ->newInstance([]);
        $mock = $this->getViewInterface();
        $mock->update($subjectMock);
//        var_dump($mock->render());
        $obj = json_decode($mock->render());
        $this->assertTrue(
             property_exists($obj, "foo")
         &&  $obj->foo === "foo"  
        );
    }
}

class DummyTest extends AbstractSubject implements SubjectInterface
{
    public $foo = "foo";
    public function __construct()
    {
        parent:: __construct();
    }
}