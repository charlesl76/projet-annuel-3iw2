<h1>Pages</h1>

<?php

if (isset($_POST['action']) && $_POST['action'] !== null) :
    switch ($_POST['action']):
        case 0:
            $view->includePartial("posts", $page->getAllPages());
            break;
        case 1:
            $view->includePartial("form", $page->getFormPages());
            break;
    endswitch;
else :
    $view->includePartial("posts", $page->getAllPages());
endif;

?>