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

    public function showPage(array $params)
    {
        $post = new PostModel();
        $postById = $post->setId($params['id']);
        $action = "update";

        if (!empty($postById)) {
                $view = new View("pages", "back");
                $view->assign("action", $action);
                $view->assign("postById", $postById);
                $view->assign("page", $post);
                $view->assign("view", $view);
        } else header("Location: /pages");
    }

    public function postCheck()
    {
        $page = new PostModel();

        $validator = new Validator();

        if (!empty($_POST) && $_POST['input'] == "page") {
            $result = $validator::checkPost($page->getFormPages(), $_POST);

            if (empty($result)) {
                if ($_POST["type"] == "add") {
                    $page->createPage($_POST);

                    unset($_POST);
                    header('location: pages');
                }
            } else {
                print_r($result);
            }
        }
    }
}
