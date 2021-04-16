<?php
namespace App\Controller\Component;
use Cake\Controller\Component;

class FeatureSettingsComponent extends Component
{

	public function initialize(array $config): void
	{
		parent::initialize($config);
	}

	public function enableFeature($parram = null, $menu = null)
	{
		if (!empty($parram) || !empty($menu)) {
			$features = [];
			foreach ($menu as $key => $value) {
				if ($value['name'] == $parram['controller']) {
					foreach ($value['methods'] as $k => $v) {
						$features[$v['name']] = true;
					}
				}
			}
			return $features;
		} else {
			return [];
		}
	}
}