<h1>Pages</h1>

<?php

if ((isset($_POST['action']) && $_POST['action'] !== null)) :
    switch ($_POST['action']):
        case 'create':
            $this->create = 'create';
            $this->includePartial("form", $page->getFormPages($page));
            break;
        case 'delete':
        case 'update':
            break;
    endswitch;
elseif (isset($action) && $action !== null) :
    switch ($action):
        case 'update':
            $this->update = 'update';
            $this->includePartial("form", $page->getFormUpdatePages($postById));
    
            break;
        case 'delete':
            break;
    endswitch;
else :
    $this->includePartial("posts", $pages);
endif;

?>