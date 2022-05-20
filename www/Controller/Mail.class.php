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

        $token = "abcde";
        $email = "mail@adress.com";
        $registration->sendMail($email, $token);
    }
}
