<?php

class Questions extends MongoConnection {
	private $questions = array();

	public function getQuestions( $qg = "") {
		if( empty($this->questions)) {
			$res = $this->getDB()->questions->find( array( "questiongroup" => $qg)); 
			foreach( $res as $r) {
				$question = new Question( $r['questionid'], $r['questiontext'], $r['questiongroup']); 
				if(array_key_exists( 'answers', $r))
					$question->setAnswers($r['answers']);
				$this->questions[] = $question;
			}
		}
		return $this->questions;
	}
}

?>
