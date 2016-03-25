<?php

require_once "app/controllers/Operations.php";

class CoursesController {
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
                case ACTION_GET_COURSES :
                    $this->getCourses();
                    break;
                case ACTION_GET_COURSE_BY_ID :
                    $string = $parameters["CourseIdString"];
                    $this->getCourseById($string);
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

    private function getCourses(){

        $data = $this->model->getCourses();

        if(count($data) == 0)
            $this->prepareResponse(null, null);
        else {

            $this->prepareResponse(1, $data);
        }
    }


    private function getCourseById($string){

        if(is_numeric($string)) {
            $data = $this->model->getCourseById($string);
            if(count($data) == 0)
                $this->prepareResponse(null, null);
            else {
                $this->prepareResponse(1, $data);
            }
        }
        else
            $this->prepareResponse(null, null);
    }

}
?>