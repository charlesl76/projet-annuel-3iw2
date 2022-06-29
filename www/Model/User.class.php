<?php

namespace App\Model;

use App\Core\BaseSQL;

class User extends BaseSQL
{

    protected $id = null;
    protected $email;
    protected $password;
    protected $username;
    protected $first_name;
    protected $last_name;
    protected $role;
    protected $status = null;
    protected $token = null;
    protected $birth;
    protected $gender;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param null $token
     */
    public function setToken($token)
    {
        $token = urlencode(base64_encode(openssl_random_pseudo_bytes(32)));
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getFormRegister(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "S'inscrire"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "id" => "emailRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Email incorrect",
                    "unicity" => true,
                    "errorUnicity" => "Email existe déjà en bdd",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe ...",
                    "id" => "pwdRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire entre 8 et 16 et contenir des chiffres et des lettres",
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation ...",
                    "id" => "pwdConfirmRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "confirm" => "password",
                    "error" => "Votre mot de passe de confirmation ne correspond pas",
                ],
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Prénom ...",
                    "id" => "firstnameRegister",
                    "class" => "inputRegister",
                    "min" => 2,
                    "max" => 50,
                    "error" => "Votre prénom n'est pas correct",
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Nom ...",
                    "id" => "lastnameRegister",
                    "class" => "inputRegister",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom n'est pas correct",
                ],
                "cgu" => [
                    "type" => "checkbox",
                    "placeholder" => "Acceptez-vous les CGU",
                    "name" => "cgu",
                    "id" => "cgu",
                    "class" => "cgu",
                    "required" => "true",
                    "error" => "Merci d'accepter les CGU afin de continuer",
                ],
                "select" => [
                    "type" => "select",
                    "placeholder" => "Sélectionnez votre pays",
                    "name" => "country",
                    "id" => "countryRegister",
                    "class" => "countryRegister",
                    "countries" => [
                        0 => [
                            "name" => "France",
                            "id" => "fr"
                        ],
                        1 => [
                            "name" => "United Kingdom",
                            "id" => "uk"
                        ],
                        2 => [
                            "name" => "Brazil",
                            "id" => "br"
                        ],
                        3 => [
                            "name" => "United States of America",
                            "id" => "usa"
                        ],
                    ],
                ]
            ]

        ];
    }

    public function getFormUpdate(User $user): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/users/" . $user->getId() . "/update",
                "submit" => "Update"
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "id",
                    "value" => $user->getId()
                ],
                "username" => [
                    "type" => "text",
                    "placeholder" => "Nom d'utilisateur",
                    "id" => "username",
                    "class" => "username",
                    "min" => 2,
                    "max" => 50,
                    "unicity" => true,
                    "required" => true,
                    "value" => $user->getUsername()
                ],
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Prénom",
                    "id" => "firstname",
                    "class" => "firstname",
                    "min" => 2,
                    "max" => 50,
                    "required" => true,
                    "value" => $user->getFirstName()
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Nom",
                    "id" => "lastname",
                    "class" => "firstname",
                    "min" => 2,
                    "max" => 100,
                    "required" => true,
                    "value" => $user->getLastName()
                ],
                "role" => [
                    "type" => "select",
                    "placeholder" => "Rôle",
                    "name" => "roles",
                    "id" => "role",
                    "class" => "role",
                    "roles" => [
                        0 => [
                            "name" => "user",
                            "id" => "user",
                            "value" => "user"
                        ],
                        1 => [
                            "name" => "admin",
                            "id" => "admin",
                            "value" => "admin"
                        ],
                        2 => [
                            "name" => "editor",
                            "id" => "editor",
                            "value" => "editor"
                        ],
                    ],
                ]
            ]
        ];
    }

    public function getUserByCredentials($user_cred)
    {
        $user = $this->findByColumn(["email"], ["email" => $user_cred]);
        if (isset($user["email"])) {
            return $user;
        } else {
            $user = $this->findByColumn(["username"], ["username" => $user_cred]);
            if (isset($user["username"])) {
                return $user;
            } else {
                return false;
            }
        }
    }

    protected function forgotPasswordProcess(array $user)
    {

        if (isset($user["email"])) {
            $user = $this->findByColumn(["id", "username", "activated", "blocked", "email"], ["email" => $user["email"]]);
            if($user["activated"] == 1 && $user["blocked"] == 0){
                $user_cred = new User;
                $user_cred->id = $user["id"];
                $user_cred->getId();
                $token = null;
                $user_cred->setToken($token);
                $user_cred->save();
                $data["email"] = $user["email"];
                $data["username"] = $user["username"];
                $data["token"] = $user_cred->getToken();
                return $data;
            }
            return $user;
        } elseif (isset($user["username"])) {
            $user = $this->findByColumn(["id", "activated", "blocked"], ["username" => $user["username"]]);
            return $user;
        } else {
            return false;
        }
    }

    public function forgotPassword($user_cred)
    {
        if (isset($user_cred) && !empty($user_cred)) {
            $user = $this->getUserByCredentials($user_cred);
            if ($user !== false) {
                // Il faut maintenant traiter l'envoi de mail
                $user = $this->forgotPasswordProcess($user);
                return $user;
            } else {
                echo "non";
                // Renvoyer une erreur en cas de non trouvation
                return "ça marche pas";
            }
        }
    }

    public function save()
    {
        parent::save();
    }
}
