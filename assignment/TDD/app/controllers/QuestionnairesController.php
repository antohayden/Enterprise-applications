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
                case ACTION_GET_QUESTIONNAIRES_BY_TASKID :
                    $string = $parameters ["TaskIDString"];
                    $this->getQuestionnairesByTaskId($string);
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

        $mwl = $this->model->getMWL(null);
        $rmse = $this->model->getRMSE(null);
        $num = count($mwl);

        if($num == 0)
            $this->prepareResponse(null, null);
        else {
            $avgMWL = $this->operations->calculateMean($mwl);
            $avgRMSE = $this->operations->calculateMean($rmse);

            $MWLStdDev = $this->operations->calculateStandardDeviation($mwl);
            $RMSEStdDev = $this->operations->calculateStandardDeviation($rmse);

            $NumResponse = array('NumQuestionnaires' => $num);
            $MWLResponse = array('MWLStdDev' => $MWLStdDev, 'MWLAverage' => $avgMWL);
            $RMSEresponse = array('RMSEStdDev' => $RMSEStdDev, 'RMSEAverage' => $avgRMSE);

            $response = array_merge($NumResponse, $MWLResponse, $RMSEresponse);

            $this->prepareResponse($mwl, $response);
        }
    }

    private function getQuestionnairesByTaskId($taskId){

        if(!is_numeric($taskId)) {
            $this->prepareResponse("BAD_REQUEST", null);
            return;
        }

        $mwl = $this->model->getMWL($taskId);
        $rmse = $this->model->getRMSE($taskId);
        $intrusiveness = $this->model->getIntrusiveness($taskId);

        $num = count($mwl);

        if($num == 0)
            $this->prepareResponse(null, null);
        else {
            $MWLStdDev = $this->operations->calculateStandardDeviation($mwl);
            $avgMWL = $this->operations->calculateMean($mwl);

            $RMSEStdDev = $this->operations->calculateStandardDeviation($rmse);
            $avgRMSE = $this->operations->calculateMean($rmse);

            $IntStdDev = $this->operations->calculateStandardDeviation($intrusiveness);
            $avgInt = $this->operations->calculateMean($intrusiveness);

            $MWLResponse = array('MWLStdDev' => $MWLStdDev, 'MWLAverage' => $avgMWL);
            $RMSEResponse = array('RMSEStdDev' => $RMSEStdDev, 'RMSEAverage' => $avgRMSE);
            $IntResponse = array('IntrusivenessStdDev' => $IntStdDev, 'IntrusivenessAverage' => $avgInt);

            $response = array_merge($MWLResponse, $RMSEResponse, $IntResponse);

            $this->prepareResponse($mwl, $response);
        }
    }

}
?>