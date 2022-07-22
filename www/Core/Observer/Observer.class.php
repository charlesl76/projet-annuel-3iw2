<?php

use App\Core;
use App\Controller;
use App\Core\Subject;
use App\Controller\Mail;


class Observer
{
    public function update(Subject $subject) 
    {
        $mail = new Mail();
        $email = [$this->email];
        $sub = "New Subject";
        $body = "Notification sent to ' . $this->email . ' about a rise of ' . $subject->name";
        $res = $mail->sendMail($email, $sub, $body);

        return $res;
    }
}
