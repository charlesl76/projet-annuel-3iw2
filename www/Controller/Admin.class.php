<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Core\BaseSQL;
use App\Model\User as UserModel;

class Admin extends BaseSQL
{
    public function dashboard()
    {
        $firstname = "Yves";
        $lastname = "SKRZYPCZYK";

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", $lastname);

    }

    public function getUsersList()
    {
        $users = parent::findAllUsers();

        $view = new View("users", "back");
        $view->assign("users", $users);

    }


    public function deleteUserById()
    {
        parent::deleteUser();

    }


    public function updateUserById()
    {
        $user = new UserModel();
        print_r($user);

        if( !empty($_POST)){
            $result = Validator::run($user->getFormUpdate(), $_POST);
//            print_r($result);
        }
        $view = new View("update", "back");
        $view->assign("user",$user);
    }


    public function updateUser()
    {
        $user = parent::findUser();
//        $updateUser = parent::updateUser();

        var_dump($user);
        $view = new View("update", "back");
        $view->assign("user", $user);
//        $view->assign("update", $updateUser);

    }

}