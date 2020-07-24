<?php
App::uses('AppController', 'Controller');
/**
 * Messagelists Controller
 *
 * @property Messagelist $Messagelist
 * @property PaginatorComponent $Paginator
 */
class MessagelistsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->Messagelist->recursive = 0;
		// $list = $this->Messagelist->find('all', array(
		// 	'conditions' => array('user_id'=>$id),
		// 	'group' => array('to_id'),
		// 	'having' => array('COUNT(to_id) >' => 1),
		// 	'order' => 'Message.created DESC'
		// ));
		$db = $this->Messagelist->getDataSource();
		$subQuery = $db->buildStatement(
		    array(
		        'table'      => $db->fullTableName($this->Messagelist),
		        'alias'		 => 'Messagelist',
		        'conditions' => array('user_id'=>$id),
		        'group'      => array('to_id'),
		        'fields' 	 => array('Max(Messagelist.id)'),
		        'order'		 => array('Messagelist.id'=>'DESC')
		    ),
		    $this->Messagelist
		);

		$subQuery = 'Messagelist.id IN (' . $subQuery . ') order by Messagelist.id DESC';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$list = $this->Messagelist->find('all', compact('conditions'));

		$users = $this->Messagelist->User->find('all',array('fields'=>array('id','name')));
		$this->set(array('users'=>$users, 'list'=>$list));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Messagelist->exists($id)) {
			throw new NotFoundException(__('Invalid messagelist'));
		}
		$options = array('conditions' => array('Messagelist.' . $this->Messagelist->primaryKey => $id));
		$this->set('messagelist', $this->Messagelist->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Messagelist->create();
			if ($this->Messagelist->save($this->request->data)) {
				$this->Flash->success(__('The messagelist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The messagelist could not be saved. Please, try again.'));
			}
		}
		$users = $this->Messagelist->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Messagelist->exists($id)) {
			throw new NotFoundException(__('Invalid messagelist'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Messagelist->save($this->request->data)) {
				$this->Flash->success(__('The messagelist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The messagelist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Messagelist.' . $this->Messagelist->primaryKey => $id));
			$this->request->data = $this->Messagelist->find('first', $options);
		}
		$users = $this->Messagelist->User->find('list');
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
}
