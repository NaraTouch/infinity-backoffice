<?php
namespace App\Controller;
use Cake\Event\EventInterface;

class DashboardController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Security');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
		}
	}

	public function index()
	{
//		dump($this->Auth->user());
	}
}
