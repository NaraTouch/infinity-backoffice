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

	public function uploadFile($token = null, $request = null, $file = [])
	{
		$url = $this->api_url.'/pclouds/uploadfile';
		return $this->openFileUrl($token, $url, $request, $file);
	}
	private function openFileUrl($token = null, $url = null, $param = [], $file = [])
	{
		if (!$url || !$param) {
			return [];
		}
		$str_param = http_build_query($param);
		$header = [
			'Content-Type: multipart/form-data',
			'Authorization: Bearer '.$token
		];
		$file_data['file'] = [
			'tmp_name' => $file['file']->getFile(),
			'error' => $file['file']->getError(),
			'name' => $file['file']->getClientFilename(),
			'type' => $file['file']->getClientMediaType(),
			'size' => $file['file']->getSize(),
		];
		$cfile = ['file' => new \CURLFile(
				$file_data['file']['tmp_name'],
				$file_data['file']['type'],
				$file_data['file']['name'])
			];
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url.'?'.$str_param,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_POSTFIELDS => $cfile,
		]);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

}