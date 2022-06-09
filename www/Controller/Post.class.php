<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Post as PostModel;

class Post
{

    public function pages()
    {

        $page = new PostModel();

        $view = new View("pages", "back");

        $view->assign("page", $page);
        $view->assign("view", $view);

        return $page;
    }
}
