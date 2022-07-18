<!-- <pre><?php var_dump($pages) ?></pre> -->

<h1>Liste des pages</h1>

<table>

    <td>Title</td>
    <td>Content</td>

    <?php if($post_type == "page") : ?>
        <?php foreach($pages as $page) : ?> 
            <tr>
                <td><a href="/post/<?=$page['id']?>"><?php echo $page['title']; ?></a></td>
                <td><?php echo $page['content']; ?> </td>
            </tr>

        <?php endforeach; ?>

        <?php elseif($post_type == "article") : ?>
            <?php foreach($articles as $article) : ?> 
            <tr>
                <td><a href="/post/<?=$article['id']?>"><?php echo $article['title']; ?> </a></td>
                <td><?php echo $article['content']; ?> </td>
            </tr>

        <?php endforeach; ?>

    <?php endif ?>
</table>
                