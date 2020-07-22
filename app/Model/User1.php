<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property  $
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(			
			'lengthBetween' => array(
				'rule' => array('lengthBetween',5,20),
				'message' => 'Please enter 5-20 characters.',				
			),
			'required' => true,
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email.',	
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
			'required' => true,
			'unique' => array(
	            'rule' => 'isUnique',
	            'message' => 'Provided Email already exists.'
	        )
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter a password.',
			),
			'Match Passwords' => array(
				'rule' => 'matchPasswords',
				'message' => 'Passwords do not match.',
			)
		),
		'confirm_password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter a password.',
			),
		),
	);

	public function matchPasswords($data){
		if($data['password'] == $this->data['User']['confirm_password']){
			return true;
		}
		$this->invalidate('confirm_password','Passwords do not match.');
		return false;
	}

	public function beforeSave($data= Array()){
		if(isset($this->data['User']['password'])){
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

}
