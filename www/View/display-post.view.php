<div id="article-details">
    <div class="article-card">
        <article class="article-details">
            <h1><?= $post->getTitle() ?></h1>
            <div id="article-content">
                <p><?= $post->getContent() ?></p>

                <div id="meta-data">
                    <h3><?= $post->showAuthor() ?></h3> 
                    <h3><?= $post->getDate() ?></h3>
                </div>
              
            </div>
            <?php $this->includePartial("display-comments", [$post, $isAuthor]); ?>
        </article>
    <div>
</div>