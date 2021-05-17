<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\ComponentsForm;

class ComponentsController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Template');
		$this->loadComponent('Component');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$templates = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$templates = $this->Template->getTemplates($this->token);
		}
		$this->set(['templates' => $templates]);
	}

	public function index()
	{
		$data = [];
		$keywords = $this->request->getQuery('keywords');
		$template_id = $this->request->getQuery('template_id');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		if ($template_id) {
			$conditions['template_id'] = $template_id;
		}
		$response = $this->Component->getAllComponents($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$data = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'data' => $data,
		]);
	}

	public function add()
	{
		$component = new ComponentsForm();
		$active = true;
		$template = null;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Component->createComponent($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Components','/');
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
			'component' => $component,
			'active' => $active,
			'template' => $template,
			]);
	}

	public function edit($id = null)
	{
		$component = new ComponentsForm();
		$active = true;
		$template = null;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Component->getComponentById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$component->setData($response['Data']);
						$active = $response['Data']['active'];
						$template = $response['Data']['template_id'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Components','/');
				}
			} else {
				$this->Flash->error("Component Not Found");
				$this->goingToUrl('Components','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Component->updateComponent($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Components','/');
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
			$this->Flash->error("Component Not Found");
			$this->goingToUrl('Components','/');
		}
		$this->set([
			'component' => $component,
			'active' => $active,
			'template' => $template,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Component->deleteComponent($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Components','/');
	}
}
