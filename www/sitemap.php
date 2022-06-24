<?php

namespace App;

require_once "conf.inc.php";
require_once "Core/BaseSQL.class.php";
require_once "Model/Post.class.php";

use App\Core\BaseSQL;
use App\Model\Post;
use App\PDO;
use DateTime;

Header('Content-type: text/xml');

$base = 'http://' . $_SERVER['HTTP_HOST'];
$xml = new \SimpleXMLElement("<?xml version='1.0' encoding='UTF-8' ?>\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

//main page 
$url = $xml->addChild('url');
$url->addChild('loc', $base . '/');
$url->addChild('lastmod', gmdate('c', filemtime('index.html')));
$url->addChild('priority', '1.0');

// pages
$params['post_type'] = "page";
$pages = new Post;
$pages->getAllPagesExcerpt();
$excerpts = $pages->excerpt;

foreach ($excerpts as $excerpt) {
    $url = $xml->addChild('url');
    $url->addChild('loc', $base . '/pages/' . $excerpt['excerpt']);
    // date to timestamp
    $date = new DateTime($excerpt['date_gmt']);
    $url->addChild('lastmod', $date->format('c'));
    $url->addChild('priority', '0.6');
}

// articles
$params['post_type'] = "article";
$articles = new Post;
$articles->getAllArticlesExcerpt();
$excerpts = $articles->excerpt;

foreach ($excerpts as $excerpt) {
    $url = $xml->addChild('url');
    $url->addChild('loc', $base . '/articles/' . $excerpt['excerpt']);
    // set modification date if set
    if (isset($excerpt["post_modified_gmt"])) {
        $excerpt["date_gmt"] = $excerpt["post_modified_gmt"];
    }
    // date to timestamp
    $date = new DateTime($excerpt['date_gmt']);
    $url->addChild('lastmod', $date->format('c'));
    $url->addChild('priority', '0.4');
}

$output = $xml->asXML();
echo $output;
