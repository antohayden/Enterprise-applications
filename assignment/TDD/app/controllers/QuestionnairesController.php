<?php

require_once "app/controllers/Operations.php";

class QuestionnairesController {
    private $slimApp;
    private $model;
    private $operations;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;
        $this->operations = new Operations();

        if ($action != null) {
            switch ($action) {
                case ACTION_GET_QUESTIONNAIRES :
                    $this->getQuestionnaires();
                    break;
                case ACTION_GET_QUESTIONNAIRES_BY_TASK_ID :
                    $string = $parameters ["TaskIDString"];
                    $this->getQuestionnairesByTaskId($string);
                    break;
                case ACTION_GET_TASK_ID_OF_QUESTIONNAIRES :
                    $this->getTaskIdOfQuestionnaires();
                    break;
                case ACTION_GET_QUESTIONNAIRE_BY_ID :
                    $string = $parameters ["QuestionIDString"];
                    $this->getQuestionnaireById($string);
                    break;
                default:
            }
        }
    }

    private function prepareResponse($arr, $response){

        if ($arr == "BAD_REQUEST"){
            $this->slimApp->response ()->setStatus ( HTTPSTATUS_BADREQUEST );
            $Message = array (
                GENERAL_MESSAGE_LABEL => GENERAL_CLIENT_ERROR
            );
            $this->model->apiResponse = $Message;
        }
        else if ($arr != null) {
            $this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
            $this->model->apiResponse = $response;

        } else {
            $this->slimApp->response ()->setStatus ( HTTPSTATUS_NOCONTENT );
            $Message = array (
                GENERAL_MESSAGE_LABEL => GENERAL_NOCONTENT_MESSAGE
            );
            $this->model->apiResponse = $Message;
        }
    }

    private function getQuestionnaires(){

        $questionnaires = $this->model->getQuestionnaires(null);
        $num = count($questionnaires);

        if ( $num == 0)
            $this->prepareResponse(null,null);
        else {
            $this->prepareResponse( 1 , $questionnaires);
        }
    }

    private function getTaskIdOfQuestionnaires(){

        $taskIds = $this->model->getTaskIdOfQuestionnaires();
        $num = count($taskIds);

        if ( $num == 0)
            $this->prepareResponse(null,null);
        else {
            $this->prepareResponse( 1 , $taskIds);
        }
    }

    private function getQuestionnairesByTaskId($taskId){

        if(!is_numeric($taskId)) {
            $this->prepareResponse("BAD_REQUEST", null);
            return;
        }

        $questionnaires = $this->model->getQuestionnaires($taskId);
        $num = count($questionnaires);

        if($num == 0)
            $this->prepareResponse(null, null);
        else {

            if ( $num == 0)
                $this->prepareResponse(null,null);
            else {
                $this->prepareResponse( 1 , $questionnaires);
            }
        }
    }


    private function getQuestionnaireById($id){

        if(!is_numeric($id)) {
            $this->prepareResponse("BAD_REQUEST", null);
            return;
        }

        $questionnaire = $this->model->getQuestionnaireById($id);
        $num = count($questionnaire);

        if($num == 0)
            $this->prepareResponse(null, null);
        else {

            if ( $num == 0)
                $this->prepareResponse(null,null);
            else {
                $this->prepareResponse( 1 , $questionnaire);
            }
        }
    }


}
?>