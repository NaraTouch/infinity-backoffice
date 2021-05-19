<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\ApplicationsForm;

class ApplicationsController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Template');
		$this->loadComponent('Application');
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
		$response = $this->Application->getAllApplications($this->token, $conditions);
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
		$application = new ApplicationsForm();
		$active = true;
		$template = null;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Application->createApplication($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Applications','/');
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
			'application' => $application,
			'active' => $active,
			'template' => $template,
			]);
	}

	public function edit($id = null)
	{
		$application = new ApplicationsForm();
		$active = true;
		$template = null;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Application->getApplicationById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$application->setData($response['Data']);
						$active = $response['Data']['active'];
						$template = $response['Data']['template_id'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Applications','/');
				}
			} else {
				$this->Flash->error("Application Not Found");
				$this->goingToUrl('Applications','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Application->updateApplication($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Applications','/');
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
			$this->Flash->error("Application Not Found");
			$this->goingToUrl('Applications','/');
		}
		$this->set([
			'application' => $application,
			'active' => $active,
			'template' => $template,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Application->deleteApplication($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Applications','/');
	}
}
