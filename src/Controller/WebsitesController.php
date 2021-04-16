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
		$websites = [];
		$keywords = $this->request->getQuery('keywords');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
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
			'super_user' => $super_user
			]);
	}
	
	public function edit($id = null)
	{
		$website = new WebsitesForm();
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Website->getWebsiteById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$website->setData($response['Data']);
						$active = $response['Data']['active'];
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
