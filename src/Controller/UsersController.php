<?php
namespace App\Controller;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('User');
		$this->loadComponent('Groups');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$groups = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$groups = $this->Groups->getGroups($this->token);
		}
		$this->set(['groups' => $groups]);
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
		$response = $this->User->getUsers($this->token, []);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$users = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set(['users' => $users]);
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			dump($request);
		}
	}
	
	public function edit()
	{
		$users = [];
//		$token = $this->Auth->user('token');
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

}
