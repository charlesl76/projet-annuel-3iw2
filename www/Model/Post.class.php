<?php

namespace App\Model;

use FFI\Exception;
use App\Core\BaseSQL;
use DateTime;

class Post extends BaseSQL
{

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

    public function getAllPages()
    {
        $this->pages = parent::findAll();
        json_encode($this->pages);

        return $this->pages;
    }

    public function getFormPages()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "post-check",
                "submit" => "Create and publish",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "input",
                    "class" => "form-control",
                    "name" => "input",
                    "placeholder" => "input",
                    "value" => "page",
                    "hidden" => true,
                ],
                "type" => [
                    "type" => "text",
                    "id" => "type",
                    "class" => "form-control",
                    "name" => "add",
                    "placeholder" => "add",
                    "value" => "add",
                    "hidden" => true,
                ],
                "author" => [
                    "type" => "text",
                    "placeholder" => "Author name",
                    "id" => "author",
                    "class" => "inputAuthor",
                    "required" => true,
                    "error" => "Author name is required",
                    "unicity" => false
                ],
                "title" => [
                    "type" => "text",
                    "placeholder" => "Title",
                    "id" => "title",
                    "class" => "inputTitle",
                    "required" => true,
                    "error" => "Title is required",
                ],
                "comment_status" => [
                    "type" => "select",
                    "placeholder" => "Comment status",
                    "id" => "comment_status",
                    "class" => "inputCommentStatus",
                    "status" => [
                        -1 => [
                            "id" => "-1",
                            "name" => "Blocked",
                        ],
                        0 => [
                            "id" => "0",
                            "name" => "On approbation"
                        ],
                        1 => [
                            "id" => "1",
                            "name" => "Open"
                        ]
                    ],
                ],
                "content" => [
                    "type" => "textarea",
                    "id" => "textPage",
                    "class" => "inputText",
                    "required" => true,
                    "error" => "Content is required",
                ],
            ]

        ];
    }

    public function createPage($data)
    {

        $this->author = 1;
        $this->title = $data["title"];
        $this->excerpt = $this->setExcerpt($data["title"]);
        $this->content = $data["content"];
        $this->comment_status = $data["comment_status"];
        $this->date = $this->setDate();
        $this->date_gmt = $this->setDate_gmt();
        $this->status = 1;
        $this->post_parent = 0;
        $this->post_type = "page";
        $this->comment_count = 0;

        $this->save();
        
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

        if ($author === null) :
            return null;
        else :
            return $author->author;
        endif;

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
    public function setDate()
    {
        $this->date = date("Y-m-d H:i:s");

        return $this->date;
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
    public function setDate_gmt()
    {
        $this->date_gmt = date("Y-m-d H:i:s");

        return $this->date_gmt;
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
    public function setExcerpt()
    {

        $excerpt = $this->title;

        $excerpt = explode(" ", $excerpt);
        // lowercase and add union between words
        $excerpt = strtolower(implode("-", $excerpt));

        return $excerpt;
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
