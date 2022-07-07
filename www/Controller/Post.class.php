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
        $final_url = $view->dynamicNav();   

        $view->assign("page", $page);
        $view->assign("view", $view);
        $view->assign("active", $active);
        $view->assign("final_url", $final_url);

        return $page;
    }

    public function showPage(array $params)
    {
        $post = new PostModel();
        $postById = $post->setId($params['id']);
        $active = "pages";
        $action = "update";

        if (!empty($postById)) {
            $view = new View("pages", "back");
            $view->assign("action", $action);
            $view->assign("postById", $postById);
            $view->assign("page", $post);
            $view->assign("view", $view);
            $view->assign("active", $active);
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

    public function showArticle(array $params)
    {
        $post = new PostModel();
        $postById = $post->setId($params['id']);
        $action = "update";
        $active = "articles";

        if (!empty($postById)) {
            $view = new View("articles", "back");
            $view->assign("action", $action);
            $view->assign("postById", $postById);
            $view->assign("article", $post);
            $view->assign("view", $view);
            $view->assign("active", $active);
        } else header("Location: /articles");
    }

    public function tags()
    {

        $tag = new PostModel();
        $active = "tags";
        $view = new View("tags", "back");

        $view->assign("tag", $tag);
        $view->assign("view", $view);
        $view->assign("active", $active);

        return $tag;
    }

    public function showTag(array $params)
    {
        $post = new PostModel();
        $postById = $post->setId($params['id']);
        $action = "update";
        $active = "tags";

        if (!empty($postById)) {
            $view = new View("tags", "back");
            $view->assign("action", $action);
            $view->assign("postById", $postById);
            $view->assign("article", $post);
            $view->assign("view", $view);
            $view->assign("active", $active);
        } else header("Location: /tags");
    }

    public function postCheck()
    {
        $page = new PostModel();
        $article = new PostModel();

        $validator = new Validator();

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
        } elseif (!empty($_POST) && $_POST['input'] == "article") {
            $result = $validator::checkPost($article->getFormArticles(), $_POST);
            if (empty($result)) {
                switch ($_POST["type"]):
                    case "add":
                        $article->createArticle($_POST);
                        unset($_POST);
                        header('location: /articles');
                        break;
                    case "update":
                        $article->updateArticle($_POST);
                        unset($_POST);
                        header('location: /articles');
                        break;
                    case "delete":
                        $article->deleteArticle($article);
                        unset($_POST);
                        header('location: /articles');
                        break;
                endswitch;
            } else {
                print_r($result);
            }
        }
    }
}
