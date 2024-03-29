<?php
class View
{
	private $model, $controller, $app;

	public function __construct($controller, $model, $app) {
		$this->controller = $controller;
		$this->model = $model;
		$this->app = $app;
	}

	public function output(){

        $AcceptHeaderValue = $this->app->request->headers['Accept'];
        $ContentTypeHeaderValue = $this->app->request->headers['Content-Type'];

        if ( $AcceptHeaderValue == 'application/xml' || $ContentTypeHeaderValue == 'application/xml') {
            $this->XMLResponse($this->model->apiResponse);
        }
        else if ($AcceptHeaderValue == 'application/json' || $ContentTypeHeaderValue == 'application/json') {
            $this->JSONResponse($this->model->apiResponse);
        }
        else
            $this->JSONResponse($this->model->apiResponse);
	}

    private function JSONResponse(array $apiResponse){

        $jsonBody = json_encode($apiResponse);

        $response = $this->app->response();

        $response->header('Content-type', 'application/json');
        $response->write($jsonBody);
    }

    private function XMLResponse(array $apiResponse){

        $xml = new SimpleXMLElement('<root/>');
        $this->to_xml($xml, $apiResponse);
        $response = $this->app->response();

        $response->header('Content-type', 'application/xml');
        $response->write($xml->asXML());
    }

    //http://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
    private function to_xml(SimpleXMLElement $object, array $data)
    {
        foreach ($data as $key => $value)
        {
            if (is_array($value))
            {
                $new_object = $object->addChild($key);
                $this->to_xml($new_object, $value);
            }
            else
            {
                $object->addChild($key, $value);
            }
        }
    }
}
?>