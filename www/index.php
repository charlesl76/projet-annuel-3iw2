<?php
namespace App;

use MongoDB\BSON\Regex;

require "conf.inc.php";

function myAutoloader($class){
    //$class = App\Core\CleanWords
    $class = str_ireplace("App\\", "", $class);
    //$class = Core\CleanWords
    $class = str_ireplace("\\", "/", $class);
    //$class = Core/CleanWords
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }
}

spl_autoload_register("App\myAutoloader");


$uri = $_SERVER["REQUEST_URI"];

$routeFile = "routes.yml";
if(!file_exists($routeFile)){
    die("Le fichier ".$routeFile." n'existe pas");
}

$routes = yaml_parse_file($routeFile);

// Permet de récupérer les paramètres d'une requête
// todo: rendre ça plus générique
$uri_explode = explode("/", $uri);
if (count($uri_explode) > 2) {
    if (preg_match("/\d/i", $uri_explode[2])) {
        $param = "id";
        // uri plus longue
        if (isset($uri_explode[3])) $uri = "/".$uri_explode[1]."/{{$param}}/".$uri_explode[3];
        else $uri = "/".$uri_explode[1]."/{{$param}}";
        // paramètres de l'uri
        $params = [$param => $uri_explode[2]];
    }
}

if( empty($routes[$uri]) || empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"]) ){
    die("Page 404");
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);

// $controller = User ou $controller = Global
// $action = login ou $action = logout ou $action = home

$controllerFile = "Controller/".$controller.".class.php";
if(!file_exists($controllerFile)){
    die("Le controller ".$controllerFile." n'existe pas");
}
include $controllerFile;

$controller = "App\\Controller\\".$controller;
if( !class_exists($controller) ){
    die("La classe ".$controller." n'existe pas");
}

$objectController = new $controller();

if( !method_exists($objectController, $action) ){
    die("La methode ".$action." n'existe pas");
}

// on passe les paramètres de l'url
if (!empty($params))
    $objectController->$action($params);
else $objectController->$action();
