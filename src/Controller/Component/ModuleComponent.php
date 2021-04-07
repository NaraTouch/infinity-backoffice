<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class ModuleComponent extends Component
{
	private $api_url;

	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function getModules($token = null)
	{
		$modules = [];
		$response = $this->getAllModules($token);
		if($response){
			$response = json_decode($response);
			if ($response->ErrorCode == 200) {
				$modules = $response->Data;
			}
		}
		return $modules;
	}

	public function getAllModules($token = null, $request = [])
	{
		$url = $this->api_url.'/modules';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function createModule($token = null, $request = [])
	{
		$url = $this->api_url.'/modules/add';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function getModuleById($token = null, $request = [])
	{
		$url = $this->api_url.'/modules/view';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function updateModule($token = null, $request = [])
	{
		$url = $this->api_url.'/modules/edit';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function deleteModule($token = null, $request = [])
	{
		$url = $this->api_url.'/modules/delete';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function getModuleList($token = null, $request = [])
	{
		$modules = [];
		$response = $this->moduleList($token, $request);
		if($response){
			$response = json_decode($response);
			if ($response->ErrorCode == 200) {
				$modules = $response->Data;
			}
		}
		return $modules;
	}

	public function moduleList($token = null, $request = [])
	{
		$url = $this->api_url.'/modules/lists';
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