<?php

namespace App\Model;

use App\Core\BaseSQL;
use DateTime;

class Comment extends BaseSQL
{

    public $id;
    public $post;
    public $author;
    public $published_date;
    public $content;
    public $status;
    public $approved_by;
    public $comment_parent;

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function showAuthor()
    {
        $user = $this->findUserById($this->getAuthor());
        return $user->getUsername();
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author): ?Comment
    {
        $this->author = $author;

        if ($author === null) :
            return null;
        else :
            return $author->author;
        endif;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post): void
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getPublishedDate()
    {
        return $this->published_date;
    }

    /**
     * @param mixed $published_date
     */
    public function setPublishedDate($published_date): void
    {
        $this->published_date = $published_date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function showStatus(): string
    {
        switch ($this->getStatus()) {
            case 0:
                $text = "En attente de validation";
                break;
            case 1:
                $text = "Validé par ".$this->showReviewer();
                break;
            case 2:
                $text = "Commentaire désaprouvé";
                break;
        }
        return $text;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    public function showReviewer()
    {
        $admin = $this->findUserById($this->getApprovedBy());
        return $admin->getUsername();
    }

    /**
     * @param mixed $approved_by
     */
    public function setApprovedBy($approved_by): void
    {
        $this->approved_by = $approved_by;
    }

    /**
     * @return mixed
     */
    public function getCommentParent()
    {
        return $this->comment_parent;
    }

    /**
     * @param mixed $comment_parent
     */
    public function setCommentParent($comment_parent): void
    {
        $this->comment_parent = $comment_parent;
    }

}
