<?php
App::uses('Messagelist', 'Model');

/**
 * Messagelist Test Case
 */
class MessagelistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.messagelist',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Messagelist = ClassRegistry::init('Messagelist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Messagelist);

		parent::tearDown();
	}

}
