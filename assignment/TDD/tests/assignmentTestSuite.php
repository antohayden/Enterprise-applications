<?php
require_once("../simpletest/autorun.php");
class assignmentTestSuite extends TestSuite {
    function __construct() {
        parent::__construct ();

        $this->addFile ( "operationsTest.php" );
    }
}

?>
