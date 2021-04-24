<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\SubpagesForm;

class SubpagesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Page');
		$this->loadComponent('Subpage');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$pages = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$pages = $this->Page->getPages($this->token);
		}
		$this->set(['pages' => $pages]);
	}

	public function index()
	{
		$data = [];
		$keywords = $this->request->getQuery('keywords');
		$page_id = $this->request->getQuery('page_id');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		if ($page_id) {
			$conditions['page_id'] = $page_id;
		}
		$response = $this->Subpage->getAllSubpages($this->token, $conditions);
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
		$subpage = new SubpagesForm();
		$active = true;
		$page = null;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Subpage->createSubpage($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Subpages','/');
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
			'subpage' => $subpage,
			'page' => $page,
			'active' => $active,
			]);
	}

	public function edit($id = null)
	{
		$subpage = new SubpagesForm();
		$active = true;
		$page = null;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Subpage->getSubpageById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$data = $response['Data'][0];
						$subpage->setData($data);
						$page = $data['page_id'];
						$active = $data['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Subpages','/');
				}
			} else {
				$this->Flash->error("Subpage Not Found");
				$this->goingToUrl('Subpages','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Subpage->updateSubpage($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Subpages','/');
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
			$this->Flash->error("Subpage Not Found");
			$this->goingToUrl('Subpages','/');
		}
		$this->set([
			'subpage' => $subpage,
			'page' => $page,
			'active' => $active,
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Subpage->deleteSubpage($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Subpages','/');
	}
}
