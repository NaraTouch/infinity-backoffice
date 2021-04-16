<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\ModulesForm;

class ModulesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Module');
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
		$modules = [];
		$keywords = $this->request->getQuery('keywords');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		$response = $this->Module->getAllModules($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$modules = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'modules' => $modules,
		]);
	}

	public function add()
	{
		$module = new ModulesForm();
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Module->createModule($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Modules','/');
				} else {
					if (isset($response->Error)) {
						foreach ($response->Error as $key => $value) {
							$message = $key;
							foreach ($value as $k => $v) {
								$message .= ' ('.$k.') Error Message : '.$v;
							}
							$this->Flash->error($message);
						}
					} else {
						$this->Flash->error($response->Message);
					}
				}
			}
		}
		$this->set([
			'module' => $module,
			'active' => $active
			]);
	}

	public function edit($id = null)
	{
		$module = new ModulesForm();
		$active = '';
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Module->getModuleById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$module->setData($response['Data']);
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Modules','/');
				}
			} else {
				$this->Flash->error("Module Not Found");
				$this->goingToUrl('Modules','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Module->updateModule($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Modules','/');
				} else {
					if (isset($response->Error)) {
						foreach ($response->Error as $key => $value) {
							$message = $key;
							foreach ($value as $k => $v) {
								$message .= ' ('.$k.') Error Message : '.$v;
							}
							$this->Flash->error($message);
						}
					} else {
						$this->Flash->error($response->Message);
					}
				}
			}
		} else {
			$this->Flash->error("Module Not Found");
			$this->goingToUrl('Modules','/');
		}
		$this->set([
			'module' => $module,
			'active' => $active
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Module->deleteModule($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Modules','/');
	}
}
