<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class FrontEndFileManagerComponent extends Component
{

	public function initialize(array $config): void
	{
		parent::initialize($config);
	}

	public function listing($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/listing';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $request);
	}
	
	public function deleteFolder($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/delete-folder';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $request);
	}
	
	public function deleteFile($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/delete-file';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $request);
	}
	
	public function renameFolder($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/rename-folder';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $request);
	}
	
	public function createFolder($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/create-folder';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $request);
	}
	
	public function renameFile($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/rename-file';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $request);
	}

	private function openUrlWithToken($url = null, $http_method = null, $request = [])
	{
		if (!$url) {
			return [];
		}
		$response = [];
		$json = json_encode($request);
		$header = [
			'Content-Type: application/json',
		];
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $http_method,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $json,
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	public function uploadFile($request = [])
	{
		$web_url = $request['web_url'];
		unset($request['web_url']);
		$url = $web_url.'files/upload-file';
		$http_method = 'POST';
		return $this->openFileUrl($url, $request, $http_method);
	}

	private function openFileUrl($url = null, $request = [], $http_method = null)
	{
		
		if (!$url || !$request) {
			return [];
		}
		$header = [
			'Content-Type: multipart/form-data',
		];
		
		$file_data['file'] = [
			'tmp_name' => $request['file']->getFile(),
			'error' => $request['file']->getError(),
			'name' => $request['file']->getClientFilename(),
			'type' => $request['file']->getClientMediaType(),
			'size' => $request['file']->getSize(),
		];
		$cfile = [
			'path' => $request['path'],
			'secret_key' => $request['secret_key'],
			'file' => new \CURLFile(
				$file_data['file']['tmp_name'],
				$file_data['file']['type'],
				$file_data['file']['name'])
			];
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $http_method,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $cfile,
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

}