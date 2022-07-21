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
            <?php foreach ($articles as $post) : ?>
                <li>
                    <h3><a href="/post/<?= $post->getId() ?>"><?= $post->getTitle() ?></a></h3>
                    <p><?= $post->getContent() ?></p>
                    <?php $this->includePartial("display-comments", [$post]); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</table>
                