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
				case ACTION_GET_STUDENTS_AGES :
					$this->getStudentsAges(null);
					break;
                case ACTION_GET_STUDENTS_AGES_BY_NATIONALITY :
                    $string = $parameters ["NationalityString"];
                    $this->getStudentsAges($string);
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

	private function getStudentsAges($nationality) {

        $data = $this->model->getStudentsAges($nationality);

        if(count($data) == 0)
            $this->prepareResponse(null, null);
        else {
            $avgAge = $this->operations->calculateMean($data);
            $stdDev = $this->operations->calculateStandardDeviation($data);

            $response = array('StdDev' => $stdDev, 'AvgAge' => $avgAge);

            $this->prepareResponse($data, $response);
        }
	}

}
?>