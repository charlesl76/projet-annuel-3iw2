<?php

namespace App\Controller;

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
                    <h1>Reset your password</h1>
                    <p>Hello " . $data["username"] . ", to reset your password, click on the link below.</p>
                    <p><a href=\"http://" . $_SERVER['SERVER_NAME'] . "/forgot-password/r/" . $data['token'] . "\">Reset you password</a></p>
                    
                    <p>If you have not requested a password reset, please ignore this email.</p>
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
                $mail->sendMail($data["email"], "[Sported] Reset your password", $body);
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
                            echo "Your password has been changed.";
                        } else echo 'Please double check the information you have entered.';
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
        // fonction pour supprimer le token
        $session = new UserSession();
        $session->erase();
        header("refresh: 2; url=/");
    }

    public function register()
    {
        $user = new UserModel();
        $session = new UserSession();
        if ($session->ensureUserConnected()) {
//            $view = new View("dashboard", "back");
//            $view->assign("user", $session->getUser());
            header("Location: /dashboard");
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
            if ($user->save() !== null) {
                $mail = new Mail();
                $body = "
                <div class=\"container\">
                    <h1>Verification of your e-mail address</h1>
                    <p>Hello " . $user->getUsername() . ", please click on this link to verify your account.</p>
                    <p><a href=\"http://" . $_SERVER['SERVER_NAME'] . "/register/r/" . $user->getToken() . "\">Verify my account</a></p>
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
                $mail->sendMail($user->getEmail(), "Please check your e-mail addressl", $body);
                echo "You are now registered. Please check your email to validate your account.";
            }
        }

        $view = new View("register", "front-login");
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
            $getFormLogin = FormBuilder::render($user->getFormLogin());
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
                        echo "You are now logged in. You will be redirect.";
// Ajout de la redirection après loggin                        
                        // if($session->getUser()->getRole() === "user" ){
                        //      header("refresh: 2; url=/");
                        //  } elseif($session->getUser()->getRole() === "admin"){
                        //      header("refresh: 2; url=/dashboard");
                        //  }
                        http_response_code(201);
                    } catch (Exception $e) {
                        echo $e;
                    }
                } else echo "Wrong credentials.";
            } else {
                $view = new View("login", "front-login");
                $view->assign("getFormLogin", $getFormLogin);
            }
        }

    }


    

    public function forgetPassword()
    {
        $user = new UserModel();
        $configForm = $user->getFormResetPassword();
        $v = new View("forgetPassword", "front");
        $v->assign('forgetPassword', $configForm);

        if (!empty($_POST)) {
            $user = new UserModel(["email" => $_POST['email']]);
            
            if ($user->__get('id')==true) {
                $token = $this->generateToken();
                $user->__set('pwd_token',$token);
                $user->save();
                $name = $user->__get('last_name');
                $body="Bonjour $name !<br><br> You have requested to reset your password. 
                Change your password by clicking on the link below:. ". Helper::host() ."changer_mot_de_passe?t=$token\"<br><BT></BT>";
                Helper::sendMail($user->__get('email'),"Changement de mot de passe",$body);

            }else{
                 $_SESSION['alert']['danger'][] = "The email address was not found";
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
