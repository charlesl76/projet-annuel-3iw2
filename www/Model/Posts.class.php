<?php
namespace App\Model;

use App\Core\BaseSQL;

class Posts extends BaseSQL
{

    protected $id;
    protected $author;
    protected $date;
    protected $date_gmt;
    protected $content;
    protected $title;
    protected $excerpt;
    protected $status;
    protected $comment_status;
    protected $post_modified;
    protected $post_modified_gmt;
    protected $post_parent;
    protected $post_type;
    protected $comment_count;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of date_gmt
     */ 
    public function getDate_gmt()
    {
        return $this->date_gmt;
    }

    /**
     * Set the value of date_gmt
     *
     * @return  self
     */ 
    public function setDate_gmt($date_gmt)
    {
        $this->date_gmt = $date_gmt;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of excerpt
     */ 
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set the value of excerpt
     *
     * @return  self
     */ 
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of comment_status
     */ 
    public function getComment_status()
    {
        return $this->comment_status;
    }

    /**
     * Set the value of comment_status
     *
     * @return  self
     */ 
    public function setComment_status($comment_status)
    {
        $this->comment_status = $comment_status;

        return $this;
    }

    /**
     * Get the value of post_modified
     */ 
    public function getPost_modified()
    {
        return $this->post_modified;
    }

    /**
     * Set the value of post_modified
     *
     * @return  self
     */ 
    public function setPost_modified($post_modified)
    {
        $this->post_modified = $post_modified;

        return $this;
    }

    /**
     * Get the value of post_modified_gmt
     */ 
    public function getPost_modified_gmt()
    {
        return $this->post_modified_gmt;
    }

    /**
     * Set the value of post_modified_gmt
     *
     * @return  self
     */ 
    public function setPost_modified_gmt($post_modified_gmt)
    {
        $this->post_modified_gmt = $post_modified_gmt;

        return $this;
    }

    /**
     * Get the value of post_parent
     */ 
    public function getPost_parent()
    {
        return $this->post_parent;
    }

    /**
     * Set the value of post_parent
     *
     * @return  self
     */ 
    public function setPost_parent($post_parent)
    {
        $this->post_parent = $post_parent;

        return $this;
    }

    /**
     * Get the value of post_type
     */ 
    public function getPost_type()
    {
        return $this->post_type;
    }

    /**
     * Set the value of post_type
     *
     * @return  self
     */ 
    public function setPost_type($post_type)
    {
        $this->post_type = $post_type;

        return $this;
    }

    /**
     * Get the value of comment_count
     */ 
    public function getComment_count()
    {
        return $this->comment_count;
    }

    /**
     * Set the value of comment_count
     *
     * @return  self
     */ 
    public function setComment_count($comment_count)
    {
        $this->comment_count = $comment_count;

        return $this;
    }
}