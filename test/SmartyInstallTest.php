<?php

class SmartyInstallTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
	}

	public function tearDown() {
	}

	public function testSmarty() {
		$smarty = new Smarty();
		$this->assertNotNull($smarty);
	}
}
 
?>
