<?php
App::uses('AppController', 'Controller');
/**
 * CompetencesMembres Controller
 *
 * @property CompetencesMembre $CompetencesMembre
 * @property PaginatorComponent $Paginator
 */
class CompetencesMembresController extends AppController {

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
	public function index() {
		$this->CompetencesMembre->recursive = 0;
		$this->set('competencesMembres', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompetencesMembre->exists($id)) {
			throw new NotFoundException(__('Invalid competences membre'));
		}
		$options = array('conditions' => array('CompetencesMembre.' . $this->CompetencesMembre->primaryKey => $id));
		$this->set('competencesMembre', $this->CompetencesMembre->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CompetencesMembre->create();
			if ($this->CompetencesMembre->save($this->request->data)) {
				$this->Session->setFlash(__('The competences membre has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The competences membre could not be saved. Please, try again.'));
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
		if (!$this->CompetencesMembre->exists($id)) {
			throw new NotFoundException(__('Invalid competences membre'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CompetencesMembre->save($this->request->data)) {
				$this->Session->setFlash(__('The competences membre has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The competences membre could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CompetencesMembre.' . $this->CompetencesMembre->primaryKey => $id));
			$this->request->data = $this->CompetencesMembre->find('first', $options);
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
		$this->CompetencesMembre->id = $id;
		if (!$this->CompetencesMembre->exists()) {
			throw new NotFoundException(__('Invalid competences membre'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CompetencesMembre->delete()) {
			$this->Session->setFlash(__('The competences membre has been deleted.'));
		} else {
			$this->Session->setFlash(__('The competences membre could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
