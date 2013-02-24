<?php

class StoreAnswers extends MongoConnection {
	public $id = "";
	public $storedAnswers = null;

	public function setStoredAnswers($storedAnswers) {
		$res = $this->getDB()->storedanswers->update( array( "storedanswerid" => $this->getId()), array( "storedanswerid" => $this->getId(), "answers" => $storedAnswers), array( "upsert" => true));
		$this->storedAnswers = $storedAnswers;
	}

	public function getStoredAnswers() {
		if(is_null($this->storedAnswers) || empty($this->storedAnswers)) {
			$res = $this->getDB()->storedanswers->findOne( array( "storedanswerid" => $this->getId(), "answers" => array( "\$exists" => true)));
			$this->storedAnswers = $res['answers'];
		}

		return $this->storedAnswers;
	}

	private function generateUniqueId() {
		$this->setId(md5(time()));
	}

	private function setId($id) {
		$this->id = $id;
	}

	private function getId() {
		if($this->id == "") {
			$this->generateUniqueID();
		}
		return $this->id;
	}
}

?>
