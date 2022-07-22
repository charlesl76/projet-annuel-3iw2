<h1>Commentaires</h1>

<?php

if ((isset($_POST['action']))) :
    switch ($_POST['action']):
        case 'create':
            $this->create = 'create';
            $this->includePartial("form", $comment->getFormComments($comment));
            break;
        case 'delete':
        case 'update':
            break;
    endswitch;
elseif (isset($action)) :
    switch ($action):
        case 'update':
            $this->update = 'update';
            $this->includePartial("form", $comment->getFormUpdateComments($commentById));
            break;
        case 'delete':
            break;
    endswitch;
else :
    $this->includePartial("comments", $comments);
endif;

?>