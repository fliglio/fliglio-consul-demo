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



class DemoResource {

	public function __construct() {}

	public function getDemo(Context $context) {

		$dns = new DnsResolver();
		$lb  = new ConsulLoadBalancer($dns, "foo");
		$ap = new ConsulAddressProvider($lb);
		$add = $ap->getAddress();


		return new JsonView(array(
			'discovered' => array(
				'host' => $add->getHost(),
				'port' => $add->getPort()
			),
			'resource' => 'demo'
		));
	}

}