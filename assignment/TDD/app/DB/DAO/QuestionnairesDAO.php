<?php

class QuestionnaireDAO {

    private $dbManager;

    function QuestionnaireDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getMWL($taskId) {

        $sql = "SELECT MWL_total ";
        $sql .= "FROM questionnaire ";

        if ($taskId) {
            $sql .= "WHERE task_number = ";
            $sql .=  $taskId;
        }

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getRSME($taskId) {

        $sql = "SELECT RSME ";
        $sql .= "FROM questionnaire ";

        if ($taskId) {
            $sql .= "WHERE task_number = ";
            $sql .= $taskId;
        }
        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getIntrusiveness($taskId){

        $sql = "SELECT Intrusiveness ";
        $sql .= "FROM questionnaire ";

        if ($taskId) {
            $sql .= "WHERE task_number = ";
            $sql .= $taskId;
        }

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);

    }

}
?>
