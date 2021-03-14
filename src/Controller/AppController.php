<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
	public function initialize(): void
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'loginAction' => [
				'controller' => 'Users',
				'action' => 'login',
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'login',
			],
			'authError' => '',
			'authenticate' => [
				'Form' => [
					'fields' => ['email' => 'password']
				]
			],
			'storage' => 'Session',
			'unauthorizedRedirect' => [
				'controller' => 'Users',
				'action' => 'login',
			],
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

	public function getSession()
	{
		return $this->request->getSession();
	}

	public function readSession($key)
	{
		return $this->getSession()->read($key);
	}

	public function writeSession($key, $value)
	{
		return $this->getSession()->write($key, $value);
	}

	public function deleteSession($key)
	{
		return $this->getSession()->delete($key);
	}

	public function logout()
	{
		$this->deleteSession('Auth.User');
		return $this->redirect($this->Auth->logout());
	}
	
	public function goingToUrl($controller = null, $action = null, $id = null)
	{
		return $this->redirect([
			'controller' => $controller,
			'action' => $action,
			$id
		]);
	}
}
