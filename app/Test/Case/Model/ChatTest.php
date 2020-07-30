<?php
App::uses('Chat', 'Model');

/**
 * Chat Test Case
 */
class ChatTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.chat',
		'app.messagelist',
		'app.user',
		'app.message'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Chat = ClassRegistry::init('Chat');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Chat);

		parent::tearDown();
	}

}
