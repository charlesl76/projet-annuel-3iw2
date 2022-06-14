<?php

namespace App\Controller;

use App\Core\BaseSQL;
use App\Core\Validator;
use App\Core\View;
use App\Model\User as UserModel;

class User{

    public function login()
    {
        $view = new View("Login");
        $view->assign("titleSeo","Se connecter au site");
    }

    public function logout()
    {
        echo "Se deco";
    }

    public function register()
    {

        $user = new UserModel();

        print_r($_POST);
        if( !empty($_POST)){
            $result = Validator::run($user->getFormRegister(), $_POST);
            print_r($result);
        }

        //$user= $user->setId(3);
        //$user->setEmail("toto@gmail.com");
        //$user->save();

        $view = new View("register");
        $view->assign("user",$user);
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

    public function delete()
    {
        $user = new UserModel();
        $user->deleteOne();

        header("Location: /users");
    }

}