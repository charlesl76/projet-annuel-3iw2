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
        $active = "pages";
        $view = new View("pages", "back");

        $view->assign("page", $page);
        $view->assign("view", $view);
        $view->assign("active", $active);

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

    public function articles()
    {

        $article = new PostModel();
        $active = "articles";
        $view = new View("articles", "back");

        $view->assign("article", $article);
        $view->assign("view", $view);
        $view->assign("active", $active);

        return $article;
    }

    public function showArticles(array $params)
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

        var_dump($_POST);

        if (!empty($_POST) && $_POST['input'] == "page") {
            $result = $validator::checkPost($page->getFormPages(), $_POST);

            if (empty($result)) {
                switch ($_POST["type"]):
                    case "add":
                        $page->createPage($_POST);
                        unset($_POST);
                        header('location: /pages');
                        break;
                    case "update":
                        $page->updatePage($_POST);
                        unset($_POST);
                        header('location: /pages');
                        break;
                    case "delete":
                        $page->deletePage($page);
                        unset($_POST);
                        header('location: /pages');
                        break;
                endswitch;
            } else {
                print_r($result);
            }
        }
    }
}
