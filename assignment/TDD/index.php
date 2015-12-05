<?php
header('Access-Control-Allow-Origin: *');
require_once "Slim/Slim.php";
Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim (); // slim run-time object


require_once "app/conf/config.inc.php";

$app->map ( "/login", function () use($app) {

        $response = $app->response();
    try{
        $app->setEncryptedCookie('username', USERNAME, '2 days');
        $app->setEncryptedCookie('password', PASSWORD, '2 days');

        $response->status(HTTPSTATUS_OK);
        $response->write(GENERAL_SUCCESS_MESSAGE);

    }catch(Exception $e){

        $response->status(HTTPSTATUS_BADREQUEST);
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $response->write(GENERAL_ERROR_MESSAGE);
    }

} )->via ( "GET");

/*Get all students*/
$app->map ( "/statistics/students/", function () use($app) {

    $action = ACTION_GET_STUDENTS;
	return new loadRunMVCComponents ( "StudentsModel", "StudentsController", "View", $action, $app);
	
} )->via ( "GET");

/*Get Student by ID*/
$app->map ( "/statistics/students/:id", function ($studentNumber = null) use($app) {

    $parameters["StudentNumberString"] = $studentNumber;
    $action = ACTION_GET_STUDENT_BY_ID;
    return new loadRunMVCComponents ( "StudentsModel", "StudentsController", "View", $action, $app, $parameters);

} )->via ( "GET");

/*Get all student nationalities*/
$app->map ( "/statistics/students/nationality/", function () use($app) {

    $action = ACTION_GET_STUDENTS_NATIONALITY;
    return new loadRunMVCComponents ( "StudentsModel", "StudentsController", "View", $action, $app);

} )->via ( "GET");

/*Get all students of a specific nationality*/
$app->map ( "/statistics/students/nationality/:nationality", function ($nationality = null) use($app) {

    $parameters["NationalityString"] = $nationality;
    $action = ACTION_GET_STUDENTS_BY_NATIONALITY;

    return new loadRunMVCComponents ( "StudentsModel", "StudentsController", "View", $action, $app, $parameters);

} )->via ( "GET");

/*Get all tasks*/
$app->map ( "/statistics/tasks/", function () use($app) {

    $action = ACTION_GET_NUM_TASKS;

    return new loadRunMVCComponents ( "TasksModel", "TasksController", "View", $action, $app);

} )->via ( "GET");

/*Get all questionnaires*/
$app->map ( "/statistics/questionnaires/", function () use($app) {

    $action = ACTION_GET_QUESTIONNAIRES;

    return new loadRunMVCComponents ( "QuestionnairesModel", "QuestionnairesController", "View", $action, $app);

} )->via ( "GET");


/*Get the task id of all questionnaires*/
$app->map ( "/statistics/questionnaires/task/", function () use($app) {

    $action = ACTION_GET_TASK_ID_OF_QUESTIONNAIRES;

    return new loadRunMVCComponents ( "QuestionnairesModel", "QuestionnairesController", "View", $action, $app);

} )->via ( "GET");


/*Get all questionnaires by task id*/
$app->map ( "/statistics/questionnaires/task/:taskID", function ($taskID = null) use($app) {

    $parameters["TaskIDString"] = $taskID;
    $action = ACTION_GET_QUESTIONNAIRES_BY_TASK_ID;

    return new loadRunMVCComponents ( "QuestionnairesModel", "QuestionnairesController", "View", $action, $app, $parameters);

} )->via ( "GET");

/*Get questionnaire by questionnaire id*/
$app->map ( "/statistics/questionnaires/:questionID", function ($questionID = null) use($app) {

    $parameters["QuestionIDString"] = $questionID;
    $action = ACTION_GET_QUESTIONNAIRE_BY_ID;

    return new loadRunMVCComponents ( "QuestionnairesModel", "QuestionnairesController", "View", $action, $app, $parameters);

} )->via ( "GET");

/*Get questionnaires by Student id*/
$app->map ( "/statistics/questionnaires/student/:studentID", function ($studentID = null) use($app) {

    $parameters["StudentIDString"] = $studentID;
    $action = ACTION_GET_QUESTIONNAIRES_BY_STUDENT_ID;

    return new loadRunMVCComponents ( "QuestionnairesModel", "QuestionnairesController", "View", $action, $app, $parameters);

} )->via ( "GET");

$app->run ();


class loadRunMVCComponents {
	public $model, $controller, $view;
	public function __construct($modelName, $controllerName, $viewName, $action, $app, $parameters = null) {
		include_once "app/models/" . $modelName . ".php";
		include_once "app/controllers/" . $controllerName . ".php";
		include_once "app/views/" . $viewName . ".php";
		
		$this->model = new $modelName (); // common model
		$this->controller = new $controllerName ( $this->model, $action, $app, $parameters );
		$this->view = new $viewName ( $this->controller, $this->model, $app ); // common view
		$this->view->output (); // this returns the response to the requesting client
	}
}

?>