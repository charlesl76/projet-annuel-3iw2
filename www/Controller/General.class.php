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
}