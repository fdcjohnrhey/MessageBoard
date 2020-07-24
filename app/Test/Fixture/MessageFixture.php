<?php
/**
 * Message Fixture
 */
class MessageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'to_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'from_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'content' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'to_id' => 1,
			'from_id' => 1,
			'content' => 'Lorem ipsum dolor sit amet',
			'created' => '2020-07-23 10:03:44',
			'modified' => '2020-07-23 10:03:44'
		),
	);

}
