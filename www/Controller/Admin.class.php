<?php

namespace App\Controller;

use App\Core\View;
use App\Core\BaseSQL;

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
        $user = parent::findUser();
//        $updateUser = parent::updateUser();

        var_dump($user);
        $view = new View("update", "back");
        $view->assign("user", $user);
//        $view->assign("update", $updateUser);

    }

}