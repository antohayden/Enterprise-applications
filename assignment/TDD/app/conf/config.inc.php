<?php
/* database constants */
define("DB_HOST", "localhost" ); 		// set database host
define("DB_USER", "root" ); 			// set database user
define("DB_PASS", "root" ); 				// set database password
define("DB_PORT", 3306);				// set database port
define("DB_NAME", "enterpriseappdev" ); 			// set database name
define("DB_CHARSET", "utf8" ); 			// set database charset
define("DB_DEBUGMODE", true ); 			// set database charset

define("USERNAME", "username");
define("PASSWORD", "password");

/* actions for the USERS REST resource */
define("ACTION_LOGIN", 11);
define("ACTION_GET_STUDENTS_AGES", 43);
define("ACTION_GET_STUDENTS_AGES_BY_NATIONALITY", 44);
define("ACTION_GET_NUM_TASKS", 51);
define("ACTION_GET_QUESTIONNAIRES", 61);
define("ACTION_GET_QUESTIONNAIRES_BY_TASKID", 62);

/* HTTP status codes 2xx*/
define("HTTPSTATUS_OK", 200);
define("HTTPSTATUS_NOCONTENT", 204);


/* HTTP status codes 4xx */
define("HTTPSTATUS_BADREQUEST", 400);
define("HTTPSTATUS_UNAUTHORIZED", 401);
define("HTTPSTATUS_FORBIDDEN", 403);
define("HTTPSTATUS_NOTFOUND", 404);

/* HTTP status codes 5xx */
define("HTTPSTATUS_INTSERVERERR", 500);

define("TIMEOUT_PERIOD", 120);

/* general message */
define("GENERAL_MESSAGE_LABEL", "message");
define("GENERAL_SUCCESS_MESSAGE", "success");
define("GENERAL_ERROR_MESSAGE", "error");
define("GENERAL_CONTENT_AUTHORIZATION_ERROR", "Authorization required to view content");
define("GENERAL_NOCONTENT_MESSAGE", "no-content");
define("GENERAL_CLIENT_ERROR", "client error: modify the request");


?>