<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\RolesForm;
use App\Form\PermissionsForm;
class RolesController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Role');
		$this->loadComponent('Module');
		$this->loadComponent('Permission');
		$this->loadComponent('Group');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$groups = [];
		$module_list = [];
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$module_list = $this->Module->getModuleList($this->token, []);
			$groups = $this->Group->getGroups($this->token);
		}
		$this->set([
			'groups' => $groups,
			'module_list' => $module_list,
		]);
	}

	public function index()
	{
		$roles = [];
		$group_id = $this->request->getQuery('group_id');
		$keywords = $this->request->getQuery('keywords');
		$conditions = [];
		if ($group_id) {
			$conditions['group_id'] = $group_id;
		}
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		$response = $this->Role->getAllRoles($this->token, $conditions);
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
			if($response) {
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$data = $response['Data'][0];
						$role->setData($data);
						$group = $data['group_id'];
						$active = $data['active'];
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
			if($response) {
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

	public function permission($role_id = null)
	{
		$permission = new PermissionsForm();
		$permission->setData(['role_id' => $role_id]);
		$request_body = $this->request->getQuery();
		$role_name = $request_body['name'];
		$permission_list = $this->Permission->permissionListByRole($this->token, ['role_id' => $role_id]);
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$permission_data['role_id'] = $request['role_id'];
			$permission_data['permissions'] = [];
			if (isset($request['permission'])) {
				foreach ($request['permission'] as $key => $value) {
					$_exp = explode("-", $value['method_id']);
					$method_id = $_exp[0];
					$module_id = $_exp[1];
					$permission_data['permissions'][]= [
						'role_id' => $request['role_id'],
						'method_id' => $method_id,
						'module_id' => $module_id,
					];
				}
			}
			$response = $this->Permission->createPermission($this->token, $permission_data);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goIndex();
				} else {
					$this->Flash->error($response->Message);
					$this->goIndex();
				}
			}
		}
		$this->set([
			'permission_list' => $permission_list,
			'permission' => $permission,
			'role_name' => $role_name,
			'role_id' => $role_id
			]);
	}
}
