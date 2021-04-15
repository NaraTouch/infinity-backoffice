<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class WebsiteComponent extends Component
{
	private $api_url;

	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function getWebsites($token = null)
	{
		$groups = [];
		$response = $this->getAllWebsites($token);
		if($response){
			$response = json_decode($response);
			if ($response && $response->ErrorCode == 200) {
				$groups = $response->Data;
			}
		}
		return $groups;
	}

	public function getAllWebsites($token = null, $request = [])
	{
		$url = $this->api_url.'/websites';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function createWebsite($token = null, $request = [])
	{
		$url = $this->api_url.'/websites/add';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function getWebsiteById($token = null, $request = [])
	{
		$url = $this->api_url.'/websites/view';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function updateWebsite($token = null, $request = [])
	{
		$url = $this->api_url.'/websites/edit';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function deleteWebsite($token = null, $request = [])
	{
		$url = $this->api_url.'/websites/delete';
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