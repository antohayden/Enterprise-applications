<?php

class TasksDAO {

    private $dbManager;

    function TasksDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getTasks() {

        $sql = "SELECT * ";
        $sql .= "FROM tasks ";

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getTaskById($string) {

        $sql = "SELECT * ";
        $sql .= "FROM tasks ";
        $sql .= "WHERE TASK_ID = ";
        $sql .= $string;

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getTasksByCourseId($string) {

        $sql = "SELECT * ";
        $sql .= "FROM tasks ";
        $sql .= "WHERE COURSE_ID = ";
        $sql .= $string;

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }
}
?>
