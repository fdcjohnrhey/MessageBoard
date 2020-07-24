<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property Messagelist $Messagelist
 */
class Message extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
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
