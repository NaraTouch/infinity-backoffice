<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\GGCategoriesForm;

class GGCategoriesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('GGCategory');
		$this->loadComponent('Website');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$websites = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$websites = $this->Website->getWebsites($this->token);
		}
		$this->set(['websites' => $websites]);
	}

	public function index()
	{
		$data = [];
		$keywords = $this->request->getQuery('keywords');
		$website_id = $this->request->getQuery('website_id');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		if ($website_id) {
			$conditions['website_id'] = $website_id;
		}
		$response = $this->GGCategory->getAllGGCategory($this->token, $conditions);
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
		$data = new GGCategoriesForm();
		$website = null;
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->GGCategory->createGGCategory($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('GGCategories','/');
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
			'data' => $data,
			'website' => $website,
			'active' => $active,
			]);
	}

	public function edit($id = null)
	{
		$data = new GGCategoriesForm();
		$website = null;
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->GGCategory->getGGCategoryById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$data->setData($response['Data']);
						$website = $response['Data']['website_id'];
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('GGCategories','/');
				}
			} else {
				$this->Flash->error("GGCategories Not Found");
				$this->goingToUrl('GGCategories','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->GGCategory->updateGGCategory($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('GGCategories','/');
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
			$this->Flash->error("GGCategories Not Found");
			$this->goingToUrl('GGCategories','/');
		}
		$this->set([
			'data' => $data,
			'website' => $website,
			'active' => $active,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->GGCategory->deleteGGCategory($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('GGCategories','/');
	}
}
