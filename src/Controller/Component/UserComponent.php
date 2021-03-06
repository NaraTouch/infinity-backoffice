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
		$url = $this->api_url.'/user/login';
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
			'Content-Type: application/x-www-form-urlencoded'
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

}