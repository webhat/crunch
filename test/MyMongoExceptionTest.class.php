<?php

class MyMongoExceptionTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
	}

	public function tearDown() {
	}

	/**
	 * @expectedException MyMongoException 
	 */
	public function testMyMongoException () {
		throw new MyMongoException("MyMongoExceptionTest");
	}
}
 
?>
