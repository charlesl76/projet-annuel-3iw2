<h1>Tags</h1>

<?php

if ((isset($_POST['action']) && $_POST['action'] !== null)) :
    switch ($_POST['action']):
        case 'create':
            $view->create = 'create';
            $view->includePartial("form", $tag->getFormTags());
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
            $view->assign("tagImages", $tag->tagImages);
            $view->includePartial("form", $tag->getFormUpdateTags($postById));
    
            break;
        case 'delete':
            break;
    endswitch;
else :
    $view->includePartial("posts", $tag->getAllTags());
endif;

?>