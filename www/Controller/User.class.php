<?php

namespace App\Controller;


use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Core\Helper;
use App\Core\Mailer;
use App\Core\FormBuilder;
use App\Core\Session;
use App\Model\User as UserModel;
use App\Controller\Mail;

class User
{

    public function login()
    {
        $view = new View("Login");
        $view->assign("titleSeo", "Se connecter au site");
    }

    public function forgotPassword()
    {
        $user = new UserModel();
        $mail = new Mail();

        if (isset($_POST['user_cred']) && !empty($_POST['user_cred'])) {

            $data = $user->forgotPassword($_POST['user_cred']);

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
                echo $body;
                $mail = $mail->sendMail($data["email"], "[Sitename] Reset password request", $body);

                header("location: /forgot-password/1");
            } else {

                header("location: /forgot-password/0");
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
        $data = $user->tokenCheck($params["id"]);
        echo $params["id"];

        if ($data !== false) {
            $view = new View("resetpassword", "front");
            $final_url = $view->dynamicNav();
            $view->assign("id", $data["id"]);
            $view->assign("token", $params["token"]);
            $view->assign("titleSeo", "Reset Password");
            $view->assign("final_url", $final_url);
        } else {
            header("location: /forgot-password/0");
        }
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function checkUser($mail){
        $user = new UserModel(["email" => $mail]);
        if($user->__get('id')==true){
           return true;
        }else{
          return false;
        }

    }

    public function modifyPwdAction($password)
    {   
       $this->user->__set('password',$password);
       $this->user->save();
    }

    public function register()
    {
        $session = new Session();
        $user = new UserModel();
        
        $configForm = $user->getFormRegister();

        print_r($_POST);
        if (!empty($_POST)) {
            $result = Validator::run($user->getFormRegister(), $_POST);
            print_r($result);
        }

        //$user= $user->setId(3);
        //$user->setEmail("toto@gmail.com");
        //$user->save();

        $view = new View("register");
        $view->assign("user", $user);
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

 
    private function generateToken(){
        $length=30;
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
        }
        return $string;;
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
