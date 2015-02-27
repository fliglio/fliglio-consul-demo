<?php
namespace MyApp;

use Fliglio\Flfc\Context;
use Fliglio\Flfc\RequestFactory;
use Fliglio\Flfc\Response;
use Fliglio\Flfc\FcChainRegistry;
use Fliglio\Flfc\FcDispatcherFactory;

use Fliglio\Flfc\Resolvers\NamespaceFcChainResolver;
use Fliglio\Flfc\Resolvers\DefaultFcChainResolver;
use Fliglio\Flfc\Apps\HttpApp;
use Fliglio\Flfc\Apps\RestApp;
use Fliglio\Flfc\Apps\ServeHtmlApp;

use Fliglio\Routing\UrlLintApp;
use Fliglio\Routing\RoutingApp;
use Fliglio\Routing\RouteMap;
use Fliglio\Routing\Type\RouteBuilder;
use Fliglio\Routing\DefaultInvokerApp;
use Fliglio\Http\Http;


error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);

require_once __DIR__ . '/../vendor/autoload.php';



// Configure Routing
$routeMap = new RouteMap();
$routeMap
	->connect('demo', RouteBuilder::get()
		->uri('/demo')
		->command('MyApp\Example.DemoResource.getDemo')
		->method(Http::METHOD_GET)
		->build()
	)
	->connect('foo', RouteBuilder::get()
		->uri('/foo')
		->command('MyApp\Example.FooResource.getFoo')
		->method(Http::METHOD_GET)
		->build()
	)
	->connect('health', RouteBuilder::get()
		->uri('/api/health')
		->command('MyApp\Example.HealthResource.getHealth')
		->method(Http::METHOD_GET)
		->build()
	);



// Configure Front Controller Chains
$chain  = new HttpApp(new RestApp(new UrlLintApp(new RoutingApp(new DefaultInvokerApp(), $routeMap))));

// Configure Resolvers
$chains = new FcChainRegistry();
$chains->addResolver(new DefaultFcChainResolver($chain));

// Dispatch Request
$dispatcherFactory = new FcDispatcherFactory();
$dispatcher = $dispatcherFactory->createDefault($chains);
$dispatcher->dispatch();

