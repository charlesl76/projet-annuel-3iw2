<?php

namespace App\Core;

class View
{
    private $view;
    private $template;
    private $data = [];

    public function __construct($view, $template = "front")
    {
        $this->setView($view);
        $this->data["final_url"] = $this->dynamicNav();
        $this->setTemplate($template);
    }

    public function setView($view)
    {
        $this->view = strtolower($view);
    }

    public function setTemplate($template)
    {
        $this->template = strtolower($template);
    }

    public function assign($key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function dynamicNav()
    {
        $initial_url = $_SERVER['REQUEST_URI'];
        $slashes_count = substr_count($initial_url, "/");
        $final_url = "";

        if ($slashes_count > 1) {
            for ($i = 0; $i < $slashes_count; $i++) {
                $final_url .= "../";
            }

            if (strstr($final_url, "//") != false) {
                $final_url = str_replace("//", "/", $final_url);
            }
        }

        $this->data["final_url"] = $final_url;

        return $final_url;
    }

    public function includePartial($name, $config)
    {
        if (!file_exists("View/Partial/" . $name . ".partial.php")) {
            die("partial " . $name . " 404");
        }
        include "View/Partial/" . $name . ".partial.php";
    }

    public function __toString(): string
    {
        return "Ceci est la classe View";
    }


    public function __destruct()
    {
        extract($this->data);
        include "View/" . $this->template . ".tpl.php";
    }
}
