<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Register;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mail
{

    public function verificationMail()
    {
        $view = new View("testmail");

        $registration = new Register;

        $view->assign("titleSeo", "Test mail");

        $token = "abcde";                           // Set the token after registration of the user
        $email = "mail@adress.com";                 // Set the email after registration of the user
        $registration->sendMail($email, $token);    // Send the email
    }

    
}
