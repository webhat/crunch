<?php

class AnswerSieve extends MongoConnection {

	private $questiongroup;
	private $answerid;

	public function __construct( $questiongroup, $answerid) {
		parent::__construct();

		$this->setQuestionGroup( $questiongroup);
		$this->setAnswerId( $answerid);
	}

	public function getAnswerSieveFor( $questiongroup, $answerid) {
		$res = $this->getDB()->answersieve->findOne( array( "questionid" => $answerid, "answersieve" => array( "\$exists" => true)));
		return $res['answersieve'];
	}

	public function getAnswerSieve() {
		$res = $this->getDB()->answersieve->findOne( array( "questionid" => $this->getAnswerId(), "answersieve" => array( "\$exists" => true)));
		return $res['answersieve'];
	}

	public function setAnswerSieve( $answersieve) {
		$res = $this->getDB()->answersieve->update( array( "questionid" => $this->getAnswerId()), array( "questionid" => $this->getAnswerId(), "answersieve" => $answersieve), array( "upsert" => true));
	}

	public function getQuestionGroup() {
		return $this->questiongroup;
	}

	public function getAnswerId() {
		return $this->answerid;
	}

	public function setQuestionGroup($qg) {
		$this->questiongroup = $qg;
	}

	public function setAnswerId($id) {
		$this->answerid = $id;
	}
}

?>
