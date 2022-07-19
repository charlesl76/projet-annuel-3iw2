<?php

namespace App\Core;

use App\Core\BaseSQL;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './Controller/PHPMailer/src/Exception.php';
require './Controller/PHPMailer/src/PHPMailer.php';
require './Controller/PHPMailer/src/SMTP.php';


class Mailer 
{

    protected $id = null;
    protected $email;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $status = null;
    protected $token = null;
    protected $birth;
    protected $verification_code;

    public function __construct()
    {
        parent::__construct();
    }

    public function sendMail($email, $verification_code)
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
            $mail->Subject = 'Your email registration link';
            $mail->Body = "Thanks for registring with us. To activate your account click <a href='http://localhost/verify?email=$email&verification_code=$verification_code'>here</a>";

            $result = $mail->send();
        } catch (Exception $e) {
            echo '<pre>';
            echo 'SMTP error: ' . $e->getMessage(), "\r\n";
            echo '</pre>';
        }
    }
}