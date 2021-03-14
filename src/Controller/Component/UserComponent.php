<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class UserComponent extends Component
{
	private $api_url;

	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function login($request = [])
	{
		$url = $this->api_url.'/users/login';
		$http_method = 'POST';
		return $this->openUrl($url, $request, $http_method);
	}

	private function openUrl($url = null, $request = [], $http_method = null)
	{
		if (!$request || !$url) {
			return [];
		}
		$str = http_build_query($request);
		$header = [
			'Content-Type: application/x-www-form-urlencoded',
		];
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_method);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $str );
			$output = curl_exec($ch);
		curl_close($ch);
		return ($output);
	}

	public function getUsers($token = null, $request = [])
	{
		$url = $this->api_url.'/users';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function createUsers($token = null, $request = [])
	{
		$url = $this->api_url.'/users/add';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function getUserById($token = null, $request = [])
	{
		$url = $this->api_url.'/users/view';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function updateUser($token = null, $request = [])
	{
		$url = $this->api_url.'/users/edit';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function deleteUser($token = null, $request = [])
	{
		$url = $this->api_url.'/users/delete';
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