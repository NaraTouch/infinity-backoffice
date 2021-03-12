<?php
declare(strict_types=1);
require __DIR__ . '/paths.php';
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ConsoleErrorHandler;
use Cake\Error\ErrorHandler;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Routing\Router;
use Cake\Utility\Security;

try {
	Configure::config('default', new PhpConfig());
	Configure::load('app', 'default', false);
} catch (\Exception $e) {
	exit($e->getMessage() . "\n");
}

if (file_exists(CONFIG . 'app_local.php')) {
	Configure::load('app_local', 'default');
}

if (Configure::read('debug')) {
	Configure::write('Cache._cake_model_.duration', '+2 minutes');
	Configure::write('Cache._cake_core_.duration', '+2 minutes');
	// disable router cache during development
	Configure::write('Cache._cake_routes_.duration', '+2 seconds');
}

date_default_timezone_set(Configure::read('App.defaultTimezone'));

mb_internal_encoding(Configure::read('App.encoding'));

ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

$isCli = PHP_SAPI === 'cli';
if ($isCli) {
	(new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
	(new ErrorHandler(Configure::read('Error')))->register();
}

if ($isCli) {
	require __DIR__ . '/bootstrap_cli.php';
}

$fullBaseUrl = Configure::read('App.fullBaseUrl');
if (!$fullBaseUrl) {
	$s = null;
	if (env('HTTPS')) {
		$s = 's';
	}

	$httpHost = env('HTTP_HOST');
	if (isset($httpHost)) {
		$fullBaseUrl = 'http' . $s . '://' . $httpHost;
	}
	unset($httpHost, $s);
}
if ($fullBaseUrl) {
	Router::fullBaseUrl($fullBaseUrl);
}
unset($fullBaseUrl);

Cache::setConfig(Configure::consume('Cache'));
ConnectionManager::setConfig(Configure::consume('Datasources'));
TransportFactory::setConfig(Configure::consume('EmailTransport'));
Mailer::setConfig(Configure::consume('Email'));
Log::setConfig(Configure::consume('Log'));
Security::setSalt(Configure::consume('Security.salt'));

ServerRequest::addDetector('mobile', function ($request) {
	$detector = new \Detection\MobileDetect();

	return $detector->isMobile();
});
ServerRequest::addDetector('tablet', function ($request) {
	$detector = new \Detection\MobileDetect();

	return $detector->isTablet();
});
define('NO_DATA', 'No Data Found !!!.');