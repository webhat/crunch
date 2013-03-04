<?php

class Question extends MongoConnection {

	public $questiontext = "";
	public $questiongroup = "";
	public $questionid = "";

	public $answers = array();

	public function __construct( $questionid, $qt = "", $qg = "") {
		parent::__construct();
		$this->setId($questionid);
		$this->setQuestion($qt);
		$this->setQuestionGroup($qg);
	}

	public function getId() {
		return $this->questionid;
	}

	public function setId( $questionid) {
		$this->questionid = $questionid;
	}

	public function getQuestionGroup() {
		return $this->questiongroup;
	}

	public function setQuestionGroup( $qg) {
		$this->questiongroup = (string) $qg;
	}

	public function setQuestion( $qt) {
		$this->questiontext = (string) $qt;
	}

	public function updateQuestion( $qt) {
		if( empty($this->answers))
			$res = $this->getDB()->questions->update( array( "questionid" => $this->getId()), array( "questionid" => $this->getId(), "questiongroup" => $this->getQuestionGroup(), "questiontext" => $qt), array( "upsert" => true));
		else
			$res = $this->getDB()->questions->update( array( "questionid" => $this->getId()), array( "questionid" => $this->getId(), "questiongroup" => $this->getQuestionGroup(), "questiontext" => $qt, "answers" => $this->answers), array( "upsert" => true));

		$this->setQuestion($qt);
	}

	public function getQuestion() {
		if($this->questiontext == "") {
			$res = $this->getDB()->questions->findOne( array( "questionid" => $this->getId()));
			$this->setQuestion($res['questiontext']);
			$this->setQuestionGroup($res['questiongroup']);
		}
		return $this->questiontext;
	}

	public function setAnswers( $answers = array()) {
		if( empty($answers)) {
			throw new QuestionException("Error: No answers given");
		}
		$this->answers = array_merge( $this->answers, $answers);
	}

	public function getAnswers() {
		if(empty($this->answers)) {
			$res = $this->getDB()->questions->findOne( array( "questionid" => $this->getId(), "answers" => array( "\$exists" => true)));
			$this->answers = $res['answers'];
		}
		if(empty($this->answers)) {
			throw new QuestionException("Error: No answers found");
		}
		$answers = array();
		foreach( $this->answers as $answer) {
			$answers[] = new Answer( $answer['answerid'], $answer['answertext']);
		}
		return $answers;
	}
}

?>
