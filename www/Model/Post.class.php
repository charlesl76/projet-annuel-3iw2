<?php

namespace App\Model;

use App\Core\BaseSQL;
use DateTime;

class Post extends BaseSQL
{

    public $id;
    public $author;
    public $date;
    public $date_gmt;
    public $content;
    public $title;
    public $excerpt;
    public $status;
    public $comment_status;
    public $post_modified;
    public $post_modified_gmt;
    public $post_parent;
    public $post_type;
    public $comment_count;
    public $comments;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAllPagesExcerpt()
    {
        $columns[0] = "excerpt";
        $columns[1] = "date_gmt";
        $columns[2] = "post_modified_gmt";
        $params['post_type'] = "page";
        $this->excerpt = parent::findAllByColumn($columns, $params);

        json_encode($this->excerpt);

        return $this->excerpt;
    }

    public function getAllArticlesExcerpt()
    {
        $columns[0] = "excerpt";
        $columns[1] = "date_gmt";
        $columns[2] = "post_modified_gmt";
        $params['post_type'] = "article";
        $this->excerpt = parent::findAllByColumn($columns, $params);

        json_encode($this->excerpt);

        return $this->excerpt;
    }

    public function getAllPages()
    {
        $params["post_type"] = "page";
        return parent::findAllBy($params);
    }

    public function getAllArticles()
    {
        $params["post_type"] = "article";
        $articles = $this->findAllBy($params,null, 'Post');
        $comment = new Comment();
        foreach ($articles as $article) {
            $article->setComments($comment->findAllBy(["post" => $article->getId()], null, 'Comment'));
        }
//        foreach ($articles as $article) {
//            print_r($article->getTitle());
//            print_r($article->getAuthor());
//            print_r($article->getComments());
//        }
        return $articles;
    }

    public function getTagById($params)
    {
        $this->tag = parent::findByColumn(["title"], ["id" => $params]);
        return $this->tag;
    }

    public function getAllTags()
    {
        $params["post_type"] = "category";
        $this->tags = parent::findAllBy($params);
        json_encode($this->tags);

        return $this->tags;
    }

