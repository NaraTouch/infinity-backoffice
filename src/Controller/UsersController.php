<?php
namespace App\Controller;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
	public function initialize(): void
	{
		$this->loadComponent('User');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'loginAction' => [
				'controller' => 'Users',
				'action' => 'login',
			],
			'logoutRedirect' => $this->referer(),
			'authError' => 'Did you really think you are allowed to see that?',
			'authenticate' => [
				'Form' => [
					'fields' => ['email' => 'password']
				]
			],
			'storage' => 'Session',
			'unauthorizedRedirect' => $this->referer()
		]);
	}
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	public function isAuthorized($user)
	{
		if ($user) {
			return true;
		}
		return false;
	}

	public function login()
	{
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$user = $this->User->login($request);
			if($user){
				$user = json_decode($user, true);
				if ($user['ErrorCode'] == 200) {
					$this->Auth->setUser($user['Data']);
				} else {
					$this->Flash->error($user['Message']);
				}
				return $this->redirect([
					'controller' => 'Home',
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
