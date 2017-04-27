<?php

namespace FindCode\Api\Model;

use FormationView\MVC\SubjectInterface;
use FormationView\MVC\AbstractSubject;

class PackageModel extends AbstractSubject implements 
    SubjectInterface, 
    PackageModelInterface
{
    public
        /**
         * @var array package
         */
        $testable,
        $distribuable,
        $package,
        $keywords,
        $name,
        $homepage,
        $license,
        $author,
        $description,
        $dependencies,
        $devDependencies,
        $version,
        $language,
        $type,
        $page;
    /**
     * Construct PageModel
     */
    public function __construct()
    {
        parent:: __construct();
        $this->keywords = [];
        $this->author = "";
        $this->page = "";
        $this->name = "";
        $this->package = "";
        $this->homepage = "";
        $this->license = "";
        $this->author = "";
        $this->description = "";
        $this->dependencies = [];
        $this->devDependencies = [];
        $this->version = [];
        $this->language = "";
        $this->type = "library";
        $this->distribuable = false;
        $this->testable = false;
    }
    /**
     * consume
     * 
     * @param string $url
     * @param bool $ping
     */
    private function consume (string $url, bool $ping = false)
    {
        $filename = __DIR__ . "/cache/" . md5($url);
//         if (file_exists($filename)){
//             $output = file_get_contents($filename);
//         } else {
            $code = "404";
            $output = @file_get_contents($url);
            if(isset($http_response_header)) {
                $tab=explode(" ", $http_response_header[0]);
                $code = $tab[1];
            }
            if ($code==="200") {
                file_put_contents($filename, $ping ? $url : $output);
            } else {
                $ping = false;
            }
//         }
        return $ping ? $ping : json_decode($output);
    }


/**
 * setAttribute
 * 
 * @param \stdClass $obj
 */
    private function setAttribute(\stdClass $obj)  
    {
        $this->description = isset($obj->description) ? $obj->description : "";
        $this->name = isset ($obj->name) ? $obj->name : "";
        $this->keywords = isset($obj->keywords) ? $obj->keywords : [];
        $this->license = isset($obj->license) ? $obj->license : "";
        $this->homepage = isset($obj->homepage) ? $obj->homepage : "";

    }
    
/**
 * packageloader
 * 
 * @return boolean
 */
    private function packageloader()
    {
        $url ="https://raw.githubusercontent.com/" . $this->package 
                ."/master/package.json";
        $obj = $this->consume($url);

        if ($obj) {
            $this->language = "js";
            $this->setAttribute($obj);
            $this->dependencies = isset($obj->dependencies) ? 
                                $obj->dependencies : [];
            $this->devDependencies = isset($obj->devDependencies) ? 
                                $obj->devDependencies : [];
            $this->author = isset($obj->author) ? 
                                $obj->author : "";
            $this->version = isset($obj->version) ? 
                                $obj->version : "";
            $this->npm();
            $this->consumeTravis();
            return true;
        }
        return false;
    }
    
/**
 * composerloader
 * 
 * @return boolean
 */
    private function composerloader()
    {
        $url ="https://raw.githubusercontent.com/" 
            . $this->package ."/master/composer.json";
        $obj = $this->consume($url);

        if ($obj) {
            $this->language = "php";
            $this->setAttribute($obj);
            $this->dependencies= isset($obj->require) ? $obj->require : [];
            $this->devDependencies= isset($obj->require_dev) ?
                                    $obj->require_dev : [];
            $this->author = isset($obj->authors) ? $obj->authors : "";
            $this->version = isset($obj->version) ? $obj->version : [];
            $this->packagist();
            $this->consumeTravis();
 
            return true;
        }
        return false;
    }
    
    /**
     * npm
     */
    private function npm()
    {
        $url ="https://www.npmjs.com/package/". $this->name;
            return $this->distribuable = (bool) $this->consume ($url, true);

    }
    
   /**
    * packagist
    */
    private function packagist()
    {
        $url ="https://www.packagist.org/packages/". $this->package .".json";
        return $this->distribuable = (bool) $this->consume ($url, true);
       
        if (isset($package->dependencies)
            && is_object($package->dependencies)) {
                foreach ($package->dependencies as $key => $value) {
                    $this->dependencies[] = $key;
                }
            }
            if (isset($package->devDependencies)
                && is_object($package->devDependencies)) {
                    foreach ($package->devDependencies as $key => $value) {
                        $this->devDependencies[] = $key;
                    }
                }
                if (isset($package->author) && is_string($package->author)) {
                    $this->author = $package->author;
                }
    }

    private function consumeTravis ()
    {
        $url = "https://raw.githubusercontent.com/" . $this->package
        . "/master/.travis.yml";
        $this->testable = (bool) $this->consume($url, true);
        
    }
 
 /**
  * get
  * 
  * @throws \RuntimeException
  */   
    public function get()
    {  
        if (!$this->packageloader() 
            && !$this->composerloader()
            && !$this->npm()) {
             throw new \RuntimeException();
        }    
       
    }
}
