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
		$this->loadComponent('Auth');
		$this->loadComponent('Flash');
	}
	
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow();
		
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
}
