<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Post as PostModel;
use App\Model\Session;
use App\Model\User as UserModel;

class Post
{

    public function pages()
    {

        $page = new PostModel();
        $active = "pages";
        $user = new UserModel();
        $view = new View("pages", "back");
        $final_url = $view->dynamicNav();

        $pages = $page->getAllPages();

        $view->assign("pages", $pages);
        $view->assign("page", $page);
        $view->assign("view", $view);
        $view->assign("active", $active);
        $view->assign("final_url", $final_url);

        return $page;
    }

    public function getPagesListFront()
    {
        $page = new PostModel();
        $pagesList = $page->getAllPages();
        $active = "page";
        $view = new View("display-posts", "front");
        $final_url = $view->dynamicNav();

        $view->assign("pages", $pagesList);
        $view->assign("post_type", $active);
        $view->assign("view", $view);
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
        $user = new UserModel();
        $active = "articles";
        $view = new View("articles", "back");

        $articles = $article->getAllArticles();

        $view->assign("articles", $articles);
        $view->assign("article", $article);
        $view->assign("user", $user);
        $view->assign("view", $view);
        $view->assign("active", $active);
    }

    public function getArticlesListFront()
    {
        $article = new PostModel();
        $articles = $article->getAllArticles();
        $active = "article";
        $view = new View("display-posts", "front");
        $final_url = $view->dynamicNav();
        $view->assign("articles", $articles);
        $view->assign("post_type", $active);
        $view->assign("view", $view);
        $view->assign("final_url", $final_url);
    }

    public function getOnePostFront(array $params)
    {
        $post = new PostModel();
        $post = $post->setId($params['id']);
        $session = new Session();
        $post->setComments();
        $view = new View("display-post", "front");
        $view->assign("post", $post);
        $view->assign("isAuthor", $session->getUserId() === $post->getAuthor());
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
        $user = new UserModel();
        $active = "tags";
        $view = new View("tags", "back");

        $tags = $tag->getAllTags();

        for($i = 0; $i < count($tags); $i++) {
            $user_cred = $tags[$i]['author'];
            $tags[$i]['author'] = $user->getUserByCredentials($user_cred);
        }

        $view->assign("tag_list", $tags);
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
            $view->assign("category", $post);
            $view->assign("view", $view);
            $view->assign("active", $active);
            $view->assign("dynamicNav", $view->dynamicNav());
        } else header("Location: /tags");
    }

    public function postCheck()
    {
        $page = new PostModel();
        $article = new PostModel();
        $tag = new PostModel();

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
                        var_dump($article);
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
            }
        } elseif (!empty($_POST) && $_POST['input'] == "tag") {
            $result = $validator::checkPost($tag->getFormTags(), $_POST);
            if (empty($result)) {
                switch ($_POST["type"]):
                    case "add":
                        $tag->createTag($_POST);
                        unset($_POST);
                        header('location: /tags');
                        break;
                    case "update":
                        $tag->updateTag($_POST);
                        unset($_POST);
                        header('location: /tags');
                        break;
                    case "delete":
                        $tag->deleteTag($tag);
                        unset($_POST);
                        header('location: /tags');
                        break;
                endswitch;
            }
        }
    }


}
