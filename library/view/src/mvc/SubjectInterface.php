<?php

namespace FormationView\MVC;

interface SubjectInterface
{
    
    /**
     * Register observer
     * 
     * @param ObserverInterface $observer observer
     */
    public function register (ObserverInterface $observer);
    
    /**
     * Unregister observer
     * 
     * @param ObserverInterface $observer
     */
    public function unregister (ObserverInterface $observer);
    
    /**
     * Notify observer
     */
    public function notify ();
    
    
    
}
