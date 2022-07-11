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



class User{


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

        //print_r($_POST);
        if( !empty($_POST)){
            $method = $configForm["config"]["method"];
            $data = $GLOBALS["_".$method];

            if($_SERVER["REQUEST_METHOD"]==$method && !empty($data)){
                $validator = new Validator($configForm, $data);
                if ($this->checkUser($data['email'])) {
                    $_SESSION['alert']['danger'][] = "L'adresse mail entré correspond déjà à un compte existant compte.";
                } else {
            
                    if(empty($configForm["errors"])){

                        //$session->set("error",$verification[0] );
                        $user->setFirstname($_POST["firstname"]);
					    $user->setLastname($_POST["lastname"]);
                        $user->setPassword((password_hash($_POST["password"], PASSWORD_DEFAULT)));
					    //$user->setPassword(($_POST["password"]));
					    $user->setEmail($_POST["email"]);
                        $user->setRegistered_at(date('Y-m-d H:i:s'));
					    $user->setUpdatedAt(date('Y-m-d H:i:s'));

                        $user->generateToken((Helper::createToken()));

					    $id = $user->save();
                        $session->addFlashMessage("success", "Your registration is OK!");

                        
                        Mailer::sendMail($data['email'],$verification_code );
                        header('Location: /login');
                        $_SESSION['alert']['success'][] = 'Votre compte à bien été créer.';
                      
                    

					    /*Mailer::sendMail(
						    $user->getEmail(),
						    $user->getFirstname(),
						    $user->getLastname(),
						    'Vous venez de creer un compte !' , 'Bienvenue !<br /> Vous venez de creer un compte.'
					    );
                        header('Location: /login');
					    exit;*/

                    }else {
                        $_POST["errors"] = $errors;
                    }
                }
            }
        }
        $v = new View("register", "front");
        $v->assign("configFormRegister", $configForm);
    }

    public function login()
    {
        $user = new UserModel();

        if (!empty($_POST)) {

            $user->setEmail(htmlspecialchars($_POST["email"]));
            $user->setPassword(htmlspecialchars($_POST["password"]));
            $user->login(["email" => $_POST['email']]);

        }

        $view = new View("login");
        $form = FormBuilder::render($user->getLoginForm());
        $view->assign("form", $form);
    }


    

    public function forgetPassword()
    {
        $user = new UserModel();
        $configForm = $user->getForgetPswdForm();
        $v = new View("forgetPassword", "front");
        $v->assign('forgetPassword', $configForm);

        if (!empty($_POST)) {
            $user = new UserModel(["email" => $_POST['email']]);
            
            if ($user->__get('id')==true) {
                $token = $this->generateToken();
                $user->__set('pwd_token',$token);
                $user->save();
                $name = $user->__get('last_name');
                $body="Bonjour $name !<br><br> Vous avez demandé à réinitialiser votre mot de passe. 
                 Changez votre mot de passe en cliquant sur le lien ci-dessous :. ". Helper::host() ."changer_mot_de_passe?t=$token\"<br><BT></BT>";
                Helper::sendMail($user->__get('email'),"Changement de mot de passe",$body);

            }else{
                 $_SESSION['alert']['danger'][] = "L'adresse mail n'a pas été trouvé";
            }
        }
    }

    

    public function update()
    {
        $user = new UserModel();
        $userById = $user->setId($_POST['id']);
        if(empty($userById)) {
            header("Location: /users");
        } else {
            $user = $user->setId($_POST['id']);
            $user->setUsername($_POST['username']);
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setRole($_POST['role']);
            $user->save();
            header("Location: /users/".$user->getId());
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