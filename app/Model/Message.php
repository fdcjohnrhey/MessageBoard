<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property Messagelist $Messagelist
 */
class Message extends AppModel {

	public $validate = array(
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
	);

	public $hasMany = array(
		'Messagelist' => array(
			'className' => 'Messagelist',
			'foreignKey' => 'id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
