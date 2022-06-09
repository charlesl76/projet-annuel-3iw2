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

    public function getUserList()
    {
        $users = new UserModel();

        $usersList = $users->findAll();

        $view = new View("users", "back");
        $view->assign("users", $usersList);

    }

}