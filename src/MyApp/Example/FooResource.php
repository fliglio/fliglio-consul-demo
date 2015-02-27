<?php
namespace MyApp\Example;

class FooResource {

	public function getFoo() {
		return array(
			'address' => $_SERVER['SERVER_ADDR'],
			'resource' => 'foo'
		);
	}

}