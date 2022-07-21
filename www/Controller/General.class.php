<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Post;

class General{

    public function home()
    {
        $pages = new Post();
        $pages = $pages->getAllPages();

        $view = new View("index", "front");
        $view->assign('pages', $pages);
    }

    public function contact()
    {
        $view = new View("contact");
    }

    public function error404()
    {
        $view = new View("404");
    }
}