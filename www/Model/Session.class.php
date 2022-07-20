<?php

namespace App\Model;

use App\Core\BaseSQL;
use DateInterval;
use DateTime;

class Session extends BaseSQL
{

    protected $id;
    protected $token;
    protected $user_id;
    protected $user;
    protected $expiration_date;

    public function __construct()
    {
        parent::__construct();
        $this->setToken();
        $this->setExpirationDate();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    public function setToken(): void
    {
        if (!$this->ensureUserConnected()) $this->token = bin2hex(openssl_random_pseudo_bytes(32));
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(): void
    {
        $date = new DateTime();
        $date->add(new DateInterval('P15D'));
        $expirationDate = $date->format('Y-m-d H:i:s');
        $this->expiration_date = $expirationDate;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * Cette fonction permet de récupérer un utilisateur à partir d'un jeton d'authentification présent dans le header
     */
    public function ensureUserConnected() {
        $headers = $_SESSION;
        if(isset($headers['Authorization'])) {
            $token = $headers['Authorization'];
            $tokenArray = explode(' ', $token);
            if(count($tokenArray) == 2 && $tokenArray[0] == 'Bearer') {
                $token = $tokenArray[1];
                $session = parent::sessionWithToken($token);
                if($session) {
                    $user = parent::findByColumn(["user_id"], ["user_id" => $session['user_id']]);
                    if($user) {
                        // utilisateur connecté
                        $this->user_id = $session['user_id'];
                        // hydrate user
                        $this->user = $this->findUserById($this->user_id);
                        return $user;
                    }
                }
            }
        }
        return false;
    }

    public function erase() {
        if ($this->ensureUserConnected()) {
            $tokens = $this->findAllBy(["user_id" => $this->getUserId()]);
            foreach ($tokens as $token) {
                // suppression de tous les tokens de l'utilisateur
                $tokenArray = $this->findOneBy(["token" => $token['token']]);
                $this->deleteOne($tokenArray['id']);
            }
            $this->deleteOne($this->getId());
            $this->id = NULL;
            $this->token = NULL;
            $this->user_id = NULL;
            $this->user = NULL;
            $this->expiration_date = NULL;
            session_unset();
            session_destroy();
            echo "Vous êtes maintenant déconnecté.";
        } else header("Location: /login");
    }
}
