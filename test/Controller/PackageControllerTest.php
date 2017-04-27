<?php

namespace FindCode\Test\Controller;

use FindCode\Api\Controller\PackageControllerInterface;
use FindCode\Api\Controller\PackageController;
use ReflectionClass;
use FindCode\Api\View\PackageView;
use FindCode\Api\Model\PackageModel;

/**
 * 
 * @author Yo69008
 *
 */
class PackageControllerTest extends PackageControllerInterfaceTest
{
    /**
     * get PackageControllerInterface
     */
    public function getPackageControllerInterface(): PackageControllerInterface
    {
        return (new ReflectionClass(PackageController::class))
        ->newInstanceArgs([
            (new ReflectionClass(PackageModel::class))->newInstanceArgs([]),
            (new ReflectionClass(PackageView::class))->newInstanceArgs([]),
       ]);
    }
    
    
}
