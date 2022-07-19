<?php

namespace App\Core;
use App\Core\BaseSQL;

class Validator
{

    public static function checkForm($config, $data): array
    {
        $result = [];
        //Le nb de inputs envoyés ?
        $images = array_filter($config['inputs'], function($input) {
            return $input["type"] === "file";
        });

        if (count($data) != count($config["inputs"])) {
            $result[] = "Formulaire modifié par user";
        }
        foreach ($config["inputs"] as $name => $input) {

            if (!isset($data[$name])) {
                $result[] = "Il manque des champs";
            }
            if (!empty($input["required"]) && empty($data[$name])) {
                $result[] = "Vous avez supprimé l'attribut required";
            }

            if ($input["type"] == "password" && !self::checkPassword($data[$name])) {
                $result[] = "Le mot de passe n'est pas assez fort";
            } else if ($input["type"] == "email"  && !self::checkEmail($data[$name])) {
                $result[] = "Email incorrect";
            }

            if ($input["type"] == "checkbox" && empty($data[$name])) {
                $result[] = "Vous devez accepter les CGU";
            } else if ($input["type"] == "checkbox" && !empty($data[$name])) {
                var_dump($data[$name]);
            } else if ($input["type"] == "select" && !empty($data[$name])) {
                var_dump($data[$name]);
            }
        }
        return $result;
    }

    public static function checkPost($config, $data)
    {
        $result = [];

        if (!empty($data["input"]) && $data["input"] == "page") {
            switch ($data["type"]):
                case "add":
                    if (!isset($data["author"]) || empty($data["author"])) {
                        $result["input"] = "Do not forget to fill the author in the form";
                    }
                    if (!isset($data["title"]) || empty($data["title"])) {
                        $result["input"] = "Do not forget to fill the title in the form";
                    }
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to fill the content in the form";
                    }
                    break;
                case "update":
                    if (!isset($data["author"]) || empty($data["author"])) {
                        $result["input"] = "Do not forget to fill the author in the form";
                    }
                    if (!isset($data["title"]) || empty($data["title"])) {
                        $result["input"] = "Do not forget to fill the title in the form";
                    }
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to fill the content in the form";
                    }
                    break;
                case "delete":
                    return $result;
                    break;
            endswitch;
        } elseif (!empty($data["input"]) && $data["input"] == "article") {
            switch ($data["type"]):
                case "add":
                    if (!isset($data["author"]) || empty($data["author"])) {
                        $result["input"] = "Do not forget to fill the author in the form";
                    }
                    if (!isset($data["title"]) || empty($data["title"])) {
                        $result["input"] = "Do not forget to fill the title in the form";
                    }
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to fill the content in the form";
                    }
                    if (!isset($data["post_parent"]) || empty($data["post_parent"])) {
                        $result["input"] = "Do not forget to put a tag on the article";
                    }
                    break;
                case "update":
                    if (!isset($data["author"]) || empty($data["author"])) {
                        $result["input"] = "Do not forget to fill the author in the form";
                    }
                    if (!isset($data["title"]) || empty($data["title"])) {
                        $result["input"] = "Do not forget to fill the title in the form";
                    }
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to fill the content in the form";
                    }
                    if (!isset($data["post_parent"]) || empty($data["post_parent"])) {
                        $result["input"] = "Do not forget to put a tag on the article";
                    }
                    break;
                case "delete":
                    return $result;
                    break;
            endswitch;
        } else {
            $result[] = "Fatal error, no input specified in the form";
        }

        return $result;

    }


    public static function checkEmail($email): bool
    {
       return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public static function checkPassword($password): bool
    {

        return strlen($password)>=8
            && preg_match("/[0-9]/", $password, $match)
            && preg_match("/[a-z]/", $password, $match)
            && preg_match("/[A-Z]/", $password, $match);
    }
    
}
