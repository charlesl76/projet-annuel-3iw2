<?php
namespace App\Model;

use App\Core\BaseSQL;

class User extends BaseSQL
{

    protected $id = null;
    protected $email;
    protected $password;
    protected $first_name;
    protected $last_name;
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
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    public function getFormRegister(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"S'inscrire"
            ],
            "inputs"=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "id"=>"emailRegister",
                    "class"=>"inputRegister",
                    "required"=>true,
                    "error"=>"Email incorrect",
                    "unicity"=>true,
                    "errorUnicity"=>"Email existe déjà en bdd",
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "id"=>"pwdRegister",
                    "class"=>"inputRegister",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire entre 8 et 16 et contenir des chiffres et des lettres",
                ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "id"=>"pwdConfirmRegister",
                    "class"=>"inputRegister",
                    "required"=>true,
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Prénom ...",
                    "id"=>"firstnameRegister",
                    "class"=>"inputRegister",
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Votre prénom n'est pas correct",
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom ...",
                    "id"=>"lastnameRegister",
                    "class"=>"inputRegister",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Votre nom n'est pas correct",
                ],
                "cgu"=>[
                    "type"=>"checkbox",
                    "placeholder"=>"Acceptez-vous les CGU",
                    "name"=>"cgu",
                    "id"=>"cgu",
                    "class"=>"cgu",
                    "required"=>"true",
                    "error"=>"Merci d'accepter les CGU afin de continuer",
                ],
                "select"=>[
                    "type"=>"select",
                    "placeholder"=>"Sélectionnez votre pays",
                    "name"=>"country",
                    "id"=>"countryRegister",
                    "class"=>"countryRegister",
                    "countries"=>[
                        0=>[
                            "name"=>"France",
                            "id"=>"fr"
                        ],
                        1=>[
                            "name"=>"United Kingdom",
                            "id"=>"uk"
                        ],
                        2=>[
                            "name"=>"Brazil",
                            "id"=>"br"
                        ],
                        3=>[
                            "name"=>"United States of America",
                            "id"=>"usa"
                        ],
                    ],
                ]
            ]

        ];
    }

    public function getFormUpdate(): array
    {
        $user = $this->findUser();

        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Update"
            ],
            "inputs"=>[
                "username"=>[
                    "type"=>"text",
                    "id"=>"usernameUpdate",
                    "min"=>2,
                    "max"=>50,
                    "unicity"=>true,
                    "required"=>true,
                    "value"=>$user['username']
                ],
                "firstname"=>[
                    "type"=>"text",
                    "id"=>"firstnameUpdate",
                    "min"=>2,
                    "max"=>50,
                    "required"=>true,
                    "value"=>$user['firstname']
                ],
                "lastname"=>[
                    "type"=>"text",
                    "id"=>"lastnameUpdate",
                    "min"=>2,
                    "max"=>100,
                    "required"=>true,
                    "value"=>$user['lastname']
                ],
            ]
        ];
    }

}