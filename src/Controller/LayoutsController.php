<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\LayoutsForm;

class LayoutsController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Layout');
		$this->loadComponent('Component');
		$this->loadComponent('Subpage');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$subpages = [];
		$components = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$subpages = $this->Subpage->getSubpages($this->token);
			$components = $this->Component->getComponents($this->token);
		}
		$this->set([
			'subpages' => $subpages,
			'components' => $components,
		]);
	}

	public function index()
	{
		$data = [];
		$subpage_id = $this->request->getQuery('subpage_id');
		$component_id = $this->request->getQuery('keywords');
		$conditions = [];
		if ($subpage_id) {
			$conditions['subpage_id'] = $subpage_id;
		}
		if ($component_id) {
			$conditions['component_id'] = $component_id;
		}
		$response = $this->Layout->getAllLayouts($this->token, $conditions);
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
		$layout = new LayoutsForm();
		$active = true;
		$subpage = null;
		$component = null;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Layout->createLayout($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Layouts','/');
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
			'layout' => $layout,
			'subpage' => $subpage,
			'component' => $component,
			'active' => $active,
			]);
	}

	public function edit($id = null)
	{
		$layout = new LayoutsForm();
		$active = true;
		$subpage = null;
		$component = null;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Layout->getLayoutById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$data = $response['Data'][0];
						$layout->setData($data);
						$subpage = $data['subpage_id'];
						$component = $data['component_id'];
						$active = $data['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Layouts','/');
				}
			} else {
				$this->Flash->error("Layout Not Found");
				$this->goingToUrl('Layouts','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Layout->updateLayout($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Layouts','/');
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
			$this->Flash->error("Layout Not Found");
			$this->goingToUrl('Layouts','/');
		}
		$this->set([
			'layout' => $layout,
			'subpage' => $subpage,
			'component' => $component,
			'active' => $active,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Layout->deleteLayout($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Layouts','/');
	}
}
