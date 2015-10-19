<?php
require_once "app/DB/pdoDbManager.php";
require_once "app/DB/DAO/StudentsDAO.php";

class StudentsModel {
    private $StudentsDAO; 		// list of DAOs used by this model
    private $dbmanager;		// dbmanager
    public $apiResponse; 	// api response

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->StudentsDAO = new StudentsDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
    }

    public function getStudentsAges($nationality) {
        return ($this->StudentsDAO->getAges ($nationality));
    }

    public function __destruct() {
        $this->StudentsDAO = null;
        $this->dbmanager->closeConnection();
    }
}
?>