<?php
namespace App\Controller;
use Cake\Event\EventInterface;
use App\Form\FolderForm;

class FileManagersController extends AppController
{
	private $token;
	public function initialize(): void
	{
		$this->loadComponent('Flash');
		$this->loadComponent('FileManager');
		
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
		$list = [];
		$request = [
			'path' => '/'
		];
		$path = $this->request->getQuery('path');
		if ($path) {
			$request['path'] = $path;
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
				$name = $this->request->getQuery('name');
				$path = $this->request->getQuery('path');
				$folder_id = $this->request->getQuery('folder_id');
				$progresshash = $this->request->getQuery('progresshash');
				$request = [
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
		$error = [];
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

	public function createFolder()
	{
		$folder = new FolderForm();
		$path = $this->request->getQuery('path');
		$folder_id = $this->request->getQuery('folder_id');
		if ($this->request->is('post')) {
			$request = $this->request->getData();
			$request['path'] = $path;
			$request['folder_id'] = $folder_id;
			$request['name'] = $request['name'];
			$response = $this->FileManager->createFolder($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$param = ['path' => $path];
					$this->goingToUrlWithParam('FileManagers','index', $param);
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
		$folder_id = '';
		$name = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('folder_id')) {
			$folder_id = $this->request->getQuery('folder_id');
		}
		if($this->request->getQuery('name')) {
			$name = $this->request->getQuery('name');
		}
		$folder->setData(['name' => $name]);
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request['folder_id'] = $folder_id;
			$request['name'] = $data['name'];
			$response = $this->FileManager->renameFolder($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$param = ['path' => $path];
					$this->goingToUrlWithParam('FileManagers','index', $param);
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
		$folder_id = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('folder_id')) {
			$folder_id = $this->request->getQuery('folder_id');
		}
		$param = ['path' => $path];
		if ($this->request->is('get')) {
			$request['path'] = $path;
			$request['folder_id'] = $folder_id;
			$response = $this->FileManager->deleteFolder($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrlWithParam('FileManagers','index', $param);
	}

	public function editFile()
	{
		$file = new FileForm();
		$file_id = '';
		$name = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('file_id')) {
			$file_id = $this->request->getQuery('file_id');
		}
		if($this->request->getQuery('name')) {
			$name = $this->request->getQuery('name');
		}
		$file->setData(['name' => $name]);
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$request['file_id'] = $file_id;
			$request['name'] = $data['name'];
			$response = $this->FileManager->renameFile($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$param = ['path' => $path];
					$this->goingToUrlWithParam('FileManagers','index', $param);
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
		$file_id = '';
		$path = $this->request->getQuery('path');
		if($this->request->getQuery('file_id')) {
			$file_id = $this->request->getQuery('file_id');
		}
		$param = ['path' => $path];
		if ($this->request->is('get')) {
			$request['path'] = $path;
			$request['file_id'] = $file_id;
			$response = $this->FileManager->deleteFile($this->token, $request);
			if($response){
				$response = json_decode($response);
				if ($response && $response->ErrorCode == '200') {
					$this->Flash->success($response->Message);
				} else {
					$this->Flash->error($response->Message);
				}
			}
		}
		$this->goingToUrlWithParam('FileManagers','index', $param);
	}
}
