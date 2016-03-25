<?php
require_once "app/DB/pdoDbManager.php";
require_once "app/DB/DAO/TasksDAO.php";

class TasksModel {
    private $TasksDAO; 		// list of DAOs used by this model
    private $dbmanager;		// dbmanager
    public $apiResponse; 	// api response

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->TasksDAO = new TasksDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
    }

    public function getTasks() {
        return ($this->TasksDAO->getTasks());
    }

    public function getTaskById($string){
        return ($this->TasksDAO->getTaskById($string));
    }

    public function getTasksByCourseId($string){
        return ($this->TasksDAO->getTasksByCourseId($string));
    }

    public function __destruct() {
        $this->TasksDAO = null;
        $this->dbmanager->closeConnection();
    }
}
?>