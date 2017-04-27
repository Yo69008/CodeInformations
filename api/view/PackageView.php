<?php

namespace FindCode\Api\View;

use FormationView\MVC\ObserverInterface;
use FormationView\MVC\SubjectInterface;
use FindCode\Test\View;

class PackageView implements ObserverInterface, ViewInterface
{
    private $template;
    
    public function __construct()
    {
        $this->template = "{}";
    }    
    /**
     * 
     * {@inheritDoc}
     * @see \FormationView\MVC\ObserverInterface::update()
     */
    public function update(SubjectInterface $subject)
    {
        $this->template = json_encode($subject, JSON_PRETTY_PRINT);
   
    }
    
    public function render ()
    {
        return $this->template;
    }
}