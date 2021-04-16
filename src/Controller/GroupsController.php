<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\GroupsForm;

class GroupsController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Group');
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
		$groups = [];
		$keywords = $this->request->getQuery('keywords');
		$website_id = $this->request->getQuery('website_id');
		$conditions = [];
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		if ($website_id) {
			$conditions['website_id'] = $website_id;
		}
		$response = $this->Group->getAllGroups($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$groups = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'groups' => $groups,
		]);
	}

	public function add()
	{
		$group = new GroupsForm();
		$website = null;
		$active = true;
		$super_user = false;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Group->createGroup($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Groups','/');
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
			'group' => $group,
			'website' => $website,
			'active' => $active,
			'super_user' => $super_user
			]);
	}

	public function edit($id = null)
	{
		$group = new GroupsForm();
		$website = null;
		$active = true;
		$super_user = false;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Group->getGroupById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$group->setData($response['Data']);
						$website = $response['Data']['website_id'];
						$active = $response['Data']['active'];
						$super_user = $response['Data']['super_user'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Groups','/');
				}
			} else {
				$this->Flash->error("Group Not Found");
				$this->goingToUrl('Groups','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Group->updateGroup($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Groups','/');
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
			$this->Flash->error("Group Not Found");
			$this->goingToUrl('Groups','/');
		}
		$this->set([
			'group' => $group,
			'website' => $website,
			'active' => $active,
			'super_user' => $super_user
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Group->deleteGroup($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Groups','/');
	}
}
