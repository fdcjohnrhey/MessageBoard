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

	public $useTable = 'messagelist';

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
