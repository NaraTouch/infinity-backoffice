<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class PermissionComponent extends Component
{
	private $api_url;
	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function permissionListByRole($token = null, $request = [])
	{
		$permissions = [];
		$response = $this->getPermissionByRole($token, $request);
		if($response){
			$response = json_decode($response);
			if ($response->ErrorCode == 200) {
				$permissions = $response->Data;
			}
		}
		return $permissions;
	}

	public function getPermissionByRole($token = null, $request = [])
	{
		$url = $this->api_url.'/permissions/by_role';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function createPermission($token = null, $request = [])
	{
		$url = $this->api_url.'/permissions/add';
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