<h1>Pages</h1>

<?php

if ((isset($_POST['action']) && $_POST['action'] !== null)) :
    switch ($_POST['action']):
        case 'create':
            $view->create = 'create';
            $view->includePartial("form", $page->getFormPages());
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
            $view->includePartial("form", $page->getFormUpdatePages($postById));
    
            break;
        case 'delete':
            break;
    endswitch;
else :
    $view->includePartial("posts", $page_list);
endif;

?>