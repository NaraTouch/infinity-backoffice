<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class GroupsComponent extends Component
{
	private $api_url;

	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function getGroups($token = null)
	{
		$groups = [];
		$response = $this->getAllGroups($token);
		if($response){
			$response = json_decode($response);
			if ($response->ErrorCode == 200) {
				$groups = $response->Data;
			}
		}
		return $groups;
	}

	public function getAllGroups($token = null, $request = [])
	{
		$url = $this->api_url.'/groups';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	private function openUrlWithToken($url = null, $http_method = null, $token = null, $request = [])
	{
		if (!$url) {
			return [];
		}
		$json = json_encode($request);
		$header = [
			'Content-Type: application/json',
			'Authorization: Bearer '.$token
		];
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_method);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json );
			$output = curl_exec($ch);
		curl_close($ch);
		return ($output);
	}

}