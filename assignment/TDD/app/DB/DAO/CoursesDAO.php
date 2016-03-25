<?php

class CoursesDAO {

    private $dbManager;

    function CoursesDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getCourses() {

        $sql = "SELECT * ";
        $sql .= "FROM COURSES ";

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getCourseById($string) {

        $sql = "SELECT * ";
        $sql .= "FROM COURSES ";
        $sql .= "WHERE ID_COURSE = ";
        $sql .= $string;

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }
}
?>
