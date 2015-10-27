<?php
require_once "app/DB/pdoDbManager.php";
require_once "app/DB/DAO/QuestionnairesDAO.php";

class QuestionnairesModel {
    private $QuestionnaireDAO; 		// list of DAOs used by this model
    private $dbmanager;		// dbmanager
    public $apiResponse; 	// api response

    public function __construct() {
        $this->dbmanager = new pdoDbManager ();
        $this->QuestionnaireDAO = new QuestionnaireDAO ($this->dbmanager);
        $this->dbmanager->openConnection();
    }

    public function getQuestionnaires($taskId){
        return ($this->QuestionnaireDAO->getQuestionnaires($taskId));
    }

    public function getMWL($taskId) {
        return ($this->QuestionnaireDAO->getMWL ($taskId));
    }

    public function getRMSE($taskId) {
        return ($this->QuestionnaireDAO->getRSME($taskId));
    }

    public function getIntrusiveness($taskId){
        return ($this->QuestionnaireDAO->getIntrusiveness($taskId));
    }



    public function __destruct() {
        $this->QuestionnaireDAO = null;
        $this->dbmanager->closeConnection();
    }
}
?>