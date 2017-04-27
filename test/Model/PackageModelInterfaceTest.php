<?php

namespace FindCode\Test\Model;

use FindCode\Api\Model\PackageModelInterface;
use FormationView\MVC\SubjectInterface;

abstract class PackageModelInterfaceTest extends \PHPUnit\Framework\TestCase
{
    abstract public function getPackageModelInterface(): PackageModelInterface;
    
    /**
     * @dataProvider attributesProvider
     */
    public function testAttribut($attribut)
    {
        $mock = $this->getPackageModelInterface();
        $this->assertTrue(property_exists($mock, $attribut));
    }
    
    /**
     * attributesProvider
     */
    public final function attributesProvider()
    {
        return [
            ["distribuable"],
            ["language"],
            ["description"],
            ["keywords"],
            ["dependencies"],
            ["devDependencies"],
            ["version"],
            ["license"],
            ["author"],
            ["page"],
            ["homepage"],
            
        ];
    }
    /**
     * @dataProvider methodsProvider
     */
    public function testMethods($methods)
    {
        $mock = $this->getPackageModelInterface();
        $this->assertTrue(method_exists($mock, $methods));
        
    }

    /**
     * MethodProvider
     */
    public final function methodsProvider()
    {
        return [
            ["get"],
            ["__construct"],
            
        ];
    }
    
    /**
     * testInstanceOfSubjectInterface
     */
    public function testInstanceOfSubjectInterface()
    {
        $this->assertTrue(
            $this->getPackageModelInterface() instanceof SubjectInterface
            );
    }
    /**
     * testInstanceOfPackageModelInterface
     */
    public function testInstanceOfPackageModelInterface()
    {
        $this->assertTrue(
            $this->getPackageModelInterface() instanceof PackageModelInterface
            );
    }
    
//     /**
//      * @expectedException RuntimeException
//      */
//     public function testRuntimeException()
//     {
//         $mock = $this->getPackageModelInterface();
//         $mock->get();
//     }
}