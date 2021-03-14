<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\MethodsForm;

class MethodsController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Method');
		$this->loadComponent('Module');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$modules = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$modules = $this->Module->getModules($this->token);
		}
		$this->set(['modules' => $modules]);
	}

	public function index()
	{
		$methods = [];
		$response = $this->Method->getAllMethods($this->token, []);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$methods = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'methods' => $methods,
		]);
	}

	public function add()
	{
		$method = new MethodsForm();
		$module = null;
		$is_menu = true;
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Method->createMethod($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Methods','/');
				} else {
					foreach ($response->Error as $key => $value) {
						$message = $key;
						foreach ($value as $k => $v) {
							$message .= ' ('.$k.') Error Message : '.$v;
						}
						$this->Flash->error($message);
					}
				}
			}
		}
		$this->set([
			'method' => $method,
			'module' => $module,
			'is_menu' => $is_menu,
			'active' => $active,
			]);
	}

	public function edit($id = null)
	{
		$method = new MethodsForm();
		$module = null;
		$is_menu = true;
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Method->getMethodById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$method->setData($response['Data']);
						$module = $response['Data']['module_id'];
						$is_menu = $response['Data']['is_menu'];
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Methods','/');
				}
			} else {
				$this->Flash->error("Method Not Found");
				$this->goingToUrl('Methods','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Method->updateMethod($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Methods','/');
				} else {
					foreach ($response->Error as $key => $value) {
						$message = $key;
						foreach ($value as $k => $v) {
							$message .= ' ('.$k.') Error Message : '.$v;
						}
						$this->Flash->error($message);
					}
				}
			}
		} else {
			$this->Flash->error("Method Not Found");
			$this->goingToUrl('Methods','/');
		}
		$this->set([
			'method' => $method,
			'module' => $module,
			'is_menu' => $is_menu,
			'active' => $active,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Method->deleteMethod($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Methods','/');
	}
}
