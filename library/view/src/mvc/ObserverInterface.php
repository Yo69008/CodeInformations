<?php

namespace FormationView\MVC;

interface ObserverInterface
{
    /**
     * Update
     * updated on subject notification
     * 
     * @param SubjectInterface $subject
     */
    public function update(SubjectInterface $subject);
    
}
