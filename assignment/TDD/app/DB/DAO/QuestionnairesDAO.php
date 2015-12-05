<?php

class QuestionnaireDAO {

    private $dbManager;

    function QuestionnaireDAO($DBMngr) {
        $this->dbManager = $DBMngr;
    }

    public function getQuestionnaires($task_number){

        $sql = "SELECT * ";
        $sql .= "FROM questionnaire ";

        if ($task_number) {
            $sql .= "WHERE task_number = ";
            $sql .=  $task_number;
        }

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getTaskIdOfQuestionnaires(){

        $sql = "SELECT task_number , count(*) as count ";
        $sql .= "FROM questionnaire ";
        $sql .= "group by task_number";

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getQuestionnaireById($id){

        $sql = "SELECT * ";
        $sql .= "FROM questionnaire ";

        if ($id) {
            $sql .= "WHERE id = ";
            $sql .=  $id;
        }

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
    }

    public function getQuestionnaireByStudentId($id){

        $sql = "SELECT * ";
        $sql .= "FROM questionnaire ";

        if ($id) {
            $sql .= "WHERE student_number = '";
            $sql .=  $id;
            $sql .=  "'";
        }

        $stmt = $this->dbManager->prepareQuery ( $sql );
        $this->dbManager->executeQuery ( $stmt );
        $rows = $this->dbManager->fetchResults ( $stmt );

        return ($rows);
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
