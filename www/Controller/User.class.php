<?php

namespace App\Controller;

session_start();

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Core\Helper;
use App\Core\Mailer;
use App\Core\FormBuilder;
use App\Core\Session;
use App\Model\User as UserModel;
use App\Model\Session as UserSession;
use App\Controller\Mail;
use Exception;

class User
{

    public function forgotPassword()
    {
        $user = new UserModel();
        $mail = new Mail();

        if (isset($_POST['user_cred']) && !empty($_POST['user_cred'])) {
            $data = $user->forgotPassword($_POST['user_cred']);
            print_r($data);
            if ($data !== false) {
                $body = "
                <div class=\"container\">
                    <h1>Reset your password</h1>
                    <p>Hello " . $data["username"] . ", to reset your password, click the link below.</p>
                    <p><a href=\"http://" . $_SERVER['SERVER_NAME'] . "/r/" . $data['token'] . "\">Reset your password</a></p>
                    
                    <p>If you did not request a password reset, please ignore this email.</p>
                    <p class=\"signature\">Sitename.</p>      
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
                $mail->sendMail($data["email"], "[Sitename] Reset password request", $body);
                var_dump('sentmail');
//                header("location: /forgot-password/1");
            } else {
//                header("location: /forgot-password/0");
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
        var_dump($params);
        if (isset($params['id'])) {
            $data = $user->tokenCheck($params["id"]);
            if ($data !== false) {
                $view = new View("resetpassword", "front");
                $final_url = $view->dynamicNav();
                $view->assign("id", $data["id"]);
                $view->assign("token", $params["token"]);
                $view->assign("titleSeo", "Reset Password");
                $view->assign("final_url", $final_url);
            } else header("location: /forgot-password/0");
        } elseif (isset($params['token'])) {
            $data = $user->tokenCheck($params["token"]);
            if ($data !== false) {
                $view = new View("verifyaccount", "front");
                $view->assign("username", $data['username']);
            } else header("location: /");
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
        if ($session->ensureUserConnected()) {
            $view = new View("dashboard", "back");
            $view->assign("user", $session->getUser());
        }

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
            if ($user->save()) {
                $mail = new Mail();
                $body = "
                <div class=\"container\">
                    <h1>Véréfication de votre adresse e-mail</h1>
                    <p>Hello " . $user->getUsername() . ", veuillez cliquer sur ce lien pour vérifier pour compte.</p>
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
                echo $body;
                $mail->sendMail($user->getEmail(), "Veuillez vérifier votre adresse e-mail", $body);
                http_response_code(201);
                echo json_encode($user);
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
                        echo json_encode([
                            'token' => $session->getToken()
                        ]);
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
