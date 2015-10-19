<?php

class TasksDAO {

    private $dbManager;

    function TasksDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getTaskDurations() {

        $sql = "SELECT duration_mins ";
        $sql .= "FROM tasks ";

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

}
?>
