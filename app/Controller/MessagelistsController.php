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

	public function index($id = null) {
		$this->Messagelist->recursive = 0;
		$db = $this->Messagelist->getDataSource();
		$subQuery = $db->buildStatement(
		    array(
		        'table'      => $db->fullTableName($this->Messagelist),
		        'alias'		 => 'Messagelist',
		        'conditions' => array('user_id'=>$id),
		        'group'      => array('to_id'),
		        'fields' 	 => array('Max(Messagelist.id)'),
		    ),
		    $this->Messagelist
		);

		$subQuery = 'Messagelist.id IN (' . $subQuery . ') order by Messagelist.id DESC ';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$list = $this->Messagelist->find('all', compact('conditions'));
		$this->paginate('Messagelist',$conditions);

		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email')),
			'fields' => array('User.id')
		));

		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
		$this->set(array('users'=>$users, 'list'=>$list, 'currentUser'=>$currentUser));
	}


	public function view($to_id = null) {
		$options = array(
			'conditions' => array('to_id' => $to_id),
			'fields' => array('User.Name','Message.content','Message.created','Message.modified','Messagelist.*'),		
			'order' => 'id DESC',
			'limit' => 10
		);
		$this->paginate = $options;
		$messagelist = $this->paginate('Messagelist');
		$currentUser=$this->User->find('first',array(				
			'conditions' => array('user.email' =>$this->Auth->user('email')),
			'fields' => array('User.id')
		));
		$convoWith = $this->User->find('first',array('conditions'=> 'id ='.$to_id));
		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
		$this->set(compact('messagelist','currentUser','convoWith','users'));
		$view = new View($this, false);
		$view->viewPath = 'Elements';
		$view->render('messagebody');
		$view->set('messagelist', $messagelist);
	}


	public function delete($id = null) {
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
			'conditions' => array('to_id' => $this->request->data['to_id']),
			'fields' => array('User.Name','Message.content','Message.created','Message.modified','Messagelist.*'),		
			'order' => 'id DESC',
			'limit' => $this->request->data['limit']
		);
		$this->paginate = $options;
		$messagelist = $this->Messagelist->find('all',$options);

		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
		$view = new View($this, false);
		$view->viewPath = 'Elements';

		$view->set(compact('messagelist','users'));
		
		
		return json_encode($view->render('messagebody'));
	}
}
