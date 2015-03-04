<?php
namespace MyApp\Example;

use Fliglio\Consul\AddressProviderFactory;

use Fliglio\Web\Client\BasicClient;
use Fliglio\Web\UrlBuilder;
use Fliglio\Http\Http;

class DemoResource {

	public function __construct() {}

	public function getDemo() {
		$apFactory = new AddressProviderFactory();
		$ap = $apFactory->createConsulAddressProvider('foo');
		$add = $ap->getAddress();

		$b = new UrlBuilder();
		$url = $b
			->host($add->getHost())
			->port($add->getPort())
			->path('/foo')
			->build();		

		$client = new BasicClient();
		$resp = $client->get($url);

		if ($resp->getStatus() == Http::STATUS_OK) {
			$content = json_decode($resp->getBody());
		} else {
			$content = $resp->getStatus();
		}

		return array(
			'discovered' => array(
				'host' => $add->getHost(),
				'port' => $add->getPort()
			),
			'resource' => 'demo',
			'content' => $content

		);
	}

}