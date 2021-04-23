<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\TemplatesForm;

class TemplatesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Template');
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
		$data = [];
		$keywords = $this->request->getQuery('keywords');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		$response = $this->Template->getAllTemplates($this->token, $conditions);
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
		$template = new TemplatesForm();
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Template->createTemplate($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Templates','/');
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
			'template' => $template,
			'active' => $active,
			]);
	}

	public function edit($id = null)
	{
		$template = new TemplatesForm();
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Template->getTemplateById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$template->setData($response['Data']);
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Templates','/');
				}
			} else {
				$this->Flash->error("Template Not Found");
				$this->goingToUrl('Templates','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Template->updateTemplate($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Templates','/');
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
			$this->Flash->error("Template Not Found");
			$this->goingToUrl('Templates','/');
		}
		$this->set([
			'template' => $template,
			'active' => $active,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Template->deleteTemplate($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Templates','/');
	}
}
