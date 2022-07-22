<?php

namespace App\Model;

use App\Core\BaseSQL;
use DateTime;

class Comment extends BaseSQL
{

    public function __construct()
    {
        parent::__construct();
        $this->setAuthor();
    }

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
     */
    public function setAuthor()
    {
        $session = new Session();
        $this->author = $session->getUserId();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    public function getFormatedDate()
    {
        $dt = new DateTime($this->getPublishedDate());
        return date_format($dt,"m/d/Y - H:i");
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

    public function getFormComment(Post $post)
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/post/".$post->getId()."/comment",
                "submit" => "Ajouter",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "input",
                    "class" => "form-control",
                    "name" => "input",
                    "placeholder" => "input",
                    "value" => "comment",
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
                "content" => [
                    "type" => "textarea",
                    "id" => "contentComment",
                    "class" => "contentComment",
                    "required" => true,
                    "error" => "Content is required",
                ],
            ]
        ];
    }

    public function createComment($data, $post = null)
    {
        $this->post = $post !== null ? $post->getId() : $data['post_parent'];
        $this->author = $this->getAuthor();
        $datetime = new \DateTime();
        $this->published_date = $datetime->format('Y-m-d H:i:s');
        $this->content = $data['content'];

        $this->save();
    }

    public function updateComment($data)
    {
        $this->post = $data['post_parent'];
        $this->author = $this->getAuthor();
        $datetime = new \DateTime();
        $this->published_date = $datetime->format('Y-m-d H:i:s');
        $this->content = $data['content'];

        $this->save();
    }

    public function deleteComment($params)
    {
        $this->deleteOne($params);
    }

    public function getAllComments()
    {
        return parent::findAll('Comment');
    }

    public function getFormComments(Comment $comment)
    {
        $post = new Post();
        $articles = $post->getAllArticles();
        $i = 1;

        $articleList[0] = [
            'id' => "0",
            'title' => "No post parent",
        ];

        foreach($articles as $article) {
            $articleList[$i]['id'] = $article->getId();
            $articleList[$i]['title'] = $article->getTitle();
            $i++;
        }

        return [
            "config" => [
                "method" => "POST",
                "action" => "comment-check",
                "submit" => "Create and publish",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "comment",
                    "class" => "form-control",
                    "name" => "comment",
                    "placeholder" => "comment",
                    "value" => "comment",
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
                    "id" => "author",
                    "class" => "inputAuthor",
                    "placeholder" => "Author",
                    "required" => true,
                    "disabled" => true,
                    "value" => $comment->showAuthor(),
                    "error" => "Author name is required",
                    "unicity" => false
                ],
                "status" => [
                    "type" => "select",
                    "placeholder" => "Status",
                    "id" => "status",
                    "class" => "status",
                    "status" => [
                        0 => [
                            "id" => "0",
                            "name" => "En attente de validation",
                        ],
                        1 => [
                            "id" => "1",
                            "name" => "Validé"
                        ],
                        2 => [
                            "id" => "2",
                            "name" => "Commentaire désaprouvé"
                        ]
                    ],
                ],
                "post_parent" => [
                    "type" => "select",
                    "placeholder" => "Post parent",
                    "id" => "post_parent",
                    "class" => "inputPost",
                    "post_parent" => $articleList,
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

    public function getFormUpdateComments(Comment $comment)
    {
        $post = new Post();
        $articles = $post->getAllArticles();
        $i = 1;

        $articleList[0] = [
            'id' => "0",
            'title' => "No post parent",
        ];

        foreach($articles as $article) {
            $articleList[$i]['id'] = $article->getId();
            $articleList[$i]['title'] = $article->getTitle();
            $i++;
        }

        return [
            "config" => [
                "method" => "POST",
                "action" => "/comments/" . $comment->getId() . "/update",
                "submit" => "Update",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "comment",
                    "class" => "form-control",
                    "name" => "comment",
                    "placeholder" => "comment",
                    "value" => "comment",
                    "hidden" => true,
                    "required" => true,
                ],
                "type" => [
                    "type" => "text",
                    "id" => "type",
                    "class" => "form-control",
                    "name" => "update",
                    "placeholder" => "update",
                    "value" => "update",
                    "hidden" => true,
                    "required" => true,
                ],
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "id",
                    "placeholder" => "id",
                    "value" => $comment->getId(),
                    "required" => true,
                ],
                "author" => [
                    "type" => "text",
                    "id" => "author",
                    "class" => "inputAuthor",
                    "placeholder" => "Author",
                    "required" => true,
                    "disabled" => true,
                    "value" => $comment->showAuthor(),
                    "error" => "Author name is required",
                    "unicity" => false
                ],
                "status" => [
                    "type" => "select",
                    "placeholder" => "Comment status",
                    "id" => "status",
                    "class" => "status",
                    "required" => true,
                    "status" => [
                        0 => [
                            "id" => "0",
                            "name" => "En attente de validation",
                        ],
                        1 => [
                            "id" => "1",
                            "name" => "Validé"
                        ],
                        2 => [
                            "id" => "2",
                            "name" => "Commentaire désaprouvé"
                        ]
                    ],
                ],
                "post_parent" => [
                    "type" => "select",
                    "placeholder" => "Post parent",
                    "id" => "post_parent",
                    "class" => "inputPost",
                    "post_parent" => $articleList,
                ],
                "content" => [
                    "type" => "textarea",
                    "id" => "textPage",
                    "class" => "inputText",
                    "required" => true,
                    "error" => "Content is required",
                    "value" => $comment->getContent(),
                ],
            ]

        ];
    }
}
