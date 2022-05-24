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
        try{
            //Connexion à la base de données
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME ,DBUSER , DBPWD );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){
            die("Erreur SQL".$e->getMessage());
        }
        //Récupérer le nom de la table :
        // -> prefixe + nom de la classe enfant
        $classExploded = explode("\\",get_called_class());
        $this->table = DBPREFIXE.strtolower(end($classExploded));

    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $sql = "SELECT * FROM ".$this->table. " WHERE id=:id ";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["id"=>$id] );
        return $queryPrepared->fetchObject(get_called_class());
    }


    protected function save()
    {

        $columns  = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);


       if( !is_null($this->getId()) ){
           foreach ($columns as $key=>$value){
                $setUpdate[]=$key."=:".$key;
           }
           $sql = "UPDATE ".$this->table." SET ".implode(",",$setUpdate)." WHERE id=".$this->getId();
       }else{
            $sql = "INSERT INTO ".$this->table." (".implode(",", array_keys($columns)).")
            VALUES (:".implode(",:", array_keys($columns)).")";
       }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( $columns );

    }

    protected function findAllUsers()
    {
        $sql = "SELECT `id`,`username`,`first_name`,`last_name`,`role` FROM `".DBPREFIXE."user`";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

        $users = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

        return $users;

    }

    protected function findUser()
    {

        if(isset($_GET['id']) && !empty($_GET['id'])) {

            $id = strip_tags($_GET['id']);

            $sql = "SELECT `id`,`username`,`first_name`,`last_name`,`role` FROM `" .DBPREFIXE."user` WHERE `id`=:id";

            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->bindValue(':id', $id, PDO::PARAM_INT);
            $queryPrepared->execute(['id' => $id]);

            $queryPrepared->fetchAll();
        }
    }

//    protected function updateUser()
//    {
//        if (isset($_GET['id']) && !empty($_GET['id'])) {
//
//            $id = strip_tags($_GET['id']);
//
//            $sql = "UPDATE `".DBPREFIXE."user` SET `username`=:username, `first_name`=:firstname, `last_name`=:lastname WHERE `id`=:id";
//
//            $queryPrepared = $this->pdo->prepare($sql);
//
//            $queryPrepared->bindValue(':username', $username, PDO::PARAM_STR);
//            $queryPrepared->bindValue(':firstname', $firstname, PDO::PARAM_STR);
//            $queryPrepared->bindValue(':nombre', $nombre, PDO::PARAM_INT);
//            $queryPrepared->bindValue(':id', $id, PDO::PARAM_INT);
//
//        }
//    }

    protected function deleteUser()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])){

            $id = strip_tags($_GET['id']);

            $sql = "DELETE FROM `".DBPREFIXE."user` WHERE `id`=:id";

            $queryPrepared = $this->pdo->prepare($sql);

            $queryPrepared->bindValue(':id', $id, PDO::PARAM_INT);
            $queryPrepared->execute(['id' => $id]);

            header('Location: /users');
        }

    }
}