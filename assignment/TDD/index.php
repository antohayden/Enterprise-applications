<?php
require_once "Slim/Slim.php";
Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim (); // slim run-time object
                          
require_once "app/conf/config.inc.php";

function authenticate(\Slim\Route $route){

    $app = \Slim\Slim::getInstance();

    $uid = $app->getEncryptedCookie('username');
    $pw = $app->getEncryptedCookie('password');

    if(validateUser($uid, $pw))
        return true;

    $app->halt(HTTPSTATUS_UNAUTHORIZED, GENERAL_CONTENT_AUTHORIZATION_ERROR);
}

function validateUser($uid, $pw){

    if($uid == USERNAME && $pw == PASSWORD)
        return true;
    else
        return false;

}

$app->map ( "/login", function () use($app) {

        $response = $app->response();
    try{
        $app->setEncryptedCookie('username', USERNAME, '10 minutes');
        $app->setEncryptedCookie('password', PASSWORD, '10 minutes');

        $response->status(HTTPSTATUS_OK);
        $response->write(GENERAL_SUCCESS_MESSAGE);

    }catch(Exception $e){

        $response->status(HTTPSTATUS_BADREQUEST);
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $response->write(GENERAL_ERROR_MESSAGE);
    }

} )->via ( "GET");


$app->map ( "/statistics/students", "authenticate", function () use($app) {

    $action = ACTION_GET_STUDENTS_AGES;
	return new loadRunMVCComponents ( "StudentsModel", "StudentsController", "View", $action, $app);
	
} )->via ( "GET");

$app->map ( "/statistics/students/:nationality", "authenticate", function ($nationality = null) use($app) {

    $parameters["NationalityString"] = $nationality;
    $action = ACTION_GET_STUDENTS_AGES_BY_NATIONALITY;

    return new loadRunMVCComponents ( "StudentsModel", "StudentsController", "View", $action, $app, $parameters);

} )->via ( "GET");
$app->map ( "/statistics/tasks", "authenticate", function () use($app) {

    $action = ACTION_GET_NUM_TASKS;

    return new loadRunMVCComponents ( "TasksModel", "TasksController", "View", $action, $app);

} )->via ( "GET");

$app->map ( "/statistics/questionnaires", "authenticate", function () use($app) {

    $action = ACTION_GET_QUESTIONNAIRES;

    return new loadRunMVCComponents ( "QuestionnairesModel", "QuestionnairesController", "View", $action, $app);

} )->via ( "GET");

$app->map ( "/statistics/questionnaires/:taskID", "authenticate", function ($taskID = null) use($app) {

    $parameters["TaskIDString"] = $taskID;
    $action = ACTION_GET_QUESTIONNAIRES_BY_TASKID;

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