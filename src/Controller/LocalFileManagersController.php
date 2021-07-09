<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\LocalFileManagersForm;
use App\Form\FolderForm;

class LocalFileManagersController extends AppController
{
	private $token;
	public function initialize(): void
	{
		
		$this->loadComponent('Group');
		$this->loadComponent('LocalFileManager');
		$this->loadComponent('FrontEndFileManager');
		$this->loadComponent('Flash');
	}

	public function beforeFilter(EventInterface $event)
	{
		$groups = [];
		parent::beforeFilter($event);
		if ($this->Auth->user()) {
			$this->token = $this->Auth->user('token');
			$groups = $this->Group->getGroups($this->token);
		}
		$this->set([
			'groups' => $groups,
		]);
	}

	public function index()
	{
		$local_file_managers = [];
		$group_id = $this->request->getQuery('group_id');
		$keywords = $this->request->getQuery('keywords');
		$conditions = [];
		if ($group_id) {
			$conditions['group_id'] = $group_id;
		}
		if ($keywords) {
			$conditions['keywords'] = $keywords;
		}
		$response = $this->LocalFileManager->getAllLocalFileManagers($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$local_file_managers = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'local_file_managers' => $local_file_managers,
		]);
	}

	public function add()
	{
		$local_file_manager = new LocalFileManagersForm();
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->LocalFileManager->createLocalFileManager($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('LocalFileManagers','/');
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
			'local_file_manager' => $local_file_manager,
			'active' => $active
			]);
	}

	public function edit($id = null)
	{
		$local_file_manager = new LocalFileManagersForm();
		$group = true;
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($response) {
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$data = $response['Data'][0];
						$local_file_manager->setData($data);
						$group = $data['group_id'];
						$active = $data['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('LocalFileManagers','/');
				}
			} else {
				$this->Flash->error("LocalFileManager Not Found");
				$this->goingToUrl('LocalFileManagers','/');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->LocalFileManager->updateLocalFileManager($this->token, $request);
			if($response) {
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('LocalFileManagers','/');
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
			$this->Flash->error("LocalFileManager Not Found");
			$this->goingToUrl('LocalFileManagers','/');
		}
		$this->set([
			'local_file_manager' => $local_file_manager,
			'group' => $group,
			'active' => $active
			]);
	}

	public function delete($id = null)
	{
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->LocalFileManager->deleteLocalFileManager($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrl('LocalFileManagers','/');
	}

	
	// Start front-end File Manager
	public function fileManager()
	{
		$list = [];
		if ($this->request->is('get')) {
			$query = $this->request->getQuery();
			$request = ['id' => $query['id']];
			$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($local_file_acc){
				$local_file_acc = json_decode($local_file_acc);
				if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
					$list_request = [
						'secret_key' => $local_file_acc->Data[0]->secret_key,
						'web_url' => $local_file_acc->Data[0]->web_url,
						'path' => $query['path']
					];
					$response = $this->FrontEndFileManager->listing($list_request);
					if($response){
						$response = json_decode($response);
						if ($response && $response->ErrorCode == '200') {
							$list = $response->Data;
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
					$this->Flash->error($local_file_acc->Message);
				}
			}
		}
		$this->set([
			'list' => $list,
		]);
	}

	public function deleteFolder()
	{
		if ($this->request->is('get')) {
			$query = $this->request->getQuery();
			$request = ['id' => $query['id']];
			$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($local_file_acc){
				$local_file_acc = json_decode($local_file_acc);
				if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
					$list_request = [
						'secret_key' => $local_file_acc->Data[0]->secret_key,
						'web_url' => $local_file_acc->Data[0]->web_url,
						'path' => $query['dir_path'].'\\'.$query['name'],
					];
					$response = $this->FrontEndFileManager->deleteFolder($list_request);
					if($response){
						$response = json_decode($response);
						if ($response && $response->ErrorCode == '200') {
							$this->Flash->success($response->Message);
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
					$this->Flash->error($local_file_acc->Message);
				}
			}
		}
		$this->goingToUrlWithParam('LocalFileManagers','fileManager', $query);
	}

	public function deleteFile()
	{
		if ($this->request->is('get')) {
			$query = $this->request->getQuery();
			$request = ['id' => $query['id']];
			$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($local_file_acc){
				$local_file_acc = json_decode($local_file_acc);
				if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
					$list_request = [
						'secret_key' => $local_file_acc->Data[0]->secret_key,
						'web_url' => $local_file_acc->Data[0]->web_url,
						'path' => $query['dir_path'],
						'name' => $query['name']
					];
					$response = $this->FrontEndFileManager->deleteFile($list_request);
					if($response){
						$response = json_decode($response);
						if ($response && $response->ErrorCode == '200') {
							$this->Flash->success($response->Message);
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
					$this->Flash->error($local_file_acc->Message);
				}
			}
		}
		$this->goingToUrlWithParam('LocalFileManagers','fileManager', $query);
	}
	
	public function editFolder()
	{
		$folder = new FolderForm();
		$query = $this->request->getQuery();
		$name = $query['dir_path'].'\\'.$query['name'];
		$folder->setData(['name' => $name]);
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request = ['id' => $query['id']];
			$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($local_file_acc){
				$local_file_acc = json_decode($local_file_acc);
				if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
					$list_request = [
						'secret_key' => $local_file_acc->Data[0]->secret_key,
						'web_url' => $local_file_acc->Data[0]->web_url,
						'path_name' => $name,
						'to_path_name' => $data['name']
					];
					$response = $this->FrontEndFileManager->renameFolder($list_request);
					if($response){
						$response = json_decode($response);
						if ($response && $response->ErrorCode == '200') {
							$this->Flash->success($response->Message);
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
					$this->Flash->error($local_file_acc->Message);
				}
			}
			$this->goingToUrlWithParam('LocalFileManagers','fileManager', $query);
		}
		$this->set(['folder' => $folder]);
	}
	
	public function editFile()
	{
		$folder = new FolderForm();
		$query = $this->request->getQuery();
		$name = $query['name'];
		$folder->setData(['name' => $name]);
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request = ['id' => $query['id']];
			$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($local_file_acc){
				$local_file_acc = json_decode($local_file_acc);
				if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
					$list_request = [
						'secret_key' => $local_file_acc->Data[0]->secret_key,
						'web_url' => $local_file_acc->Data[0]->web_url,
						'path' => $query['dir_path'],
						'name' => $name,
						'to_name' => $data['name']
					];
					$response = $this->FrontEndFileManager->renameFile($list_request);
					if($response){
						$response = json_decode($response);
						if ($response && $response->ErrorCode == '200') {
							$this->Flash->success($response->Message);
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
					$this->Flash->error($local_file_acc->Message);
				}
			}
			$this->goingToUrlWithParam('LocalFileManagers','fileManager', $query);
		}
		$this->set(['folder' => $folder]);
	}
	
	public function createFolderIfNotExists()
	{
		$folder = new FolderForm();
		$query = $this->request->getQuery();
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request = ['id' => $query['id']];
			$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
			if($local_file_acc){
				$local_file_acc = json_decode($local_file_acc);
				if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
					$data = $this->request->getData();
					$list_request = [
						'secret_key' => $local_file_acc->Data[0]->secret_key,
						'web_url' => $local_file_acc->Data[0]->web_url,
						'path' => $query['path'].'\\'.$data['name'],
					];
					$response = $this->FrontEndFileManager->createFolder($list_request);
					if($response){
						$response = json_decode($response);
						if ($response && $response->ErrorCode == '200') {
							$this->Flash->success($response->Message);
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
					$this->Flash->error($local_file_acc->Message);
				}
			}
			$this->goingToUrlWithParam('LocalFileManagers','fileManager', $query);
		}
		$this->set(['folder' => $folder]);
	}

	public function uploadFile()
	{
		if ($this->request->is('post')) {
			$http_status = 404;
			$message = '';
			$data = [];
			$error = [];
			if ($this->request->is('ajax')) {
				$param = $this->request->getQuery();
				$file= $this->request->getData();
				$request = ['id' => $param['id']];
				$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
				if($local_file_acc){
					$local_file_acc = json_decode($local_file_acc);
					if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
						$list_request = [
							'secret_key' => $local_file_acc->Data[0]->secret_key,
							'web_url' => $local_file_acc->Data[0]->web_url,
							'path' => $param['path'],
							'file' => $file['file'],
						];
						$response = $this->FrontEndFileManager->uploadFile($list_request);
						if($response){
							$response = json_decode($response);
							if ($response && $response->ErrorCode == '200') {
								$http_status = $response->ErrorCode;
								$message = $response->Message;
								$data = $response->Data;
								$error = $response->Error;
							} else {
								$error = $response->Error;
								$http_status = $response->ErrorCode;
								$message = $response->Message;
							}
						}
					}
				}
			} else {
				$http_status = 404;
				$message = 'Request Not found!!!';
			}
			$response = [
				'ErrorCode' => $http_status,
				'Message' => $message,
				'Data' => $data,
				'Error' => $error
			];
			return $this->response->withType('application/json')
				->withStatus($http_status)
				->withStringBody(json_encode($response));
		}
	}
	
	public function ajaxDeleteFolder()
	{
		if ($this->request->is('post')) {
			$http_status = 404;
			$message = '';
			$data = [];
			$error = [];
			if ($this->request->is('ajax')) {
				$form_data = $this->request->getData();
				$request = ['id' => $form_data['id']];
				$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
				$param = [
					'id' => $form_data['id'],
					'path' => $form_data['path'],
				];
				if($local_file_acc){
					$local_file_acc = json_decode($local_file_acc);
					if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
						$list_request = [
							'secret_key' => $local_file_acc->Data[0]->secret_key,
							'web_url' => $local_file_acc->Data[0]->web_url,
							'path' => $form_data['path'].'\\'.$form_data['name'],
						];
						$response = $this->FrontEndFileManager->deleteFolder($list_request);
						if($response){
							$response = json_decode($response);
							if ($response && $response->ErrorCode == '200') {
								$http_status = $response->ErrorCode;
								$message = $response->Message;
								$data = $response->Data;
								if (isset($response->Error)) {
									$error = $response->Error;
								}
								$this->Flash->success($response->Message);
							} else {
								if (isset($response->Error)) {
									$error = $response->Error;
								}
								$http_status = 200;
								$message = $response->Message;
								$this->Flash->error($response->Message);
							}
						}
					}
				}
				$this->goingToUrlWithParam('LocalFileManagers','fileManager', $param);
			} else {
				$http_status = 404;
				$message = 'Request Not found!!!';
			}
			$response = [
				'ErrorCode' => $http_status,
				'Message' => $message,
				'Data' => $data,
				'Error' => $error
			];
			return $this->response->withType('application/json')
				->withStatus($http_status)
				->withStringBody(json_encode($response));
			
		}
	}
	
	public function ajaxDeleteFile()
	{
		if ($this->request->is('post')) {
			$http_status = 404;
			$message = '';
			$data = [];
			$error = [];
			if ($this->request->is('ajax')) {
				$form_data = $this->request->getData();
				$request = ['id' => $form_data['id']];
				$local_file_acc = $this->LocalFileManager->getLocalFileManagerById($this->token, $request);
				$param = [
					'id' => $form_data['id'],
					'path' => $form_data['path'],
				];
				if($local_file_acc){
					$local_file_acc = json_decode($local_file_acc);
					if ($local_file_acc && $local_file_acc->ErrorCode == '200') {
						$list_request = [
							'secret_key' => $local_file_acc->Data[0]->secret_key,
							'web_url' => $local_file_acc->Data[0]->web_url,
							'path' => $form_data['path'],
							'name' => $form_data['name']
						];
						$response = $this->FrontEndFileManager->deleteFile($list_request);
						if($response){
							$response = json_decode($response);
							if ($response && $response->ErrorCode == '200') {
								$http_status = $response->ErrorCode;
								$message = $response->Message;
								$data = $response->Data;
								if (isset($response->Error)) {
									$error = $response->Error;
								}
								$this->Flash->success($response->Message);
							} else {
								if (isset($response->Error)) {
									$error = $response->Error;
								}
								$http_status = 200;
								$message = $response->Message;
								$this->Flash->error($response->Message);
							}
						}
					}
				}
				$this->goingToUrlWithParam('LocalFileManagers','fileManager', $param);
			} else {
				$http_status = 404;
				$message = 'Request Not found!!!';
			}
			$response = [
				'ErrorCode' => $http_status,
				'Message' => $message,
				'Data' => $data,
				'Error' => $error
			];
			return $this->response->withType('application/json')
				->withStatus($http_status)
				->withStringBody(json_encode($response));
			
		}
	}
}
