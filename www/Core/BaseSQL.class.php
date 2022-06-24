<?php

namespace App\Core;

use PDO;

abstract class BaseSQL
{
    private $pdo;
    private $table;


    public function __construct()
    {
        //Faudra intégrer le singleton
        try {
            //Connexion à la base de données
            $this->pdo = new \PDO(DBDRIVER . ":host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME, DBUSER, DBPWD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Erreur SQL" . $e->getMessage());
        }
        //Récupérer le nom de la table :
        // -> prefixe + nom de la classe enfant
        $classExploded = explode("\\", get_called_class());
        $this->table = DBPREFIXE . strtolower(end($classExploded));
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=:id ";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute(["id" => $id]);
        return $queryPrepared->fetchObject(get_called_class());
    }


    protected function save()
    {

        $columns  = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);

        if (!is_null($this->getId())) {
            foreach ($columns as $key => $value) {
                $setUpdate[] = $key . "=:" . $key;
            }
            $sql = "UPDATE " . $this->table . " SET " . implode(",", $setUpdate) . " WHERE id=" . $this->getId();
        } else {
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ")
            VALUES (:" . implode(",:", array_keys($columns)) . ")";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($columns);
    }

  
    public function findAll()
    {
        $sql = "SELECT * FROM ".$this->table;

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneBy(array $params): array
    {
        var_dump($params);
      
        foreach ($params as $key => $value) {
            $where[] = $key . "=:" . $key;
        }
        $sql = "SELECT * FROM " . $this->table . " WHERE " . (implode(" AND ", $where));
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        return $queryPrepared->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteOne()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {

            $id = strip_tags($_POST['id']);

            $sql = "DELETE FROM `" . $this->table . "` WHERE `id`=:id";
          
        foreach ($params as $key=>$value){
            $where[] = $key."=:".$key;
        }
        $sql = "SELECT * FROM ".$this->table." WHERE ".(implode(" AND ", $where));
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
       return $queryPrepared->fetch(PDO::FETCH_ASSOC);
    }
}

    public function login($data)
    {

        $bdd = new \PDO(DBDRIVER . ":host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME, DBUSER, DBPWD
            , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);

        $value = $data[key($data)];
        $email = htmlspecialchars($value);
        $sql = "SELECT * FROM " . $this->table . " WHERE " . key($data) . " = '" . $value . "'";
        $sql1 = "SELECT password FROM " . $this->table . " WHERE " . key($data) . " = '" . $value . "'";
        
        $reponse = $bdd->query($sql);
        $donnees = $reponse->fetch();
        //var_dump($donnees);

        $sql1 = "SELECT password FROM " . $this->table . " WHERE " . key($data) . " = '" . $value . "'";
        $reponse1 = $bdd->query($sql1);
        $donnees1 = $reponse1->fetch();
         //var_dump($donnees1);


        if (password_verify($_POST["password"], $donnees1[0])) {
            $session = new Session();
            $userManager = new UserModel();
            $user = $user->getBy("email", $value);
            $user->setId($donnees['id']);
            $session->set("user", $donnees);
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

    }

}
