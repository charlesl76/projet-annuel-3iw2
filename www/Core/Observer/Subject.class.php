<?php

namespace App\Core;

class Subject 
{

    private $observers = [];

    /**
     * Registers observer to the subject
     * @param object $observer Observer that will be registered
     * @return bool True if the observer has been attached, false otherwise
     * @access public
     */
    public function attach($observer) {
        $this->observers[] = $observer;
    }

    /**
     * Unregisters observer from the subject
     * @param object $observer Observer that will be unregistered
     * @return bool True if the observer has been detached, false otherwise
     * @access public
     */
    public function detach($observer) {
        foreach ($this->observers as $key => $obs) {
            if ($observer == $obs) {
                unset($this->observers[$key]);
                break;
            }
        }
    }

    /**
     * Notifies all observers with $message
     * @param stdClass $message Message that will be sent to observers
     * @access public
     */
    public function notify() {
        // Updates all classes subscribed to this object
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    
}