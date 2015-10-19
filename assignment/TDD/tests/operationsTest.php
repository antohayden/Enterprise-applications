<?php

require_once("../simpletest/autorun.php");
include_once("../app/controllers/Operations.php");

class operationsTest extends UnitTestCase
{

    private $operations;
    private $arr1 = array("age" => 1);
    private $arr2 = array("age" => 2);

    public function setUp()
    {
        $this->operations = new Operations();
    }

    public function tearDown()
    {

        $this->operations = null;
    }

    public function testStandardDeviation(){

        $arr = array($this->arr1, $this->arr1, $this->arr2, $this->arr2);
        $ans = $this->operations->calculateStandardDeviation($arr);
        $this->assertTrue($ans == 0.5);
    }

    public function testCalculateMean(){

        $arr = array($this->arr1, $this->arr1, $this->arr2, $this->arr2);
        $ans = $this->operations->calculateMean($arr);
        $this->assertTrue($ans == 1.5);
    }

    public function testCalculateVariance(){

        $arr = array($this->arr1, $this->arr1, $this->arr2, $this->arr2);
        $ans = $this->operations->calculateVariance($arr);
        $this->assertTrue($ans == 0.25);
    }

}
?>