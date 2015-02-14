<?php 

	/**
	* Database Class
	*/
	class Database
	{
		private $host 		=DB_HOST;
		private $user 		=DB_USER;
		private $pass 		=DB_PASS;
		private $dbname 	=DB_NAME;

		// DataBase Handler
		private $DBH;
		// Statement Handler
		private $STH;
		private $error;

		public function __construct()
		{
			// Set DNS
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			// Set Options
			$options = array(
				PDO::ATTR_PERSISTENT 	=> true,
				PDO::ATTR_ERRMODE 		=> PDO::ERRMODE_EXCEPTION
			);
			// Create a new PDO instance
			try {
				$this->DBH = new PDO($dsn, $this->user, $this->pass, $options);
			} catch (PDOException $e) {
				$this->error = $e->getMessage();
			}
		}
		// Set and prepare the query
		public function query($query) {
			$this->STH = $this->DBH->prepare($query);
		}
		// Set query params
		public function bind($param, $value, $type = null) {
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
						break;
				}
			}
			// Bind value
			$this->STH->bindValue($param, $value, $type);
		}
		// Execute the query
		public function execute() {
			return $this->STH->execute();
		}
		// Return all result
		public function resultset() {
			$this->execute();
			return $this->STH->fetchAll(PDO::FETCH_ASSOC);
		}
		// Return a single result
		public function single()
		{
			$this->execute();
			return $this->STH->fetch(PDO::FETCH_ASSOC);
		}
		// Return the row count
		public function rowCount()
		{
			return $this->STH->rowCount();
		}
		// Return the last insert id
		public function lastInsertId()
		{
			return $this->DBH->lastInsertId();
		}
		// Begin transaction
		public function beginTransaction()
		{
			return $this->DBH->beginTransaction();
		}
		// Commit transaction
		public function endTransaction()
		{
			return $this->DBH->commit();
		}
		// Cancel transaction
		public function cancelTransaction()
		{
			return $this->DBH->rollBack();
		}
		// Debug params
		public function debugDumpParams()
		{
			return $this->STH->debugDumpParams();
		}
	}
?>