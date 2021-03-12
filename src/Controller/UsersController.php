<?php
namespace App\Controller;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
	public function initialize(): void
	{
		$this->loadComponent('User');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth');
	}
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	public function login()
	{
		$this->viewBuilder()->disableAutoLayout();
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->User->login($request);
			if($response){
				$response = json_decode($response, true);
				if ($response['ErrorCode'] == 200) {
					$this->Auth->setUser($response['Data']);
				} else {
					$this->Flash->errorlogin($response['Message']);
				}
				return $this->redirect([
					'controller' => 'Dashboard',
					'action' => 'index'
				]);
			}
		}
	}

	public function index()
	{
		$users = [];
		$token = $this->Auth->user('token');
		$response = $this->User->getUsers($token, []);
		if($response){
			$response = json_decode($response);
			if ($response->ErrorCode == 200) {
				$users = $response->Data;
			} else {
				$this->Flash->errorlogin($response->Message);
			}
		}
		$this->set(['users' => $users]);
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$token = $this->Auth->user('token');
			$request = $this->request->getData();
			dump($request);
		}
	}
	
	public function edit()
	{
		$users = [];
		$token = $this->Auth->user('token');
//		$response = $this->User->getUsers($token, []);
//		if($response){
//			$response = json_decode($response);
//			if ($response->ErrorCode == 200) {
//				$users = $response->Data;
//			} else {
//				$this->Flash->errorlogin($response->Message);
//			}
//		}
		$this->set(['users' => $users]);
	}
	
	public function logout()
	{
		$this->deleteSession('Auth.User');
		return $this->redirect($this->Auth->logout());
	}
}
