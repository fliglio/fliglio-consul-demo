<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class ErrorResource {

	public function __construct() {
	}
	
	public function handleError(Context $context) {

		return new View("<pre>".$context->getRequest()->getProp("exception")."</pre>");
	}
	public function pageNotFound() {
		return new View("404");
	}
	
}