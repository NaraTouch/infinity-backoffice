<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\UsersForm;

class UsersController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('User');
		$this->loadComponent('Security');
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

	public function login()
	{
		$this->viewBuilder()->disableAutoLayout();
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->User->login($request);
			if($response){
				$response = json_decode($response, true);
				if ($response['ErrorCode'] == 200) {
					$user_data = $response['Data'];
					$menu = $this->Security->getMenu($response['Data']['token'], []);
					if (!empty($menu)) {
						$user_data['menu'] = $menu;
					}
					$this->Auth->setUser($user_data);
				} else {
					$this->Flash->errorlogin($response['Message']);
				}
				$this->goingToUrl('Dashboard','index');
			}
		}
	}

	public function index()
	{
		$users = [];
		$group_id = $this->request->getQuery('group_id');
		$keywords = $this->request->getQuery('keywords');
		$conditions = [];
		if ($group_id) {
			$conditions['group_id'] = $group_id;
		}
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		$response = $this->User->getUsers($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$users = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set(['users' => $users]);
	}

	public function add()
	{
		$user = new UsersForm();
		$group = '';
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			if ($request['password'] == $request['confirm_password']) {
				$response = $this->User->createUsers($this->token, $request);
				if($response){
					$response = json_decode($response);
					if ($response && $response->ErrorCode == '200') {
						$this->Flash->success($response->Message);
						$this->goingToUrl('Users','/');
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
				$this->Flash->error('Your Confirm password not match!!!');
			}
		}
		$this->set([
			'user' => $user,
			'group' => $group,
			'active' => $active
			]);
	}

	public function edit($id = null)
	{
		$user = new UsersForm();
		$group = '';
		$active = '';
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->User->getUserById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$user->setData($response['Data']);
						$group = $response['Data']['group_id'];
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('Users','/');
				}
			} else {
				$this->Flash->error("User Not Found");
				$this->goingToUrl('Users','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			if ($request['password']) {
				if ($request['password'] != $request['confirm_password']) {
					$this->Flash->error('Your Confirm password not match!!!');
					$this->goingToUrl('Users','edit',$request['id']);
				}
			}
			$response = $this->User->updateUser($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('Users','/');
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
			$this->Flash->error("User Not Found");
			$this->goingToUrl('Users','/');
		}
		$this->set([
			'user' => $user,
			'group' => $group,
			'active' => $active
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->User->deleteUser($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('Users','/');
	}
}
