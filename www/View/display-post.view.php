<main>
    <h3><?= $post->getTitle() ?></h3>
    <h3><?= $post->getContent() ?></h3>
    <h3><?= $post->showAuthor() ?></h3>
    <h3><?= $post->getDate() ?></h3>
<!--    --><?php //$this->includePartial("comments", $post); ?>
    <?php $this->includePartial("display-comments", [$post, $isAuthor]); ?>
</main>