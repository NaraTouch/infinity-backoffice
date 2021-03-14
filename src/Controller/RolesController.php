<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\RolesForm;

class RolesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Role');
		$this->loadComponent('Group');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$groups = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$groups = $this->Group->getGroups($this->token);
		}
		$this->set(['groups' => $groups]);
	}

	public function index()
	{
		$roles = [];
		$response = $this->Role->getAllRoles($this->token, []);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$roles = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'roles' => $roles,
		]);
	}

	public function add()
	{
		$role = new RolesForm();
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Role->createRole($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Roles','/');
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
			'role' => $role,
			'active' => $active
			]);
	}

	public function edit($id = null)
	{
		$role = new RolesForm();
		$group = true;
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Role->getRoleById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$role->setData($response['Data']);
						$group = $response['Data']['group_id'];
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Roles','/');
				}
			} else {
				$this->Flash->error("Role Not Found");
				$this->goingToUrl('Roles','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->Role->updateRole($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Roles','/');
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
			$this->Flash->error("Role Not Found");
			$this->goingToUrl('Roles','/');
		}
		$this->set([
			'role' => $role,
			'group' => $group,
			'active' => $active
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->Role->deleteRole($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Roles','/');
	}
}
