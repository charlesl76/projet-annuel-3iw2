<?php
    namespace App\core;

	class Db
	{
		private $instance  = null;
		public static $connection;

		private function __construct()
		{
			try{
                $this->instance  = new \PDO(DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME , DBUSER , DBPWD
                , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);
            }catch(\Exception $e){
                die('Error sql' . $e->getMessage());
            }
		}

        /**
   * Récupérer l'instance de la classe, si elle n'existe pas elle sera créée
   * automatiquement puis retournée.
   *
   * @return Sql Instance de la classe SQL.
   * @link https://refactoring.guru/design-patterns/singleton
   */

		public static function connect()
		{
			if (!isset(self::$connection))
			{
				self::$connection = new Db();
			}
			return self::$connection;
		}

        public function prepare($sql, $array = []){
			$statement = $this->instance->prepare($sql);
			$statement->execute($array);
			return $statement;
		}
	}
