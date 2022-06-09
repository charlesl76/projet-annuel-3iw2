<h1>Pages</h1>

<?php

if (isset($_POST['action']) && $_POST['action'] !== null) :
    switch ($_POST['action']):
        case 'create':
            $view->includePartial("form", $page->getFormPages());
            break;
        case 'update':
            break;
        case 'delete':
            break;
    endswitch;
else :
    $view->includePartial("posts", $page->getAllPages());
endif;

?>