<?php

namespace App\Core\Interfaces;

interface ObserverInterface {
    /**
     * Observer
     *
     * @desc
     *     The Observer pattern has two classes minimum: Subject(ObserverInterface) and Observer(s).
     *         Observers listen for notifications.
     *         Subjects notify the Observer.
     *
     *     You can have many observers attached to one Subject.
     *
     * @usage
     *     You want to know what happens in your framework everywhere.
     *     You want to know what happens in any object.
     *     You want to log anything from anywhere.
     */

    //Attach --> You could call this: listen, register, etc
    public function attach($observer);

    //Detach --> You call call this: unlisten, remove, etc
    public function detach($observer);

    /**
     * This method gets called when an event occurs
     * 
     * @return string
     */

    //Nofify --> You could call this: update, push, etc
    public function notify();


    // Example of notifying the observer state change
    public function updateUsername($username);
    public function updateFirstName($first_name);
    public function updateLastName($last_name);
    public function updateEmail($email);
    public function updatePassword($password);

};