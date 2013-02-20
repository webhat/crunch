<?php

class Answer extends Question {
	public $id;
	public $answer;

	public function __construct( $id, $answer) {
		$this->setId($id);
		$this->setAnswer($answer);
	}

	public function setAnswer( $answer) {
		$this->answer = $answer;
	}

	public function getAnswer() {
		return $this->answer;
	}

	public function setId( $id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}
}

?>
