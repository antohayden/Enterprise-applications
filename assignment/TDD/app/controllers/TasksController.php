<?php

require_once "app/controllers/Operations.php";

class TasksController {
    private $slimApp;
    private $model;
    private $requestBody;
    private $operations;

    public function __construct($model, $action = null, $slimApp, $parameters = null) {
        $this->model = $model;
        $this->slimApp = $slimApp;
        $this->requestBody = json_decode($this->slimApp->request->getBody(), true);		//this must contain the representation of the new user
        $this->operations = new Operations();

        if ($action != null) {
            switch ($action) {
                case ACTION_GET_TASKS :
                    $this->getTasks();
                    break;
                case ACTION_GET_TASK_BY_ID :
                    $string = $parameters["TaskIdString"];
                    $this->getTaskById($string);
                    break;
                case ACTION_GET_TASKS_BY_COURSE_ID :
                    $string = $parameters["CourseIdString"];
                    $this->getTasksByCourseId($string);
                    break;
                default:
            }
        }
    }

    private function prepareResponse($arr, $response){

        if ($arr != null) {
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

    private function getTasks(){

        $data = $this->model->getTasks();

        if(count($data) == 0)
            $this->prepareResponse(null, null);
        else {

            $this->prepareResponse(1, $data);
        }
    }


    private function getTaskById($string){

        if(is_numeric($string)) {
            $data = $this->model->getTaskById($string);
            if(count($data) == 0)
                $this->prepareResponse(null, null);
            else {
                $this->prepareResponse(1, $data);
            }
        }
        else
            $this->prepareResponse(null, null);
    }


    private function getTasksByCourseId($string)
    {

        if (is_numeric($string)) {
            $data = $this->model->getTasksByCourseId($string);
            if (count($data) == 0)
                $this->prepareResponse(null, null);
            else {
                $this->prepareResponse(1, $data);
            }
        } else
            $this->prepareResponse(null, null);
    }

}
?>