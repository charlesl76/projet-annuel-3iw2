<?php

namespace App\Core;
use App\Model\User;
use App\Model\User as UserModel;

use PDO;

abstract class BaseSQL
{
    private $pdo;
    private $table;
    private $data = [];
   


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

    public function __get($attr)
    {
        if (isset($this->data[$attr])) {
            if (method_exists($this, 'customGet')) {
                return $this->customGet($attr, $this->data[$attr]);
            } else {
                return $this->data[$attr];
            }
        } else {
            return false;
        }
    }

    public function __set($attr, $value)
    {
        if (method_exists($this, 'customSet')) {
            $this->data[$attr] = $this->customSet($attr, $value);
        } else {
            $this->data[$attr] = $value;
        }

        return $this;
    }


    public function save()
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

    public function verifieMailUnique() {
		$column = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);
		$sql = $this->pdo->prepare("SELECT count(email) as nb FROM " . $this->table . " WHERE email = :email");

		if ($sql->execute(['email' => $column["email"]])) {
			$obj = $sql->fetch();
			return $obj["nb"];
		}

		return false;
	}


    public function getTable(): string
    {
        return $this->table;
    }

   
    public function setTable(string $table): void
    {
        $this->table = $table;
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

        if(password_verify($_POST["password"], $donnees1[0])) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

    }

    


}
