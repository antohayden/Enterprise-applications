<?php
require_once "app/DB/pdoDbManager.php";
require_once "app/DB/DAO/CoursesDAO.php";

class CoursesModel {
    private $CoursesDAO; 		// list of DAOs used by this model
    private $dbmanager;		// dbmanager
    public $apiResponse; 	// api response

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->CoursesDAO = new CoursesDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
    }

    public function getCourses() {
        return ($this->CoursesDAO->getCourses());
    }

    public function getCourseById($string){
        return ($this->CoursesDAO->getCourseById($string));
    }

    public function __destruct() {
        $this->CourseDAO = null;
        $this->dbmanager->closeConnection();
    }
}
?>