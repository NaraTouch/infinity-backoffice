<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class FileManagerComponent extends Component
{
	private $api_url;

	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function getFolderList($token = null, $request = [])
	{
		$url = $this->api_url.'/pclouds/listfolder';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function createFolder($token = null, $request = [])
	{
		$url = $this->api_url.'/pclouds/createfolderifnotexists';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function renameFolder($token = null, $request = [])
	{
		$url = $this->api_url.'/pclouds/renamefolder';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function deleteFolder($token = null, $request = [])
	{
		$url = $this->api_url.'/pclouds/deletefolder';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function renameFile($token = null, $request = [])
	{
		$url = $this->api_url.'/pclouds/renamefile';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function deleteFile($token = null, $request = [])
	{
		$url = $this->api_url.'/pclouds/deletefile';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	private function openUrlWithToken($url = null, $http_method = null, $token = null, $request = [])
	{
		if (!$url) {
			return [];
		}
		$response = [];
		$json = json_encode($request);
		$header = [
			'Content-Type: application/json',
			'Authorization: Bearer '.$token
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

}