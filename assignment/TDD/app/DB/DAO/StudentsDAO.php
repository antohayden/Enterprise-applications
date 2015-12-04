<?php

class StudentsDAO {

    private $dbManager;

    function StudentsDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getStudents($id){

        $sql = "SELECT * FROM STUDENTS ";

        if($id){
            $sql .= "WHERE STUDENT_NUMBER = '";
            $sql .= $id;
            $sql .= "'";
        }
        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return $rows;
    }

    public function getStudentsNationality(){

        $sql = "SELECT id, description FROM NATIONALITIES ";
        $sql .= "WHERE id in ";
        $sql .= "( SELECT DISTINCT(id_nationality) FROM STUDENTS )";

        $stmt = $this->dbManager->prepareQuery( $sql );
        $this->dbManager->executeQuery( $stmt );
        $rows = $this->dbManager->fetchResults( $stmt );

        return $rows;
    }

    public function getStudentsByNationality($nationality) {

        $sql = "SELECT * FROM STUDENTS ";

        if($nationality){
            $sql .= "WHERE id_nationality in ";
            $sql .= "(SELECT id ";
            $sql .= "FROM nationalities ";
            $sql .= "WHERE description = '";
            $sql .= $nationality;
            $sql .= "' );";
        }

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return $rows;
    }

}
?>
