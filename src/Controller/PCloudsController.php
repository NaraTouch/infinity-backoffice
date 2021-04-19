<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\FileForm;
use App\Form\FolderForm;
use App\Form\PCloundsForm;

class PCloudsController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Flash');
		$this->loadComponent('FileManager');
		$this->loadComponent('Website');
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

	public function accounts()
	{
		$accounts = [];
		$website_id = $this->request->getQuery('website_id');
		$conditions = [];
		if ($website_id) {
			$conditions['website_id'] = $website_id;
		}
		$response = $this->FileManager->accounts($this->token, $conditions);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$accounts = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'accounts' => $accounts,
		]);
	}

	public function add()
	{
		$account = new PCloundsForm();
		$website = null;
		$active = true;
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->FileManager->add($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('PClouds','accounts');
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
			'account' => $account,
			'website' => $website,
			'active' => $active,
			]);
	}

	public function edit($id = null)
	{
		$account = new PCloundsForm();
		$website = null;
		$active = true;
		if ($id && $this->request->is('get')) {
			$request = ['id' => $id];
			$response = $this->FileManager->getAccountById($this->token, $request);
			if($response){
				$response = json_decode($response, true);
				if ($response && $response['ErrorCode'] == '200') {
						$account->setData($response['Data']);
						$website = $response['Data']['website_id'];
						$active = $response['Data']['active'];
				} else {
					$this->Flash->error($response['Message']);
					$this->goingToUrl('PClouds','accounts');
				}
			} else {
				$this->Flash->error("PClouds Not Found");
				$this->goingToUrl('PClouds','accounts');
			}
		} else if ($this->request->is('post')) {
			$request = $this->request->getData();
			$response = $this->FileManager->updateAccount($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
					$this->goingToUrl('PClouds','accounts');
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
			$this->Flash->error("PClouds Not Found");
			$this->goingToUrl('PClouds','accounts');
		}
		$this->set([
			'account' => $account,
			'website' => $website,
			'active' => $active,
			]);
	}

	public function index()
	{
		$list = [];
		$request = [
			'path' => '/',
			'website_id' => '',
		];
		$path = $this->request->getQuery('path');
		$website_id = $this->request->getQuery('website_id');
		if ($path) {
			$request['path'] = $path;
		}
		if ($website_id) {
			$request['website_id'] = $website_id;
		}
		$response = $this->FileManager->getFolderList($this->token, $request);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == '200') {
				$list = $response->Data;
			} else {
				$this->Flash->error($response->Message);
			}
		}
		$this->set([
			'list' => $list,
		]);
	}

	public function uploadFile()
	{
		if ($this->request->is('post')) {
			$http_status = 404;
			$message = '';
			$data = [];
			$error = [];
			if ($this->request->is('ajax')) {
				$website_id = $this->request->getQuery('website_id');
				$name = $this->request->getQuery('name');
				$path = $this->request->getQuery('path');
				$folder_id = $this->request->getQuery('folder_id');
				$progresshash = $this->request->getQuery('progresshash');
				$request = [
					'website_id' => $website_id,
					'filename' => $name,
					'path' => $path,
					'folderid' => $folder_id,
					'progresshash' => $progresshash
				];
				$file = $this->request->getData();
				$response = $this->FileManager->uploadFile($this->token, $request, $file);
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

	public function uploadFileProgress()
	{
		$http_status = 404;
		$message = '';
		$data = [];
		if ($this->request->is('ajax')) {
			$request = [
				'progresshash' => false
			];
			$progresshash = $this->request->getQuery('progresshash');
			if ($progresshash) {
				$request['progresshash'] = $progresshash;
			}
			$response = $this->FileManager->uploadFileProgress($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$http_status = $response->ErrorCode;
					$message = $response->Message;
					$data = $response->Data;
				} else {
					$http_status = $response->ErrorCode;
					$message = $response->Message;
				}
			} else {
				$http_status = 500;
				$message = 'Internal server error!!!';
			}
		} else {
			$http_status = 404;
			$message = 'Request Not found!!!';
		}
		return $this->response->withType('application/json')
				->withStatus($http_status)
				->withStringBody(json_encode($response));
	}

	public function createFolderIfNotExists()
	{
		$folder = new FolderForm();
		$path = $this->request->getQuery('path');
		$folder_id = $this->request->getQuery('folder_id');
		$website_id = $this->request->getQuery('website_id');
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$request['website_id'] = $website_id;
			$request['path'] = $path;
			$request['folder_id'] = $folder_id;
			$request['name'] = $request['name'];
			$response = $this->FileManager->createFolder($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$param = [
						'path' => $path,
						'website_id' => $website_id,
					];
					$this->goingToUrlWithParam('PClouds','index', $param);
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->set(['folder' => $folder]);
	}

	public function editFolder()
	{
		$folder = new FolderForm();
		$website_id = '';
		$folder_id = '';
		$name = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('folder_id')) {
			$folder_id = $this->request->getQuery('folder_id');
		}
		if($this->request->getQuery('folder_id')) {
			$folder_id = $this->request->getQuery('folder_id');
		}
		if($this->request->getQuery('website_id')) {
			$website_id = $this->request->getQuery('website_id');
		}
		$folder->setData(['name' => $name]);
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request['website_id'] = $website_id;
			$request['folder_id'] = $folder_id;
			$request['name'] = $data['name'];
			$response = $this->FileManager->renameFolder($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$param = [
						'path' => $path,
						'website_id' => $website_id,
					];
					$this->goingToUrlWithParam('PClouds','index', $param);
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->set(['folder' => $folder]);
	}

	public function deleteFolder()
	{
		$website_id = '';
		$folder_id = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('website_id')) {
			$website_id = $this->request->getQuery('website_id');
		}
		if($this->request->getQuery('folder_id')) {
			$folder_id = $this->request->getQuery('folder_id');
		}
		$param = [
			'path' => $path,
			'website_id' => $website_id
		];
		if ($this->request->is('get')) {
			$request['website_id'] = $website_id;
			$request['path'] = $path;
			$request['folder_id'] = $folder_id;
			$response = $this->deleteFolderApi($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrlWithParam('PClouds','index', $param);
	}

	public function editFile()
	{
		$file = new FileForm();
		$website_id = '';
		$file_id = '';
		$name = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('website_id')) {
			$website_id = $this->request->getQuery('website_id');
		}
		if($this->request->getQuery('file_id')) {
			$file_id = $this->request->getQuery('file_id');
		}
		if($this->request->getQuery('name')) {
			$name = $this->request->getQuery('name');
		}
		$file->setData(['name' => $name]);
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request['website_id'] = $website_id;
			$request['file_id'] = $file_id;
			$request['name'] = $data['name'];
			$response = $this->FileManager->renameFile($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$param = [
						'path' => $path,
						'website_id' => $website_id
					];
					$this->goingToUrlWithParam('PClouds','index', $param);
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->set(['file' => $file]);
	}

	public function deleteFile()
	{
		$website_id = '';
		$file_id = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('file_id')) {
			$file_id = $this->request->getQuery('file_id');
		}
		if($this->request->getQuery('website_id')) {
			$website_id = $this->request->getQuery('website_id');
		}
		$param = [
			'path' => $path,
			'website_id' => $website_id,
		];
		if ($this->request->is('get')) {
			$request['website_id'] = $website_id;
			$request['path'] = $path;
			$request['file_id'] = $file_id;
			$response = $this->deleteFileApi($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrlWithParam('PClouds','index', $param);
	}

	public function deleteFolderApi($token = null, $request = [])
	{
		return $this->FileManager->deleteFolder($token, $request);
	}

	public function deleteFileApi($token = null, $request = [])
	{
		return $this->FileManager->deleteFile($token, $request);
	}

	public function ajaxDeleteFolder()
	{
		if ($this->request->is('post')) {
			$http_status = 404;
			$message = '';
			$data = [];
			$error = [];
			if ($this->request->is('ajax')) {
				$request = $this->request->getData();
				$request_data = [
					'website_id' => $request['website_id'],
					'path' => $request['path'],
					'folder_id' => $request['folderid']
				];
				$param = [
					'path' => $request['path'],
					'website_id' => $request['website_id']
				];
				$response = $this->deleteFolderApi($this->token, $request_data);
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
						return $this->goingToUrlWithParam('PClouds','index', $param);
					} else {
						if (isset($response->Error)) {
							$error = $response->Error;
						}
						$http_status = 200;
						$message = $response->Message;
						$this->Flash->error($response->Message);
						return $this->goingToUrlWithParam('PClouds','index', $param);
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
	
	public function ajaxDeleteFile()
	{
		if ($this->request->is('post')) {
			$http_status = 404;
			$message = '';
			$data = [];
			$error = [];
			if ($this->request->is('ajax')) {
				$file = $this->request->getData();
				$request_data = [
					'website_id' => $file['website_id'],
					'path' => $file['path'],
					'file_id' => $file['fileid']
				];
				$param = [
					'path' => $file['path'],
					'website_id' => $file['website_id']
				];
				$response = $this->deleteFileApi($this->token, $request_data);
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
						return $this->goingToUrlWithParam('PClouds','index', $param);
					} else {
						if (isset($response->Error)) {
							$error = $response->Error;
						}
						$http_status = 200;
						$message = $response->Message;
						$this->Flash->error($response->Message);
						return $this->goingToUrlWithParam('PClouds','index', $param);
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

}
