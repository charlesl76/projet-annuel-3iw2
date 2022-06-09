<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User as UserModel;

class Admin
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
        $users = new UserModel();

        $usersList = $users->findAll();

        $view = new View("users", "back");
        $view->assign("users", $usersList);

    }


    public function deleteUserById()
    {
        $user =new UserModel();

        $user->deleteOne();

        header("Location: /users");
    }


    public function updateUserForm()
    {
        $user = new UserModel();
        $userById = $user->setId($_POST['id']);

        if(!empty($userById)){
           $form = $user->getFormUpdate($userById);
        }else {
            //redirect
            header("Location: /users");
        }
        $view = new View("update", "back");
        $view->assign("form",$form);
    }


}