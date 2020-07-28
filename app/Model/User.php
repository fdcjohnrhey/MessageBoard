<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

	public $validate = array(
		'name' => array(			
			'lengthBetween' => array(
				'rule' => array('lengthBetween',5,20),
				'message' => 'Please enter 5-20 characters.',				
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter name.',
			),
		),
		'email' => array(			
			'notBlank' => array(
				'rule' => array('notBlank'),
	            'message' => 'Please provide an email.'
			),
			'required' => array(
	            'rule' => array('email'),
	            'message' => 'Please enter a valid email.'
	        ),
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
