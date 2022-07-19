<?php

namespace App\Core;

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
        $sql = "SELECT * FROM " . $this->table;

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllBy(array $params, string $opt_table = null): array
    {
        foreach ($params as $key => $value) {
            $where[] = $key . "=:" . $key;
        }
        if (!is_null($opt_table)) {
            $sql = "SELECT * FROM " . DBPREFIXE . strtolower($opt_table) . " WHERE " . (implode(" AND ", $where));
        } else {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . (implode(" AND ", $where));
        }
        // echo $sql;
        // return true;
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneBy(array $params): array
    {
        foreach ($params as $key => $value) {
            $where[] = $key . "=:" . $key;
        }

        $sql = "SELECT * FROM " . $this->table . " WHERE " . (implode(" AND ", $where));
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByColumn(array $columns, array $params): array
    {
        $select = $columns;

        foreach ($params as $key => $value) {
            $where[] = $key . "=:" . $key;
        }

        $sql = "SELECT " . implode(",", $select) . " FROM " . $this->table . " WHERE " . (implode(" AND ", $where));
        // echo $sql;
        // return true;
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute($params);
        $data = $queryPrepared->fetch(PDO::FETCH_ASSOC);
        $data = empty($data) ? ["user" => false] : $data;
        return $data;
    }

    public function deleteOne()
    {   
        if (isset($_POST['id']) && !empty($_POST['id'])) {

            $id = strip_tags($_POST['id']);

            $sql = "DELETE FROM `" . $this->table . "` WHERE `id`=:id";

            $queryPrepared = $this->pdo->prepare($sql);

            $queryPrepared->bindValue(':id', $id, PDO::PARAM_INT);
            $queryPrepared->execute(['id' => $id]);

            return true;
        }
    }
}
