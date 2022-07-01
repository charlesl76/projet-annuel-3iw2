<?php

namespace App;


require_once "conf.inc.php";
require_once "Core/BaseSQL.class.php";
require_once "Model/Post.class.php";

use App\Model\Post;
use App\PDO;

Header('Content-type: text/xml');

$base = 'http://' . $_SERVER['HTTP_HOST'];
$xml = new \SimpleXMLElement("<?xml version='1.0' encoding='UTF-8' ?>\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

//main page 
$url = $xml->addChild('url');
$url->addChild('loc', $base . '/');
$url->addChild('lastmod',gmdate('c',filemtime('index.html'))); 
$url->addChild('priority', '1.0');

// TODO :
// - récupérer les posts (excerpts, date, etc.) en utilisant PDO
// - séparer les posts par catégories
// - créer une url pour chaque post
// - ajouter les urls dans le xml
// AIDE :
// https://gist.github.com/Darkflib/1884948

$output = $xml->asXML();
echo $output;



