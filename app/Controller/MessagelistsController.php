<?php
App::uses('AppController', 'Controller');
/**
 * Messagelists Controller
 *
 * @property Messagelist $Messagelist
 * @property PaginatorComponent $Paginator
 */
class MessagelistsController extends AppController {

	public $uses = array('User','Messagelist');
	public $components = array('Paginator','Flash');

	public function index($id) {
		$this->Messagelist->recursive = 0;
		$db = $this->Messagelist->getDataSource();
		$subQuery = $db->buildStatement(
		    array(
		        'table'      => $db->fullTableName($this->Messagelist),
		        'alias'		 => 'Messagelist',
		        'conditions' => array('to_id' => $id,),
		        'group'      => array('to_id','from_id'),
		        'fields' 	 => array('Max(Messagelist.id)'),
		    ),
		    $this->Messagelist
		);

		$subQuery = 'Messagelist.id IN (' . $subQuery . ') order by Messagelist.id DESC ';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$list = $this->Messagelist->find('all', compact('conditions'));

		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email')),
			'fields' => array('User.id')
		));

		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
		$this->set(array('users'=>$users, 'list'=>$list, 'currentUser'=>$currentUser));
	}


	public function view($to_id) {
		
		$options = array(
			'conditions' => array('OR'=>array('to_id' => $to_id,'user_id' => $to_id)),
			'fields' => array('User.Name','Message.content','Message.created','Message.modified','Messagelist.*'),		
			'order' => 'id DESC',
			'limit' => 10
		);
		$this->paginate = $options;
		$messageList = $this->paginate('Messagelist');
		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email')),
			'fields' => array('User.id')
		));
		if($to_id == $currentUser['User']['id']){
			$getLast = $this->Messagelist->find('first',array('order' => array('Messagelist.id' => 'DESC')));
			$convo=$getLast['Messagelist']['from_id'];
		}else{
			$convo=$to_id;
		}
		$convoWith = $this->User->find('first',array('conditions'=> 'id ='.$convo));
		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
		$this->set(compact('messageList','currentUser','convoWith','users','convo'));
		$view = new View($this, false);
		$view->viewPath = 'Elements';
		$view->render('messagebody');
		$view->set(compact('messageList'));
	}


	public function delete($id) {
		$this->Messagelist->id = $id;
		if (!$this->Messagelist->exists()) {
			throw new NotFoundException(__('Invalid messagelist'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Messagelist->delete()) {
			$this->Flash->success(__('The messagelist has been deleted.'));
		} else {
			$this->Flash->error(__('The messagelist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function getMessagelist(){

    	$this->autoRender=false;
		$this->layout = null ;
		$options = array(
			'conditions' => array('OR'=>array('to_id' => $this->request->data['to_id'],'from_id' => $this->request->data['to_id'])),
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
