<?php

namespace FormationView\MVC;

abstract class AbstractSubject
{
  protected
   /**
   * @var ObserverInterface observer
   */
        $observer;
  
  protected function __construct ()
  {
      $this->observer = [];
  }
  
    /**
     * Register observer
     *add on observer for notification
     *
     * @param ObserverInterface $observer observer
     */
    public function register (ObserverInterface $observer)
    {
        $this->observer[] = $observer;
    }
    
    /**
     * Unregister observer
     *
     * @param ObserverInterface $observer
     */
    public function unregister (ObserverInterface $observer)
    {
        $key = array_search($observer, $this->observer);
        if (is_int($key)) {
            unset($this->observer[$key]);    
        }
        
    }
    
    /**
     * Notify observer
     */
    public function notify ()
    {
        foreach($this->observer as $observer) {
            $observer->update($this);
        }
    }
    
}
