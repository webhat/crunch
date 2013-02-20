<?php

class MongoConnection {
	protected $db = null;
	public $mongo = null;

	public function __construct( $user = null) {
		try {
			$this->mongo = new Mongo(); // connect
		} catch (Exception $e) {
			print("ERROR: Database unreachable");
			exit(-1);
		}
		$config = new Config();
		$this->db = $this->mongo->selectDB($config->wtdatabase);
	}

	public function setDB( $dbname) {
		$this->db = $this->mongo->selectDB( $dbname);
	}

	public function getDB() {
		return $this->db;
	}
}
?>
