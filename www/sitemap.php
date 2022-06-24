<?php

namespace App;

require_once "conf.inc.php";
require_once "Core/BaseSQL.class.php";
require_once "Model/Post.class.php";

use App\Model\Post;

header('Content-type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';

$base_url = "http://localhost/";

$post = new Post();

//$post->getAllPagesExcerpt();
$pages = $post->getAllPages();
?>

<urlset xmins="http://sitemaps.org/schemas/sitemap/0.9">
    <?php
        foreach($pages as $page){
    ?>
    <url>
        <loc><?= $base_url.htmlspecialchars($page['excerpt'] )?></loc>
        <changefreq>daily</changefreq>
    </url>
    <?php
        }
    ?>
</urlset>