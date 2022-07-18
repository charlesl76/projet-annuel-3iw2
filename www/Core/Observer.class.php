<?php

namespace App\Core;

use App\Core\Interfaces\ObserverInterface;

class Observer implements ObserverInterface 
{

    private $observers = [];

    /**
     * Registers observer to the subject
     * @param object $observer Observer that will be registered
     * @return bool True if the observer has been attached, false otherwise
     * @access public
     */
    public function attach($observer) {
        if(!in_array($observer, $this->observers)) {
            $this->observers[] = $observer;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Unregisters observer from the subject
     * @param object $observer Observer that will be unregistered
     * @return bool True if the observer has been detached, false otherwise
     * @access public
     */
    public function detach($observer) {
        if(!in_array($observer, $this->observers)) {
            return false;
        } else {
            $key = array_search($observer, $this->observers);
            unset($this->observers[$key]);
            $this->observers = array_values($this->observers); //Reindex array after unset
            return true;
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

    
    // Example of notifying the observer state change
    public function updateUsername($username) {
        $this->username = $username;

        // This triggers all attached observers
        $this->notify();
    }

    public function updateFirstName($first_name) {
        $this->first_name = $first_name;

        // This triggers all attached observers
        $this->notify();
    }

    public function updateLastName($last_name) {
        $this->last_name = $last_name;

        // This triggers all attached observers
        $this->notify();
    }

    public function updateEmail($email) {
        $this->email = $email;

        // This triggers all attached observers
        $this->notify();
    }

    public function updatePassword($password) {
        $this->password = $password;

        // This triggers all attached observers
        $this->notify();
    }

}