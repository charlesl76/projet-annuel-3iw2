<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Session as UserSession;
use App\Model\User as UserModel;

class Admin
{

    public function dashboard()
    {
        $session = new UserSession();
        if ($session->ensureUserConnected()) {
            $view = new View("dashboard", "back");
            $view->assign("user", $session->getUser());
        } else header("Location: /login");
    }

    public function getUserList()
    {
        $session = new UserSession();
        if ($session->ensureUserConnected()) {
            $users = new UserModel();
            $usersList = $users->findAll();
            $view = new View("users", "back");
            $active = "users";
            $view->assign("users", $usersList);
            $view->assign("active", $active);
        } else header("Location: /login");
    }
}