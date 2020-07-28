<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

	public $helpers = array('Js');
	public $components = array('Paginator','Flash','RequestHandler');
	public $uses = array('Message','User','Messagelist');

	public function index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

	public function view($id) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

	public function add() {
		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email')),
			'fields' => array('User.id')
		));
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->saveAssociated($this->request->data)) {
				$this->Messagelist->query("INSERT INTO messagelist (user_id,to_id,from_id,message_id) VALUES (".$currentUser['User']['id'].",
					".$this->request->data['Message']['to_id'].",".$currentUser['User']['id'].",".$this->Message->getInsertID().")");
					$this->Flash->success(__('The message has been saved.'));
					return $this->redirect(array('controller'=>'messagelists','action' => 'index',$currentUser['User']['id']));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}
		$users = $this->User->find('list');
		$this->set(compact('users','currentUser'));
	}

	public function getUsers(){

  		$this->autoRender=false;
		if($this->RequestHandler->isAjax()){
	    	Configure::write('debug', 0);
	  	}
	  	$keyword = $this->request->query('search');
		$users = $this->User->find('all', array(
			'conditions' => array("User.name LIKE" => "%$keyword%"),
			'fields' => array('User.id', 'User.name as text'),
			'group' => array('User.id ASC'),
			'limit' =>5
		));
		$list = array();
		foreach ($users as $key => $value) {
			array_push($list,$value['User']);
		}
			
    	return json_encode($list);	
	}

	public function AddNewMessage(){

  		$this->autoRender=false;
		$this->layout = null ;
		if($this->RequestHandler->isAjax()){
	    	Configure::write('debug', 0);
	  	}

	  	$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email')),
			'fields' => array('User.id')
		));

	  	$this->Message->create();
		if ($this->Message->saveAssociated($this->request->data)) {
			$this->Messagelist->query("INSERT INTO messagelist (user_id,to_id,from_id,message_id) VALUES (".$currentUser['User']['id'].",
				".$this->request->data['to_id'].",".$currentUser['User']['id'].",".$this->Message->getInsertID().")");
			
		} else {
			$this->Flash->error(__('The message could not be saved. Please, try again.'));
		}		

		$options = array(
			'conditions' => array('to_id' => $this->request->data['to_id']),
			'fields' => array('User.Name','Message.content','Message.created','Message.modified','Messagelist.*'),		
			'order' => 'id DESC',
			'limit' => $this->request->data['limit']
		);

		$this->paginate = $options;
		$messageList = $this->Messagelist->find('all',$options);
		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
    	$view = new View($this, false);
		$view->viewPath = 'Elements';
		$view->set(compact('messageList','users'));		
		
		return json_encode($view->render('messagebody'));
	}
}
