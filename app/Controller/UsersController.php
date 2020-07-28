<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $uses = array('User','Message');
	public $components = array('Paginator','Session','Flash','RequestHandler');

	public function beforeFilter(){
		// allow register page to be viewed without login
		$this->Auth->allow('add','login');
	}

	public function login(){
		if ($this->request->is('post')) {	
			//get current user	
			$loginDetails=$this->User->find('first',array(				
				'conditions' => array(
					'user.email' =>$this->request->data['User']['email'],
					'AND'=> array(
						'user.password'=>AuthComponent::password($this->data['User']['password'])
					)
				)
			));

			if($loginDetails){
				if ($this->Auth->login($this->request->data['User'])) {
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('Incorrect email/password.'));
				}
			}else{
				$this->Flash->error(__('Incorrect email/password.'));
			}
		}
		
	}

	public function logout(){		
		//get current user	
		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email'))
		));
		//check if user found
		if($currentUser) {
			//update last_login_time field to current time
			$this->User->id=$currentUser['User']['id'];
			$this->User->set('last_login_time',date("Y-m-d h:i:s"));
			//save to db and logout
			if($this->User->save()){
				$this->Auth->logout();
				return $this->redirect('/users/index');
			}else {
				$this->Flash->error(__('The date could not be saved. Please, try again.'));
			}			
		} else {
			$this->Flash->error(__('No users found.'));
		}
	}

	public function index() {
		$this->User->recursive = 0;		
		//get current user		
		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email'))
		));
		//check if user found
		if($currentUser){
			$currentUser=$currentUser;
		}
		$this->set(array('users'=> $this->Paginator->paginate(),'currentUser'=>$currentUser));
	}

	public function view($id) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			//save ip address
			$this->request->data['User']['created_ip']= $this->RequestHandler->getClientIp();			
			//save to database and redirect to confirm page
			if ($this->User->save($this->request->data)) {
			 	$this->Auth->login($this->request->data['User']);		
				return $this->redirect(array('action' => 'thankYou'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {			
			$this->User->id=$id;		
			$this->User->set('modified',date("Y-m-d h:i:s"));
			$this->request->data['User']['modified_ip']= $this->RequestHandler->getClientIp();		
			$file = $this->request->data['User']['image'];
			$currentUser=$this->User->find('first',array(				
				'conditions' => array('user.id' =>$id)
			));
			if($file['name']!=''){
				if (!file_exists($file)) {
				    move_uploaded_file($file['tmp_name'],WWW_ROOT.'img/'. $file['name']);	
				    $this->request->data['User']['image'] = $file['name'];
				}else{
					$this->Flash->error(__('This image already exists.'));
				}
			}else{
				$this->request->data['User']['image'] = $currentUser['User']['image'];
			}

			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
	
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function thankYou() {
		$this->Flash->success(__('Thank you for registering.'));
	}

	public function profile($id = null) {
		$this->User->id = $id;
		$this->set('users', $this->Paginator->paginate());
	}

}
