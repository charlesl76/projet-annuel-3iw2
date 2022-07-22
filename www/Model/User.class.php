<?php

namespace App\Model;

use App\Core\BaseSQL;

class User extends BaseSQL
{

    public $id = null;
    public $email;
    public $password;
    public $username;
    public $first_name;
    public $last_name;
    public $role;
    public $status = null;
    public $token = null;
    public $birth;
    public $gender;
    public $registered_at;
	public $updated_at;
	public $activated;

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
        $this->token = bin2hex(openssl_random_pseudo_bytes(32));
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

    /**
     * @return mixed
     */
    public function getRegistered_at()
    {
        return $this->registered_at;
    }

    /**
     * @param mixed $registered_at
     */
    public function setRegistered_at($registered_at)
    {
        $this->registered_at = $registered_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function generateToken(): void
    {
        $this->token = bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function getFormRegister(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formRegister",
                "class" => "formRegister",
                "submit" => "Sign up"
            ],
            "inputs" => [
                "username" => [
                    "type" => "text",
                    "placeholder" => "Username",
                    "id" => "usernameRegister",
                    "class" => "form-input",
                    "required" => true,
                    "error" => "Incorrect username",
                    "unicity" => true,
                    "errorUnicity" => "Username already used.",
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Email",
                    "id" => "emailRegister",
                    "class" => "form-input",
                    "required" => true,
                    "error" => "Incorrect email",
                    "unicity" => true,
                    "errorUnicity" => "Email already used",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Password",
                    "id" => "pwdRegister",
                    "class" => "form-input",
                    "required" => true,
                    "error" => "Your password must contain 8 to 16 and must have numbers and letters.",
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Password confirmation",
                    "id" => "pwdConfirmRegister",
                    "class" => "form-input",
                    "required" => true,
                    "confirm" => "password",
                    "error" => "Your confirmation password does not match.",
                ],
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Firstname",
                    "id" => "firstnameRegister",
                    "class" => "form-input",
                    "min" => 2,
                    "max" => 50,
                    "error" => "Firstname incorrect",
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Lastname",
                    "id" => "lastnameRegister",
                    "class" => "form-input",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Last name incorrect",
                ],
                // "cgu" => [
                //     "type" => "checkbox",
                //     "placeholder" => "Acceptez-vous les CGU",
                //     "name" => "cgu",
                //     "id" => "cgu",
                //     "class" => "cgu",
                //     "required" => "true",
                //     "error" => "Merci d'accepter les CGU afin de continuer",
                // ],
                // "select" => [
                //     "type" => "select",
                //     "placeholder" => "Sélectionnez votre pays",
                //     "name" => "country",
                //     "id" => "countryRegister",
                //     "class" => "countryRegister",
                //     "countries" => [
                //         0 => [
                //             "name" => "France",
                //             "id" => "fr"
                //         ],
                //         1 => [
                //             "name" => "United Kingdom",
                //             "id" => "uk"
                //         ],
                //         2 => [
                //             "name" => "Brazil",
                //             "id" => "br"
                //         ],
                //         3 => [
                //             "name" => "United States of America",
                //             "id" => "usa"
                //         ],
                //     ],
                // ]
//            "config"=>[
//                "method"=>"POST",
//                "action"=>"",
//                "id" => "formRegister",
//                "class" => "formRegister",
//                "submit"=>"Sign Up"
//            ],
//            "inputs"=>[
//                "firstname"=>[
//                    "type"=>"text",
//                    "placeholder"=>"Firstname",
//                    "id"=>"firstnameRegister",
//                    "class"=>"form-input",
//                    "name" => "firstname",
//                    "min"=>2,
//                    "max"=>50,
//                    "error"=>"Your firstname is incorrect. You need 2 to 50 caracters.",
//                ],
//                "lastname"=>[
//                    "type"=>"text",
//                    "placeholder"=>"Lastname",
//                    "id"=>"lastnameRegister",
//                    "class"=>"form-input",
//                    "name" => "lastname",
//                    "min"=>2,
//                    "max"=>100,
//                    "error"=>"Your lastname is incorrect. You need 2 to 100 caracters.",
//                ],
//                "email"=>[
//                    "type"=>"email",
//                    "placeholder"=>"Email",
//                    "id"=>"emailRegister",
//                    "class"=>"form-input",
//                    "name" => "email",
//                    "required"=>true,
//                    "error"=>"Email incorrect",
//                    "unicity"=>true,
//                    "errorUnicity"=>"Email is already used.",
//                ],
//                "password"=>[
//                    "type"=>"password",
//                    "placeholder"=>"Password",
//                    "id"=>"pwdRegister",
//                    "class"=>"form-input",
//                    "name" => "password",
//                    "required"=>true,
//                    "error"=>"Your password must be between 8 and 16 and contain numbers and letters.",
//                ],
//                "passwordConfirm"=>[
//                    "type"=>"password",
//                    "placeholder"=>"Please confirm your password",
//                    "id"=>"pwdConfirmRegister",
//                    "class"=>"inputRegister",
//                    "name" => "passwordConfirm",
//                    "required"=>true,
//                    "confirm"=>"password",
//                    "error"=>"Your confirmation password does not match.",
//                ],
//            ]
                ]
            ];
    }

    public function getFormLogin(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formLogin",
                "class" => "formLogin",
                "submit" => "Sign In"
            ],
            "inputs" => [
                "username" => [
                    "type" => "text",
                    "placeholder" => "Username",
                    "id" => "usernameLogin",
                    "class" => "form-input",
                    "required" => true,
                    "error" => "Incorrect username",
                    "unicity" => true,
                    "errorUnicity" => "Username already used.",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Password",
                    "id" => "pwdLogin",
                    "class" => "form-input",
                    "required" => true,
                    "error" => "Your password must contain 8 to 16 and must have numbers and letters.",
                ],
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
                    "placeholder" => "Username",
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
                    "placeholder" => "Firstname",
                    "id" => "firstname",
                    "class" => "firstname",
                    "min" => 2,
                    "max" => 50,
                    "required" => true,
                    "value" => $user->getFirstName()
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Lastname",
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

    public function getFormResetPassword(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Valider"
            ],
            "inputs" => [
                "oldPassword" => [
                    "type" => "password",
                    "placeholder" => "Your old password",
                    "id" => "oldPassword",
                    "class" => "oldPassword",
                    "required" => true,
                    "error" => "Your password must contain 8 to 16 and must have numbers and letters.",
                ],
                "newPassword" => [
                    "type" => "password",
                    "placeholder" => "Your new password",
                    "id" => "newPassword",
                    "class" => "newPassword",
                    "required" => true,
                    "error" => "Your password must contain 8 to 16 and must have numbers and letters.",
                ],
                "newPasswordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation of your new password.",
                    "id" => "newPasswordConfirm",
                    "class" => "newPasswordConfirm",
                    "required" => true,
                    "confirm" => "password",
                    "error" => "Your confirmation password does not match",
                ],
            ]

        ];
    }

    public function getUserByCredentials(string $user_cred)
    {
        $user = $this->findByColumn(["email"], ["email" => $user_cred]);
        if (isset($user["email"])) {
            return $user;
        } else {
            $user = $this->findByColumn(["username"], ["username" => $user_cred]);
            if (isset($user["username"])) {
                return $user;
            } else {
                $user = $this->findByColumn(["username"], ["id" => $user_cred]);
                if (isset($user["username"])){
                    return $user["username"];
                } else {
                    return false;
                }
            }
        }
    }

    protected function forgotPasswordProcess(array $user):array
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
            } else {
                $data["error"] = "Votre compte n'est pas activé ou est bloqué.";
                return $data;
            }
        } elseif (isset($user["username"])) {
            $user = $this->findByColumn(["id", "username", "activated", "blocked", "email"], ["username" => $user["username"]]);
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
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function forgotPassword(string $user_cred)
    {
        if (!empty($user_cred)) {
            $user = $this->getUserByCredentials($user_cred);
            if ($user !== false) {
                // Il faut maintenant traiter l'envoi de mail
                return $this->forgotPasswordProcess($user);
            } else return false;
        } else return false;
    }

    public function tokenCheck(string $token)
    {
        $user = $this->findByColumn(["token"], ["token" => $token]);
        if (isset($user["token"])) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @return false|string|null
     */
    public function save()
    {
        return parent::save();
    }

    /**
     * @return mixed
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

}
