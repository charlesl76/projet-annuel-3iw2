<ul><?php
    $post = $config[0];
    foreach ($post->getComments() as $comment): ?>
        <li>
            <p><?= $comment->getContent() ?></p>
            <p>Posté par <?= $comment->showAuthor() ?></p>
            <p>Publié le <?= $comment->getPublishedDate() ?></p>
            <p><i><?= $comment->showStatus() ?></i></p>
            <?php
            // if isAuthor
            if (isset($config[1]) && $config[1]) : ?>
                <form action="/post/<?= $post->getId() ?>/comment/delete" method="post"
                      onsubmit="return confirm('Are you sure you want to delete this comment, this action is unreversible?');">
                    <input type="hidden" name="id" value="<?= $comment->getId() ?>">
                    <input type="hidden" name="type" value="delete">
                    <input type="submit" value="Delete">
                </form>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    <li>
        <p><a href="/post/<?= $post->getId() ?>/comment">Ajouter un commentaire</a></p>
    </li>
</ul>
