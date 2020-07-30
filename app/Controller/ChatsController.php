<?php
App::uses('AppController', 'Controller');
/**
 * Chats Controller
 *
 * @property Chat $Chat
 * @property PaginatorComponent $Paginator
 */
class ChatsController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->Chat->recursive = 0;
		$this->set('chats', $this->Paginator->paginate());
	}


	public function view($id = null) {
		if (!$this->Chat->exists($id)) {
			throw new NotFoundException(__('Invalid chat'));
		}
		$options = array('conditions' => array('Chat.' . $this->Chat->primaryKey => $id));
		$this->set('chat', $this->Chat->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Chat->create();
			if ($this->Chat->save($this->request->data)) {
				$this->Flash->success(__('The chat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The chat could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Chat->exists($id)) {
			throw new NotFoundException(__('Invalid chat'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Chat->save($this->request->data)) {
				$this->Flash->success(__('The chat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The chat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Chat.' . $this->Chat->primaryKey => $id));
			$this->request->data = $this->Chat->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->Chat->id = $id;
		if (!$this->Chat->exists()) {
			throw new NotFoundException(__('Invalid chat'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Chat->delete()) {
			$this->Flash->success(__('The chat has been deleted.'));
		} else {
			$this->Flash->error(__('The chat could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
