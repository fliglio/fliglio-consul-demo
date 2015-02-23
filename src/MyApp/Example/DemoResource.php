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

use Fliglio\Web\Curl;
use Fliglio\Web\CurlRequest;


class DemoResource {

	public function __construct() {}

	public function getDemo(Context $context) {

		$dns = new DnsResolver();
		$lb  = new ConsulLoadBalancer($dns, "foo");
		$ap = new ConsulAddressProvider($lb);
		$add = $ap->getAddress();

		$url = sprintf("%s://%s:%s/foo", $add->getScheme(), $add->getHost(), $add->getPort());

		$curl = new Curl();
		$resp = $curl->request(new CurlRequest(Curl::GET, $url));

		$content = json_decode($resp->getContent());


		return new JsonView(array(
			'discovered' => array(
				'host' => $add->getHost(),
				'port' => $add->getPort()
			),
			'resource' => 'demo',
			'content' => $content

		));
	}

}