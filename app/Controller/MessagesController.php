<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $helpers = array('Js');
	public $components = array('Paginator','Flash','RequestHandler');
	public $uses = array('Message','User','Messagelist');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$users = $this->Message->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete()) {
			$this->Flash->success(__('The message has been deleted.'));
		} else {
			$this->Flash->error(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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
				".$this->request->data['Message']['to_id'].",".$currentUser['User']['id'].",".$this->Message->getInsertID().")");
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
				return json_encode('The message has been saved');	
		} else {
			$this->Flash->error(__('The message could not be saved. Please, try again.'));
		}
		return(json_encode($this->request->data));
			
        
	}
}
