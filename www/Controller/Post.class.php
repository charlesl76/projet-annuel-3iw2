<?php

namespace App\Controller;

use App\Core\Validator;
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

    public function postCheck()
    {
        $page = new PostModel();

        $validator = new Validator();

        if( !empty($_POST) && $_POST['input'] == "page"){
            $result = $validator::checkPost($page->getFormPages(), $_POST);
            
            if(empty($result)){
                if($_POST["type"] == "add"){
                    $page->createPage($_POST);
                }
            } else {
                print_r($result);
            }
        }
    }
}
