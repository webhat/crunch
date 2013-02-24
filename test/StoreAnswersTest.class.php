<?php

class StoreAnswersTest extends PHPUnit_Framework_TestCase {
	public $storedanswers = null;

	public $dbname = "klingon";

	public function setUp() {
		$this->storedanswers = new StoreAnswers();
		$this->storedanswers->setDB($this->dbname);
	}

	public function tearDown() {
	}

	public function testSetStoreAnswers() {
		$expected = array("questionid" => "A", "answerid" => "A");
		$this->storedanswers->setStoredAnswers($expected);
		$actual = $this->storedanswers->getStoredAnswers();

		$this->assertEquals( $expected, $actual);
	}

	public function testGetStoreAnswers() {
		$expected = array("questionid" => "A", "answerid" => "A");
		$actual = $this->storedanswers->getStoredAnswers();
		var_export($actual);

		$this->assertEquals( $expected, $actual);
	}
}
 
?>