    public function getAllTagImages()
    {
        $params["collection"] = "olympic-sports";
        $tagImages = BaseSQL::findAllBy($params, "icon");
        json_encode($tagImages);

        return $tagImages;
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

    public function getFormArticles()
    {
        $tags = $this->getAllTags();
        $i = 1;

        $tagList[0] = [
            "id" => "0",
            "name" => "No tag",
        ];

        foreach($tags as $tag) {
            $tagList[$i]["id"] = $tag['id'];
            $tagList[$i]["name"] = $tag['title'];
            $i = $i + 1;
        }

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
                    "value" => "article",
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
                "post_parent" => [
                    "type" => "select",
                    "placeholder" => "Tag",
                    "id" => "post_parent",
                    "class" => "inputTag",
                    "parent" => $tagList,
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

    public function getFormTags()
    {
        $tagImages = $this->getAllTagImages();

        return [
            "config" => [
                "method" => "POST",
                "action" => "post-check",
                "submit" => "Create tag",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "input",
                    "class" => "form-control",
                    "name" => "input",
                    "placeholder" => "input",
                    "value" => "tag",
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
                "thumbnail" => [
                    "type" => "select",
                    "placeholder" => "Thumbnail",
                    "id" => "thumbnail",
                    "class" => "inputCommentStatus",
                    "images" => $tagImages,
                ],
            ]

        ];
    }

    public function getFormUpdateTags(Post $post)
    {
        $tagImages = $this->getAllTagImages();

        return [
            "config" => [
                "method" => "POST",
                "action" => "/tags/" . $post->getId() . "/update",
                "submit" => "Update",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "input",
                    "class" => "form-control",
                    "name" => "input",
                    "placeholder" => "input",
                    "value" => "tag",
                    "hidden" => true,
                ],
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "id",
                    "placeholder" => "id",
                    "value" => $post->getId(),
                ],
                "type" => [
                    "type" => "text",
                    "id" => "type",
                    "class" => "form-control",
                    "name" => "update",
                    "placeholder" => "update",
                    "value" => "update",
                    "hidden" => true,
                ],
                "author" => [
                    "type" => "text",
                    "placeholder" => "Author name",
                    "id" => "author",
                    "class" => "inputAuthor",
                    "required" => true,
                    "error" => "Author name is required",
                    "unicity" => false,
                    "value" => $post->getAuthor(),
                ],
                "title" => [
                    "type" => "text",
                    "placeholder" => "Title",
                    "id" => "title",
                    "class" => "inputTitle",
                    "required" => true,
                    "error" => "Title is required",
                    "value" => $post->getTitle(),
                ],
                "thumbnail" => [
                    "type" => "select",
                    "placeholder" => "Thumbnail",
                    "id" => "thumbnail",
                    "class" => "inputCommentStatus",
                    "images" => $tagImages,
                    "selected" => $post->getContent(),
                ],
            ]

        ];
    }

    public function getFormUpdatePages(Post $post)
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/pages/" . $post->getId() . "/update",
                "submit" => "Update",
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
                    "name" => "update",
                    "placeholder" => "update",
                    "value" => "update",
                    "hidden" => true,
                ],
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "id",
                    "placeholder" => "id",
                    "value" => $post->getId(),
                ],
                "author" => [
                    "type" => "text",
                    "placeholder" => "Author name",
                    "id" => "author",
                    "class" => "inputAuthor",
                    "required" => true,
                    "error" => "Author name is required",
                    "unicity" => false,
                    "required" => true,
                    "value" => $post->getAuthor(),
                ],
                "title" => [
                    "type" => "text",
                    "placeholder" => "Title",
                    "id" => "title",
                    "class" => "inputTitle",
                    "required" => true,
                    "error" => "Title is required",
                    "value" => $post->getTitle(),
                ],
                "comment_status" => [
                    "type" => "select",
                    "placeholder" => "Comment status",
                    "id" => "comment_status",
                    "class" => "inputCommentStatus",
                    // Voir comment faire un selected:selected pour le getStatus()
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
                    "value" => $post->getContent(),
                ],
            ]

        ];
    }

    public function getFormUpdateArticles(Post $post)
    {
        $tags = $this->getAllTags();
        $selected = $post->getPost_parent();
        $i = 1;

        $tagList[0] = [
            "id" => "0",
            "name" => "No tag",
        ];

        foreach($tags as $tag) {
            if($tag["id"] == $selected) {
                $tagList[$i]["selected"] = true;
            }
            $tagList[$i]["id"] = $tag['id'];
            $tagList[$i]["name"] = $tag['title'];
            $i = $i + 1;
        }

        return [
            "config" => [
                "method" => "POST",
                "action" => "/articles/" . $post->getId() . "/update",
                "submit" => "Update",
            ],
            "inputs" => [
                "input" => [
                    "type" => "text",
                    "id" => "input",
                    "class" => "form-control",
                    "name" => "input",
                    "placeholder" => "input",
                    "value" => "article",
                    "hidden" => true,
                ],
                "type" => [
                    "type" => "text",
                    "id" => "type",
                    "class" => "form-control",
                    "name" => "update",
                    "placeholder" => "update",
                    "value" => "update",
                    "hidden" => true,
                ],
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "id",
                    "placeholder" => "id",
                    "value" => $post->getId(),
                ],
                "author" => [
                    "type" => "text",
                    "placeholder" => "Author name",
                    "id" => "author",
                    "class" => "inputAuthor",
                    "required" => true,
                    "error" => "Author name is required",
                    "unicity" => false,
                    "required" => true,
                    "value" => $post->getAuthor(),
                ],
                "title" => [
                    "type" => "text",
                    "placeholder" => "Title",
                    "id" => "title",
                    "class" => "inputTitle",
                    "required" => true,
                    "error" => "Title is required",
                    "value" => $post->getTitle(),
                ],
                "comment_status" => [
                    "type" => "select",
                    "placeholder" => "Comment status",
                    "id" => "comment_status",
                    "class" => "inputCommentStatus",
                    // Voir comment faire un selected:selected pour le getStatus()
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
                "post_parent" => [
                    "type" => "select",
                    "placeholder" => "Tag",
                    "id" => "post_parent",
                    "class" => "inputTag",
                    "parent" => $tagList,
                ],
                "content" => [
                    "type" => "textarea",
                    "id" => "textPage",
                    "class" => "inputText",
                    "required" => true,
                    "error" => "Content is required",
                    "value" => $post->getContent(),
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

    public function updatePage($data)
    {
        $this->id = $data["id"];
        $this->author = 1;
        $this->title = $data["title"];
        $this->excerpt = $this->setExcerpt($data["title"]);
        $this->content = $data["content"];
        $this->comment_status = $data["comment_status"];
        $this->status = 1;
        $this->post_parent = 0;
        $this->post_type = "page";
        $this->comment_count = 0;

        $this->save();
    }

    public function deletePage($params)
    {
        $this->deleteOne($params);
    }

    public function createArticle($data)
    {

        $this->author = 1;
        $this->title = $data["title"];
        $this->excerpt = $this->setExcerpt($data["title"]);
        $this->content = $data["content"];
        $this->comment_status = $data["comment_status"];
        $this->date = $this->setDate();
        $this->date_gmt = $this->setDate_gmt();
        $this->status = 1;
        $this->post_type = "article";
        $this->post_parent = $data["post_parent"];
        $this->comment_count = 0;
        unset($this->tags);

        $this->save();
    }

    public function updateArticle($data)
    {
        $this->id = $data["id"];
        $this->author = 1;
        $this->title = $data["title"];
        $this->excerpt = $this->setExcerpt($data["title"]);
        $this->content = $data["content"];
        $this->comment_status = $data["comment_status"];
        $this->status = 1;
        $this->post_parent = 0;
        $this->post_type = "article";
        $this->post_parent = $data["post_parent"];
        $this->comment_count = 0;
        unset($this->tags);

        $this->save();
    }

    public function deleteArticle($params)
    {
        $this->deleteOne($params);
    }

    public function createTag($data)
    {

        $this->author = 1;
        $this->title = $data["title"];
        $this->excerpt = $this->setExcerpt($data["title"]);
        $this->content = $data["content"];
        $this->comment_status = 0;
        $this->date = $this->setDate();
        $this->date_gmt = $this->setDate_gmt();
        $this->status = 1;
        $this->post_parent = 0;
        $this->post_type = "category";
        $this->comment_count = 0;

        $this->save();
    }

    public function updateTag($data)
    {
        $this->id = $data["id"];
        $this->author = 1;
        $this->title = $data["title"];
        $this->excerpt = $this->setExcerpt($data["title"]);
        $this->content = $data["content"];
        $this->comment_status = $data["comment_status"];
        $this->status = 1;
        $this->post_parent = 0;
        $this->post_type = "category";
        $this->post_parent = $data["post_parent"];
        $this->comment_count = 0;

        $this->save();
    }

    public function deleteTag($params)
    {
        $this->deleteOne($params);
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

        if ($comment_status == 0) {
            $this->comment_status = (int) 0;
        } else {
            $this->comment_status = $comment_status;
        }

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

        return $this->post_type;
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

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }
}
