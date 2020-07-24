<?php
App::uses('AppModel', 'Model');
/**
 * Messagelist Model
 *
 * @property User $User
 * @property Message $Message
 * @property To $To
 * @property From $From
 */
class Messagelist extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'messagelist';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'message_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'to_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'from_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
