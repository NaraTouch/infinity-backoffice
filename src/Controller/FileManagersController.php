<?php
namespace App\Controller;
use Cake\Event\EventInterface;

class FileManagersController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Flash');
		$this->loadComponent('FileManager');
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
		$list = [];
		$path = $this->request->getQuery('path');
		$request = [
			'path' => '/'
		];
		if ($path) {
			$request['path'] = $path;
		}
		$response = $this->FileManager->getFolderList($this->token, $request);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$list = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'list' => $list,
		]);
	}
}
