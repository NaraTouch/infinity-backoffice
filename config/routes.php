<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
	$builder->connect('/', ['controller' => 'Home', 'action' => 'index']);
	$builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
	$builder->connect('/pages/*', 'Pages::display');
	$builder->fallbacks();
});
