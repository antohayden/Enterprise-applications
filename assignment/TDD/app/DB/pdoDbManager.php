<?php

class pdoDbManager{

	private $db_link;
	private $hostname = DB_HOST;
	private $username = DB_USER;
	private $password = DB_PASS;
	private $dbname = DB_NAME;
	private $charset = DB_CHARSET;
	private $debugMode = DB_DEBUGMODE;

	function __construct(){
	}

	function openConnection(){
		try {
			$connectionStr = "mysql:host=" . $this->hostname . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
			$this->db_link = new PDO($connectionStr, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}
		catch (PDOException $e) {
			if($this->debugMode){
				echo 'Connection failed: ' . $e->getMessage();
			}
			exit;
		}
	}

	function prepareQuery($query){
		$stmt = $this->db_link->prepare($query);
		return $stmt;
	}

	function executeQuery($stmt){
		$stmt->execute();
	}

	function fetchResults($stmt){
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return ($rows);
	}

	function closeConnection(){
		$this->db_link = null;
	}
}
?>
