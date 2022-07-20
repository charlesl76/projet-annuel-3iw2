<h1>Listes des posts</h1>

<table>

    <?php if ($post_type == "page") : ?>
        <?php foreach ($pages as $page) : ?>
            <tr>
                <td><a href="/post/<?= $page['id'] ?>"><?php echo $page['title']; ?></a></td>
                <td><?php echo $page['content']; ?> </td>
            </tr>

        <?php endforeach; ?>

    <?php elseif ($post_type == "article") : ?>
        <ul>
            <?php foreach ($articles as $article) : ?>
                <li>
                    <h3><a href="/post/<?= $article->getId() ?>"><?= $article->getTitle() ?></a></h3>
                    <p><?= $article->getContent() ?></p>
                    Liste des commentaires:<ul>
                        <?php foreach ($article->getComments() as $comment): ?>
                            <li>
                                <p><?= $comment->getContent() ?></p>
                                <p>Posté par <?= $comment->showAuthor() ?></p>
                                <p>Publié le <?= $comment->getPublishedDate() ?></p>
                                <p><i><?= $comment->showStatus() ?></i></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</table>
                