<h1>Liste des <?= $post_type ?>s</h1>

<div class="listPosts">

    <h1>Pages List</h1>

    <?php if ($post_type == "page") : ?>
        <?php foreach ($pages as $page) : ?>
            <tr>
                <td><a href="/post/<?= $page->getId() ?>"><?php echo $page->getTitle(); ?></a></td>
                <td><?php echo $page->getContent(); ?> </td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($pages as $page) : ?>
            <article class="listArticles">
                <a href="/post/<?= $page['id'] ?>"><?php echo $page['title']; ?></a>
                <?php echo $page['content']; ?>
            </article>
        <?php endforeach; ?>

    <?php elseif ($post_type == "article") : ?>
        <h1>Articles List</h1>

        <?php foreach ($articles as $article) : ?>
            <article class="listArticles">
                <h1><a href="/post/<?= $article->getId() ?>"><?= $article->getTitle() ?></a></h1>
                <p><?= $article->getContent() ?></p>
            </article>

        <?php endforeach; ?>

    <?php endif ?>

</div>