<?php

namespace MyApp\Example;

use Fliglio\Consul\AddressProviderFactory;

use Fliglio\Web\Curl;
use Fliglio\Web\CurlRequest;

use Fliglio\Fltk\JsonView;


class DemoResource {

	public function __construct() {}

	public function getDemo() {
		$apFactory = new AddressProviderFactory();
		$ap = $apFactory->createConsulAddressProvider('foo');
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