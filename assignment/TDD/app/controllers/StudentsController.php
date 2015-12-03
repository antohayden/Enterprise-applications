<?php

require_once "app/controllers/Operations.php";

class StudentsController {
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

                case ACTION_GET_STUDENTS :
                    $this->getStudents(null);
                    break;
                case ACTION_GET_STUDENT_BY_ID :
                    $string = $parameters["StudentNumberString"];
                    $this->getStudents($string);
                    break;
                case ACTION_GET_STUDENTS_NATIONALITY :
                    $this->getStudentsNationality();
                    break;
                case ACTION_GET_STUDENTS_BY_NATIONALITY :
                    $string = $parameters ["NationalityString"];
                    $this->getStudentsByNationality($string);
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

    private function getStudents($id){

        $data = $this->model->getStudents($id);

        if(count($data) == 0)
            $this->prepareResponse(null, null);
        else{
                $this->prepareResponse( 1 , $data);
        }
    }

    private function getStudentsNationality(){

        $data  = $this->model->getStudentsNationality();

        if(count($data) == 0)
            $this->prepareResponse(null, null);
        else{
            $this->prepareResponse( 1 , $data);
        }

    }

	private function getStudentsByNationality($nationality) {

        $data = $this->model->getStudentsByNationality($nationality);

        if(count($data) == 0)
            $this->prepareResponse(null, null);
        else{
            $this->prepareResponse( 1 , $data);
        }
	}

}
?>