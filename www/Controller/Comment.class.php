<?php

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Model\Comment as CommentModel;
use App\Model\Post as PostModel;
use App\Model\Session;
use App\Model\User as UserModel;

class Comment
{
    public function commentPost($params)
    {
        $post = new PostModel();
        $post = $post->setId($params['id']);
        $comment = new CommentModel();
        $form = $comment->getFormComment($post);
        $session = new Session();

        if (!empty($_POST)) {
            if ($_POST['type'] == "delete") {
                $comment = $comment->setId($_POST['id']);
                if ($session->getUserId() === $comment->getAuthor()) {
                    $comment->deleteComment($_POST['id']);
                    echo "Votre commentaire a bien été supprimé.";
                    header("refresh: 1; url=/post/" . $post->getId());
                } else echo "Vous n'êtes pas l'auteur du commentaire";
            } else {
                $validator = new Validator();
                $result = $validator::checkForm($form, $_POST);
                if (empty($result)) {
                    $comment->createComment($_POST, $post);
                    echo "Votre commentaire a bien été publié. Il va maintenant être vérifié par un modérateur.";
                    header("refresh: 1; url=/front-articles");
                }
            }
        } else {
            $view = new View("comment", "front");
            $view->assign("post", $post);
            $view->assign("getFormComment", $form);
        }
    }

    public function comments()
    {

        $comment = new CommentModel();
        $view = new View("comments", "back");
        $final_url = $view->dynamicNav();

        $comments = $comment->getAllComments();

        $view->assign("comments", $comments);
        $view->assign("comment", $comment);
        $view->assign("view", $view);
        $view->assign("active", "comments");
        $view->assign("final_url", $final_url);

    }

    public function showComment(array $params)
    {
        $comment = new CommentModel();
        $commentByid = $comment->setId($params['id']);
        $action = "update";

        if (!empty($commentByid)) {
            $view = new View("comments", "back");
            $view->assign("action", $action);
            $view->assign("commentById", $commentByid);
            $view->assign("comment", $comment);
            $view->assign("view", $view);
            $view->assign("active", "comments");
        } else header("Location: /comments");
    }

    public function commentCheck()
    {
        $comment = new CommentModel();
        $validator = new Validator();

        if (!empty($_POST)) {
            $result = $validator::checkPost($comment->getFormComments($comment), $_POST);
            if (empty($result)) {
                switch ($_POST["type"]):
                    case "add":
                        $comment->createComment($_POST);
                        echo "Your comment has been added.";
                        header("refresh: 1; url=/comments");
                        unset($_POST);
                        break;
                    case "update":
                        $comment->updateComment($_POST);
                        echo "The comment has been updated.";
                        header("refresh: 1; url=/comments");
                        unset($_POST);
                        break;
                    case "delete":
                        $comment->deleteComment($comment->getId());
                        echo "The comment has been deleted.";
                        header("refresh: 1; url=/comments");
                        unset($_POST);
                        break;
                endswitch;
            } else {
                print_r($result);
            }
        }
    }
}