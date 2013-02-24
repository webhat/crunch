<?php

class QuestionsTest extends PHPUnit_Framework_TestCase {
	private $questions;
	private $question;
	private $questiontext;
	private $questiongroup = "assignmentoracle";
	private $sieve = "tlhIngan SoH";
	private $dbname = "klingon";

	public function setUp() {
		$this->questions = new Questions();
		$this->questions->setDB($this->dbname);


		$this->question = new Question("A");
		$this->question->setDB($this->dbname);


		$this->questiontext = "Sir, are you a Klingon?";
		$this->question->setQuestionGroup($this->questiongroup);
	}

	public function tearDown() {
//		$this->questions->getDB()->questions->drop(); 
//		$this->questions->getDB()->answersieve->drop(); 
	}

	public function testGetQuestions() {
		$this->question->updateQuestion($this->questiontext);

		$que = $this->questions->getQuestions($this->questiongroup);

		$expected = $this->questiontext;
		$actual = $que[0]->getQuestion();

		$this->assertNotNull($actual);
		$this->assertEquals( $expected, $actual);
	}

	public function testSetQuestion() {
		$expected = $this->questiontext;

		$this->question->setQuestion($this->questiontext);

		$actual = $this->question->getQuestion();

		$this->assertNotNull($actual);
		$this->assertEquals( $expected, $actual);
	}

	public function testGetQuestion() {
		$expected = $this->questiontext;

		$this->question->updateQuestion($this->questiontext);

		$actual = $this->question->getQuestion();

		$this->assertNotNull($actual);
		$this->assertEquals( $expected, $actual);
	}

	private $answers = array( 
			array( "answerid" => "A", "answertext" => "tlhIngan jIH"),
			array( "answerid" => "B", "answertext" => "No"),
			);
	public function testGetAnswers() {
		$this->question->setAnswers($this->answers);
		$this->question->updateQuestion($this->questiontext);

		$expected = $this->answers[0]['answertext'];

		$actual = $this->question->getAnswers();

		$this->assertNotNull($actual);
		$this->assertEquals( $expected, $actual[0]->getanswer());
	}

	/**
		* @expectedException QuestionException
		*/
	public function testSetAnswersNull() {
		$this->question->setAnswers();
	}

	public function testSetAnswers() {
		$this->question->setAnswers($this->answers);
		$this->question->updateQuestion($this->questiontext);
	}


	public function testGetAnswerSieve() {
		$this->answersieve = new AnswerSieve( $this->questiongroup, "A");
		$this->answersieve->setDB($this->dbname);

		$expected = array( "depends" => array( "A","B"),
				"A" => array( "A" => "One", "B" => "Two"),
				"B" => array( "A" => "Three", "B" => $this->sieve)
			);

		$this->answersieve->setAnswerSieve( $expected);

		$actual = $this->answersieve->getAnswerSieve();

		$this->assertNotNull($actual);
		$this->assertEquals( $expected, $actual);
		$this->assertEquals( $expected['B']['B'], $actual['B']['B']);
	}
}

?>
