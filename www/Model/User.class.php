<?php
namespace App\Model;

use App\Core\BaseSQL;
use App\Core\Routing;

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
    protected $registered_at;
	protected $updated_at;
	protected $activated;

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
        $bytes = random_bytes(128);
        $this->token = substr(str_shuffle(bin2hex($bytes)), 0, 255);
    }

    

    public function getFormRegister(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id" => "formRegister",
                "class" => "formRegister",
                "submit"=>"Sign Up"
            ],
            "inputs"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Firstname",
                    "id"=>"firstnameRegister",
                    "class"=>"form-input",
                    "name" => "firstname",
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Your firstname is incorrect. You need 2 to 50 caracters.",
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Lastname",
                    "id"=>"lastnameRegister",
                    "class"=>"form-input",
                    "name" => "lastname",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Your lastname is incorrect. You need 2 to 100 caracters.",
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Email",
                    "id"=>"emailRegister",
                    "class"=>"form-input",
                    "name" => "email",
                    "required"=>true,
                    "error"=>"Email incorrect",
                    "unicity"=>true,
                    "errorUnicity"=>"Email is already used.",
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Password",
                    "id"=>"pwdRegister",
                    "class"=>"form-input",
                    "name" => "password",
                    "required"=>true,
                    "error"=>"Your password must be between 8 and 16 and contain numbers and letters.",
                ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Please confirm your password",
                    "id"=>"pwdConfirmRegister",
                    "class"=>"inputRegister",
                    "name" => "passwordConfirm",
                    "required"=>true,
                    "confirm"=>"password",
                    "error"=>"Your confirmation password does not match.",
                ],
            ]

        ];
    }

    public function getFormUpdate(User $user): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"/users/".$user->getId()."/update",
                "submit"=>"Update"
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "id"=>"id",
                    "class"=>"id",
                    "value"=>$user->getId()
                ],
                "username"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom d'utilisateur",
                    "id"=>"username",
                    "class"=>"username",
                    "min"=>2,
                    "max"=>50,
                    "unicity"=>true,
                    "required"=>true,
                    "value"=>$user->getUsername()
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Prénom",
                    "id"=>"firstname",
                    "class"=>"firstname",
                    "min"=>2,
                    "max"=>50,
                    "required"=>true,
                    "value"=>$user->getFirstName()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom",
                    "id"=>"lastname",
                    "class"=>"firstname",
                    "min"=>2,
                    "max"=>100,
                    "required"=>true,
                    "value"=>$user->getLastName()
                ],
                "role"=>[
                    "type"=>"select",
                    "placeholder"=>"Rôle",
                    "name"=>"roles",
                    "id"=>"role",
                    "class"=>"role",
                    "roles"=>[
                        0=>[
                            "name"=>"user",
                            "id"=>"user",
                            "value"=>"user"
                        ],
                        1=>[
                            "name"=>"admin",
                            "id"=>"admin",
                            "value"=>"admin"
                        ],
                        2=>[
                            "name"=>"editor",
                            "id"=>"editor",
                            "value"=>"editor"
                        ],
                    ],
                ]
            ]
        ];
    }

    public function getLoginForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formLogin",
                "class" => "formLogin",
                "submit" => "Sign in"
            ],
            "inputs" => [
                "email" => [
                    "placeholder" => "Email",
                    "type" => "email",
                    "id" => "emailRegister",
                    "class" => "form-input",
                    "required" => true,
                ],
                "password" => [
                    "placeholder" => "Password",
                    "type" => "password",
                    "id" => "pwdRegister",
                    "class" => "form-input",
                    "required" => true,
                ]
            ]
        ];
    }

    public function formForgetPwd(){
        return [

            "config" => [
                    "method" => "POST",
                    "action" => "",
                    "id" => "form_forgetpwd",
                    "class" => "form_builder",
                    "submit" => "Valider"
                ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "label" => "Votre email",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "Exemple: nom@gmail.com",
                    "value" => $this->getEmail() ?? '',
                    "error" => "Votre email doit faire entre 8 et 320 caractères",
                    "required" => true
                ]
            ]
        ];
    }
    

    public function save()
    {
        parent::save();
    }

}