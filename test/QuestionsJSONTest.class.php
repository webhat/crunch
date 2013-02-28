<?php

// XXX: Dirty Hack

class QuestionsJSONTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
	}

	public function tearDown() {
	}

	public function testHelloWorld() {
		$phpunit = true;
		$_GET['id'] = "assignmentoracle";
		require('src/php/questions.json.php');
		$json = json_encode($output);

		$this->assertFalse(!$json);

		$val = json_decode($json);

		$this->assertEquals($val[0]->questiontext, 'Sir, are you a Klingon?');
		$this->assertEquals($val[0]->id, 'A');
	}
}
 
?>
