<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Session as UserSession;
use App\Model\User as UserModel;
use App\Model\Post as PostModel;
use App\Model\Comment as CommentModel;

class Admin
{

    public function dashboard()
    {

        $active = "dashboard";
        $session = new UserSession();
        if ($session->ensureUserConnected()) {
            $view = new View("dashboard", "back");
            $article = new PostModel();
            $comment = new CommentModel();
            $view->assign("user", $session->getUser());
            $view->assign("articles", $article->getAllArticles());
            $view->assign("pages", $article->getAllPages());
            $view->assign("comments", $comment->getAllComments());
            $view->assign("tags", $article->getAllTags());
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