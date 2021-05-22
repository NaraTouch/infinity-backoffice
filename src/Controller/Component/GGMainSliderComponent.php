<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class GGMainSliderComponent extends Component
{
	private $api_url;

	public function initialize(array $config): void
	{
		parent::initialize($config);
		$this->api_url = 'http://localhost/infinity-api';
	}

	public function getAllGGMainSliders($token = null, $request = [])
	{
		$url = $this->api_url.'/ggmainsliders';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function createGGMainSlider($token = null, $request = [])
	{
		$url = $this->api_url.'/ggmainsliders/add';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function getGGMainSliderById($token = null, $request = [])
	{
		$url = $this->api_url.'/ggmainsliders/view';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}
	
	public function updateGGMainSlider($token = null, $request = [])
	{
		$url = $this->api_url.'/ggmainsliders/edit';
		$http_method = 'POST';
		return $this->openUrlWithToken($url, $http_method, $token, $request);
	}

	public function deleteGGMainSlider($token = null, $request = [])
	{
		$url = $this->api_url.'/ggmainsliders/delete';
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