<?php

class StudentsDAO {

    private $dbManager;

    function StudentsDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getAges($nationality) {
        $sql = "SELECT age ";
        $sql .= "FROM students ";

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

        return ($rows);
    }

}
?>
