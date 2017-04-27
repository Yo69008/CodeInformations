<?php

namespace FindCode\Api\Controller;

use FindCode\Api\Model\PackageModel;
use FindCode\Api\View\PackageView;

class PackageController implements PackageControllerInterface
{
    private
    /**
     * @var SubjectInterface model
     */
    $model,
    /**
     * @var ObserverInterface view
     */
    $view;
    
        public function __construct(PackageModel $model, PackageView $view)
        {
            
            $this->model = $model;
            $this->view = $view;
            $this->model->register($this->view);
        }
        public function execute()
        {
            try {
                $action = strtolower(filter_input(INPUT_SERVER, "REQUEST_METHOD"));                
                if(method_exists($this->model, $action)) {
                    $package = filter_input(INPUT_GET, "package");
                    if ($package) {
                            $this->model->package = $package;
                            $this->model->{$action}();
                    } else {
                        header("HTTP/1.1 412 Precondition Failed");
                    }
                    
                } else {
                    header("HTTP/1.1 405 Method Not Allowed");    
                }
            } catch (\RuntimeException $e) {
                header("HTTP/1.1 404 Not Found");    
          
            } catch (Throwable $e){
                header("HTTP/1.1 500 Internal Server Error");
                
            }
            $this->view->update($this->model);
            return $this->view->render();
        }
    
}