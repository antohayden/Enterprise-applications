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

    public function  getStudents($id){
        return ($this->StudentsDAO->getStudents($id));
    }


    public function getStudentsByNationality($nationality) {
        return ($this->StudentsDAO->getStudentsByNationality($nationality));
    }

    public function getStudentsNationality(){
        return ($this->StudentsDAO->getStudentsNationality());
    }

    public function __destruct() {
        $this->StudentsDAO = null;
        $this->dbmanager->closeConnection();
    }
}
?>