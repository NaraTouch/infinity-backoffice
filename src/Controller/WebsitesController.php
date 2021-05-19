<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\WebsitesForm;

class WebsitesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Website');
		$this->loadComponent('Template');
		$this->loadComponent('Application');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$templates = [];
		$applications = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$templates = $this->Template->getTemplates($this->token);
			$applications = $this->Application->getApplications($this->token);
		}
		$this->set([
			'templates' => $templates,
			'applications' => $applications
		]);
	}

	public function index()
	{
		$websites = [];
		$keywords = $this->request->getQuery('keywords');
		$template_id = $this->request->getQuery('template_id');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		if ($template_id) {
			$conditions['template_id'] = $template_id;
		}
		$response = $this->Website->getAllWebsites($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$websites = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'websites' => $websites,
		]);
	}

	public function add()
	{
		$website = new WebsitesForm();
		$active = true;
		$super_user = false;
		$template = null;
		$application = null;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Website->createWebsite($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Websites','/');
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
			'website' => $website,
			'active' => $active,
			'super_user' => $super_user,
			'template' => $template,
			'application' => $application,
			]);
	}

	public function edit($id = null)
	{
		$website = new WebsitesForm();
		$active = true;
		$template = null;
		$application = null;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Website->getWebsiteById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$website->setData($response['Data']);
						$active = $response['Data']['active'];
						$template = $response['Data']['template_id'];
						$application = $response['Data']['application_id'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Websites','/');
				}
			} else {
				$this->Flash->error("Website Not Found");
				$this->goingToUrl('Websites','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Website->updateWebsite($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Websites','/');
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
			$this->Flash->error("Website Not Found");
			$this->goingToUrl('Websites','/');
		}
		$this->set([
			'website' => $website,
			'active' => $active,
			'template' => $template,
			'application' => $application,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Website->deleteWebsite($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Websites','/');
	}
}
