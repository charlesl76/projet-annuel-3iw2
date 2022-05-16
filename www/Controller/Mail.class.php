<?php

namespace App\Controller;

use App\Core\View;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mail
{

    public function mail()
    {
        // Enable view testmail.view.php
        $view = new View("testmail");
        $view->assign("titleSeo","Se connecter au site");
    }

    public function connectSMTP()
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'localhost';               //Adresse IP ou DNS du serveur SMTP
        $mail->Port = 465;                          //Port TCP du serveur SMTP
        $mail->SMTPAuth = 1;                        //Utiliser l'identification

        if ($mail->SMTPAuth) {
            $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
            $mail->Username   =  'noreply@sported.site';   //Adresse email à utiliser
            $mail->Password   =  'password';         //Mot de passe de l'adresse email à utiliser
        }

        $mail->smtpConnect();
    }

    public function sendMail($mail, $Use_HTML) 
    {
        $mail->From       =  'contact@ovh.net';                //L'email à afficher pour l'envoi
        $mail->FromName   = 'Contact de ovh.net';             //L'alias à afficher pour l'envoi

        $mail->Subject    =  'Mon sujet';                      //Le sujet du mail
        $mail->WordWrap   = 50;                                //Nombre de caracteres pour le retour a la ligne automatique
        $mail->AltBody = 'Mon message en texte brut';            //Texte brut
        $mail->IsHTML(false);                                  //Préciser qu'il faut utiliser le texte brut

        if ($Use_HTML == true) {
            $mail->MsgHTML('<div>Mon message en <code>HTML</code></div>');                         //Le contenu au format HTML
            $mail->IsHTML(true);
        }

        $view = new View("testmail");
    }
}
