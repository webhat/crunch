<?php

class Questions extends MongoConnection {
	private $questions = array();

	public function getQuestions( $qg = "") {
		if( empty($this->questions)) {
			$res = $this->getDB()->questions->find( array( "questiongroup" => $qg)); 
			foreach( $res as $r) {
				$this->questions[] = new Question( $r['questionid'], $r['questiontext'], $r['questiongroup']); 
			}
		}
		return $this->questions;
	}
}

?>
