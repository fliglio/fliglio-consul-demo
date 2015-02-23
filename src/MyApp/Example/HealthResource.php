<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;
use Fliglio\RestFc\Input\RouteParam;
use Fliglio\RestFc\Input\GetParam;

use Fliglio\Consul\DnsResolver;
use Fliglio\Consul\ConsulLoadBalancer;
use Fliglio\Consul\ConsulAddressProvider;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;



class HealthResource {

	public function __construct() {}

	public function getHealth(Context $context) {

		return new JsonView(array(
			'status' => 'UP'
		));
	}

}