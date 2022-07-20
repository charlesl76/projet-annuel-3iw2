<h1>Articles</h1>

<?php

if ((isset($_POST['action']) && $_POST['action'] !== null)) :
    switch ($_POST['action']):
        case 'create':
            $view->create = 'create';
            $view->includePartial("form", $article->getFormArticles());
            break;
        case 'update':
            break;
        case 'delete':
            break;
    endswitch;
elseif (isset($action) && $action !== null) :
    switch ($action):
        case 'update':
            $view->update = 'update';
            $view->includePartial("form", $article->getFormUpdateArticles($postById));
    
            break;
        case 'delete':
            break;
    endswitch;
else :
    $view->includePartial("posts", $article_list);
endif;

?>