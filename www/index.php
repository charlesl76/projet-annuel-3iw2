<?php

namespace App;

session_start();

require "conf.inc.php";

$install_complete = defined("INSTALL");

if ($install_complete == false) {
    include_once "activate.php";
    die;
}

use App\Model\Session as UserSession;
use MongoDB\BSON\Regex;



function myAutoloader($class)
{
    //$class = App\Core\CleanWords
    $class = str_ireplace("App\\", "", $class);
    //$class = Core\CleanWords
    $class = str_ireplace("\\", "/", $class);
    //$class = Core/CleanWords
    if (file_exists($class . ".class.php")) {
        include $class . ".class.php";
    }
}

spl_autoload_register("App\myAutoloader");


$uri = $_SERVER["REQUEST_URI"];

$routeFile = "routes.yml";
if (!file_exists($routeFile)) {
    die("Le fichier " . $routeFile . " n'existe pas");
}

$yaml_load = extension_loaded('yaml');

if ($yaml_load == false) {
    die("The PECL extension is not installed, please refer to the <a href=\"https://www.php.net/manual/fr/install.pecl.php\">PHP doc for installation</a>.");
} else {
    $routes = yaml_parse_file($routeFile);
}

// Permet de récupérer les paramètres d'une requête
// todo: rendre ça plus générique
$uri_explode = explode("/", $uri);

// À REGLER : POUR LE MOMENT, ON NE PEUT PAS AVOIR DE PARAMÈTRES DANS L'URI RESETPASSWORD
// localhost/r/{token} ne fonctionne pas
// J'ai tenté un fix avec elseif (preg_match("/\d/i", $uri_explode[3]) mais ne fonctionne pas

if (count($uri_explode) > 2) {
    if (preg_match("/\d/i", $uri_explode[2])) {
        $param = "id";
        // uri plus longue
        if (isset($uri_explode[3])) $uri = "/" . $uri_explode[1] . "/{{$param}}/" . $uri_explode[3];
        else $uri = "/" . $uri_explode[1] . "/{{$param}}";
        // paramètres de l'uri
        $params = [$param => $uri_explode[2]];
    } elseif (count($uri_explode) > 3 && preg_match("/\d/i", $uri_explode[3])) {
        if (strlen($uri_explode[3]) === 64) {
            // token
            $param = "token";
            if (isset($uri_explode[3])) $uri = "/" . $uri_explode[1] . "/" . $uri_explode[2] . "/{{$param}}";
            $params = [$param => $uri_explode[3]];
        } else {
            //            $param = "id";
            //            if (isset($uri_explode[3])) $uri = "/" . $uri_explode[1] . "/{{$param}}/" . $uri_explode[2];
            //            $params = [$param => $uri_explode[3]];
        }
    }
}

if (empty($routes[$uri]) || empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"]) || empty($routes[$uri]["role"])) {
    die("Page 404");
}

$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);

$controllerFile = "Controller/" . $controller . ".class.php";
if (!file_exists($controllerFile)) {
    die("Le controller " . $controllerFile . " n'existe pas");
}
include $controllerFile;

$controller = "App\\Controller\\" . $controller;
if (!class_exists($controller)) {
    die("La classe " . $controller . " n'existe pas");
}

$objectController = new $controller();

if (!method_exists($objectController, $action)) {
    die("La methode " . $action . " n'existe pas");
}

$session = new UserSession();
switch (($routes[$uri]["role"])) {
    case 'all':
        // regardless of the user's role
        break;
    case 'admin':
        if (!$session->ensureUserConnected() || $session->getUser()->getRole() !== "admin") header("Location: /login");
        break;
    case 'user':
        if (!$session->ensureUserConnected()) header("Location: /login");
        break;
    case 'logout':
        // the user must be not connected
        if ($session->ensureUserConnected()) echo "Vous devez d'abord vous <a href='/logout'>déconnecter</a>.";
        break;
}


// on passe les paramètres de l'url
if (!empty($params))
    $objectController->$action($params);
else $objectController->$action();
