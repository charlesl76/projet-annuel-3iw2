<?php

namespace App\Core;

use App\Model\User;

class Validator extends BaseSQL
{

    public static function checkForm($config, $data): array
    {
        $result = [];
        //Le nb de inputs envoyés ?
        $images = array_filter($config['inputs'], function($input) {
            return $input["type"] === "file";
        });

        if (count($data) != count($config["inputs"])) {
            $result[] = "Form modified by user";
        }
        foreach ($config["inputs"] as $name => $input) {

            if (!isset($data[$name])) {
                $result[] = "Missing fields";
            }
            if (!empty($input["required"]) && empty($data[$name])) {
                $result[] = "You have removed the required attribute";
            }

            if ($input["type"] == "password" && !self::checkPassword($data[$name])) {
                $result[] = "The password is not strong enough";
            } else if ($input["type"] == "email"  && !self::checkEmail($data[$name])) {
                $result[] = "Email incorrect";
            }

            if ($input["type"] == "checkbox" && empty($data[$name])) {
                $result[] = "You must accept the CGU";
            } else if ($input["type"] == "checkbox" && !empty($data[$name])) {
                // var_dump($data[$name]);
            } else if ($input["type"] == "select" && !empty($data[$name])) {
                // var_dump($data[$name]);
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
        } elseif (!empty($data["input"]) && $data["input"] == "tag") {
            switch ($data["type"]):
                case "add":
                    if (!isset($data["title"]) || empty($data["title"])) {
                        $result["input"] = "Do not forget to fill the title in the form";
                    }
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to put an image in the form";
                    }
                    break;
                case "update":
                    if (!isset($data["title"]) || empty($data["title"])) {
                        $result["input"] = "Do not forget to fill the title in the form";
                    }
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to put an image in the form";
                    }
                    break;
                case "delete":
                    return $result;
                    break;
            endswitch;
        } elseif (!empty($data["input"]) && $data["input"] == "comment") {
            switch ($data["type"]):
                case "add":
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to fill the content in the form";
                    }
                    if (!isset($data["post_parent"]) || empty($data["post_parent"])) {
                        $result["input"] = "Do not forget to put a post parent on the comment";
                    }
                    break;
                case "update":
                    if (!isset($data["content"]) || empty($data["content"])) {
                        $result["input"] = "Do not forget to fill the content in the form";
                    }
                    if (!isset($data["post_parent"]) || empty($data["post_parent"])) {
                        $result["input"] = "Do not forget to put a post parent on the comment";
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


    public function changePassword($token, $oldPassword, $newPassword, $newPasswordConfirm): bool
    {
        $user = new User();
        $user = $user->findByColumn(["id", "password", "token"], ["token" => $token]);

        if (hash('sha512', $oldPassword) === $user['password']) {
            if ($newPassword === $newPasswordConfirm) {
                $user = $this->findUserById($user['id']);
                $user->setPassword(hash('sha512', $newPassword));
                $datetime = new \DateTime();
                $user->setUpdatedAt($datetime->format('Y-m-d H:i:s'));
                $user->save();
                return true;
            }
        }
        return false;
    }


    
}
