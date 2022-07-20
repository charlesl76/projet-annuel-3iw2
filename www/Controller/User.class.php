<?php

namespace App\Controller;

session_start();

use App\Controller\Mail;
use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Core\Helper;
use App\Core\Mailer;
use App\Core\FormBuilder;
use App\Core\Session;
use App\Model\User as UserModel;
use App\Model\Session as UserSession;
use Exception;

class User
{

    public function forgotPassword()
    {
        $user = new UserModel();
        $mail = new Mail();

        if (isset($_POST['user_cred']) && !empty($_POST['user_cred'])) {

            $data = $user->forgotPassword($_POST['user_cred']);

            if ($data !== false && !isset($data['error'])) {
                $body = "
                <div class=\"container\">
                    <h1>Réinitialisation de votre mot de passe</h1>
                    <p>Hello " . $data["username"] . ", pour réinitialiser votre mot de passe, cliquez sur le lien ci-dessous.</p>
                    <p><a href=\"http://" . $_SERVER['SERVER_NAME'] . "/forgot-password/r/" . $data['token'] . "\">Réinitialiser votre mot de passe</a></p>
                    
                    <p>Si vous n'avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer cet e-mail.</p>
                    <p class=\"signature\">Sported</p>      
                </div>
    
                <style>
                .container {
                    border: 1px solid #d4d4d4;
                    border-radius: 5px;
                    padding: 10px;
                    margin: 0 auto;
                    width: 50%;
                    margin-top: 20px;
                    font: normal 14px/23px 'Helvetica', Arial, sans-serif;
                }
    
                h1 {
                    font-size: 18px;
                    font-weight: bold;
                    margin: 1em 0;
                }
    
                p {
                    margin: 0;
                }
    
                .signature {
                    font-size: 12px;
                    color: #999;
                    margin-top: 1em;
                }
                </style>
    
                ";
                $mail->sendMail($data["email"], "[Sported] Reinitialisation de votre mot de passe", $body);
                header("location: /forgot-password/1");
            } else {
                echo $data['error'];
            }
        } else {
            $view = new View("forgotpassword", "front");
            $final_url = $view->dynamicNav();
            $view->assign("titleSeo", "Forgot Password");
            $view->assign("final_url", $final_url);
        }
    }

    public function mailSent(array $params)
    {
        $view = new View("forgotpassword", "front");
        $final_url = $view->dynamicNav();
        $view->assign("id", $params["id"]);
        $view->assign("titleSeo", "Forgot Password");
        $view->assign("final_url", $final_url);
    }

    public function tokenCheck(array $params) {
        $user = new UserModel();
        $uri = $_SERVER["REQUEST_URI"];
        $uri_explode = explode("/", $uri);
        if (isset($params["token"])) {
            $data = $user->tokenCheck($params["token"]);
            if ($uri_explode[1] === "forgot-password") {
                if ($data !== false) {
                    $getFormResetPassword = $user->getFormResetPassword();

                    if (!empty($_POST)) {
                        $validator = new Validator();
                        Validator::checkForm($getFormResetPassword, $_POST);
                        if ($validator->changePassword(
                            $params['token'], $_POST['oldPassword'], $_POST['newPassword'], $_POST['newPasswordConfirm'])
                        ) {
                            echo "Votre mot de passe a bien été modifié.";
                        } else echo 'Veuillez vérifier à nouveau les informations saisies.';
                    }

                    $view = new View("resetpassword", "front");
                    $final_url = $view->dynamicNav();
                    $view->assign("getFormResetPassword", $getFormResetPassword);
                    $view->assign("titleSeo", "Reset Password");
                    $view->assign("final_url", $final_url);
                } else header("location: /forgot-password/0");
            } elseif ($uri_explode[1] === "register") {
                if ($data !== false) {
                    $data = $user->findByColumn(["id", "token"], ["token" => $params['token']]);
                    $user = $user->findUserById($data['id']);
                    $user->setActivated(true);
                    $user->save();
                    $view = new View("verifyaccount", "front");
                } else header("location: /");
            }
        }
    }

