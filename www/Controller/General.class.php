<?php

namespace App\Controller;

use App\Core\View;

class General{

    public function home()
    {
        $view = new View("index", "front");
    }

    public function contact()
    {
        $view = new View("contact");
    }

    public function error404()
    {
        header("HTTP/1.1 404 Not Found");
        $view = new View("404");
    }
}