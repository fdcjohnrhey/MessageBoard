<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('User');
	public $components = array('Paginator','Session','Flash','RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function beforeFilter(){
		// allow register page to be viewed without login
		$this->Auth->allow('add');
	}

	public function login(){
		if ($this->request->is('post')) {	
			if ($this->Auth->login($this->request->data['User'])) {
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Incorrect email/password.'));
			}
		}
		
	}

	public function logout(){		
		//get current user	
		$current_user=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email'))
		));
		//check if user found
		if($current_user) {
			//update last_login_time field to current time
			$this->User->id=$current_user['User']['id'];
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
		$current_user=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email'))
		));
		//check if user found
		if($current_user){
			$current_user=$current_user;
		}
		$this->set(array('users'=> $this->Paginator->paginate(),'current_user'=>$current_user));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			//save ip address
			$this->request->data['User']['created_ip']= $this->RequestHandler->getClientIp();			
			//save to database and redirect to confirm page
			if ($this->User->save($this->request->data)) {
			 	$this->Auth->login($this->request->data['User']);		
				return $this->redirect(array('action' => 'thankyou'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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

	public function thankyou() {
		$this->Flash->success(__('Thank you for registering.'));
	}

	public function profile($id = null) {
		$this->User->id = $id;
		$this->set('users', $this->Paginator->paginate());
	}

}
