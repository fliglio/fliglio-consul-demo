<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;
use Fliglio\RestFc\Input\RouteParam;
use Fliglio\RestFc\Input\GetParam;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class FooResource {

	public function __construct() {}

	public function getFoo(Context $context) {
		return new JsonView(array(
			'address' => $_SERVER['SERVER_ADDR'],
			'resource' => 'foo'
		));
	}

}