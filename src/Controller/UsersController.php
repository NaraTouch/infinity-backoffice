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
			$user = $this->User->login($request);
			if($user){
				$user = json_decode($user, true);
				if ($user['ErrorCode'] == 200) {
					$this->Auth->setUser($user['Data']);
				} else {
					$this->Flash->errorlogin($user['Message']);
				}
				return $this->redirect([
					'controller' => 'Dashboard',
					'action' => 'index'
				]);
			}
		}
	}
	
	public function logout()
	{
		$this->deleteSession('Auth.User');
		return $this->redirect($this->Auth->logout());
	}
}
