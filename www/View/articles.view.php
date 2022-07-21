<h1>Articles</h1>

<?php

if ((isset($_POST['action']) && $_POST['action'] !== null)) :
    switch ($_POST['action']):
        case 'create':
            $this->create = 'create';
            $this->includePartial("form", $article->getFormArticles());
            break;
        case 'update':
            break;
        case 'delete':
            break;
    endswitch;
elseif (isset($action) && $action !== null) :
    switch ($action):
        case 'update':
            $this->update = 'update';
            $this->includePartial("form", $article->getFormUpdateArticles($postById));
    
            break;
        case 'delete':
            break;
    endswitch;
else :
    $this->includePartial("posts", $articles);
endif;

?>