    public function logout()
    {
        $_SESSION = null;
        // fonction pour supprimer le token
    }

    public function register()
    {
        $user = new UserModel();
        $session = new UserSession();
//        if ($session->ensureUserConnected()) {
//            $view = new View("dashboard", "back");
//            $view->assign("user", $session->getUser());
//        }

        $getFormRegister = $user->getFormRegister();

        if (!empty($_POST)) {
            Validator::checkForm($getFormRegister, $_POST);
            $user->setEmail($_POST['email']);
            $user->setUsername($_POST['username']);
            $user->setPassword(hash('sha512', $_POST['password']));
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->generateToken();
            $datetime = new \DateTime();
            $user->setRegistered_at($datetime->format('Y-m-d H:i:s'));
            if ($user->save() !== null) {
                $mail = new Mail();
                $body = "
                <div class=\"container\">
                    <h1>Véréfication de votre adresse e-mail</h1>
                    <p>Hello " . $user->getUsername() . ", veuillez cliquer sur ce lien pour vérifier votre compte.</p>
                    <p><a href=\"http://" . $_SERVER['SERVER_NAME'] . "/register/r/" . $user->getToken() . "\">Vérifier mon compte</a></p>
                </div>
    
                <style>
                .container {
                    border: 1px solid #d4d4d4;
                    border-radius: 5px;
                    padding: 10px;
                    margin: 0 auto;
                    width: 50%;
                    margin-top: 20px;
                    font: normal 14px/23px 'Helvetica', Arial, sans-serif;
                }
    
                h1 {
                    font-size: 18px;
                    font-weight: bold;
                    margin: 1em 0;
                }
    
                p {
                    margin: 0;
                }
    
                .signature {
                    font-size: 12px;
                    color: #999;
                    margin-top: 1em;
                }
                </style>
    
                ";
                $mail->sendMail($user->getEmail(), "Veuillez verifier votre adresse e-mail", $body);
            }
        }
        $view = new View("register");
        $view->assign("user", $user);
        $view->assign("getFormRegister", $getFormRegister);
    }


    public function login()
    {
        $user = new UserModel();

        if (!empty($userById)) {
            $form = $user->getFormUpdate($userById);
            $view = new View("show", "back");
            $view->assign("form", $form);
        } else {
            $getFormLogin = $user->getFormLogin();
            if(isset($_POST['username']) && isset($_POST['password'])) {
                $user_data = $user->findByColumn(
                    ["id", "username", "email"],
                    ["username" => $_POST['username'], "password" => hash('sha512', $_POST['password'])]
                );
                if ($user_data){
                    try {
                        $session = new UserSession();
                        $session->setUserId($user_data['id']);
                        $session->save();
                        $_SESSION['Authorization'] = 'Bearer '.$session->getToken();
                        echo "Vous êtes maintenant connecté.";
                        http_response_code(201);
                    } catch (Exception $e) {
                        echo $e;
                    }
                }
            } else {
                $view = new View("login");
                $view->assign("getFormLogin", $getFormLogin);
            }
        }
    }

    

    public function update()
    {
        $user = new UserModel();
        $userById = $user->setId($_POST['id']);
        if (empty($userById)) {
            header("Location: /users");
        } else {
            $user = $user->setId($_POST['id']);
            $user->setUsername($_POST['username']);
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setRole($_POST['role']);
            $user->save();
            header("Location: /users/" . $user->getId());
        }
    }

    public function show(array $params)
    {
        $user = new UserModel();
        $userById = $user->setId($params['id']);

        if(!empty($userById)) {
            $form = $user->getFormUpdate($userById);
            $view = new View("show", "back");
            $view->assign("form", $form);
        } else header("Location: /users");
    }

    public function delete()
    {
        $user = new UserModel();
        $user->deleteOne();

        header("Location: /users");
    }

}
