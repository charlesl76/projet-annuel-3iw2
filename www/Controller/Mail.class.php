<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Register;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mail
{

    function sendMail($email, $subject, $body)
    {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                  // Enable verbose debug output
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Port = 587;                                      // TCP port to connect to
            $mail->Host = 'pro1.mail.ovh.net';                      // Specify main and backup SMTP servers
            $mail->Username = 'noreply@sported.site';               // SMTP username
            $mail->Password = 'whatisthat94+A';                     // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption, `ssl` also accepted
            

            $mail->setFrom('noreply@sported.site', 'Sported');
            $mail->addAddress($email);                              // Add a recipient
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $result = $mail->send();
        } catch (Exception $e) {
            echo '<pre>';
            echo 'SMTP error: ' . $e->getMessage(), "\r\n";
            echo '</pre>';
        }
    }

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
