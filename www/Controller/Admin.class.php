<?php

namespace App\Controller;

session_start();

use App\Core\View;
use App\Model\Session as UserSession;
use App\Model\User as UserModel;
use App\Model\Post as PostModel;

class Admin
{

    public function dashboard()
    {

        $active = "dashboard";
        $session = new UserSession();
        if ($session->ensureUserConnected()) {
            $view = new View("dashboard", "back");
            $articles = new PostModel();
            $view->assign("user", $session->getUser());
            $view->assign("articles", $articles->getAllArticles());
            $view->assign("pages", $articles->getAllPages());
            $view->assign("tags", $articles->getAllTags());
            $view->assign("active", $active);
        
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