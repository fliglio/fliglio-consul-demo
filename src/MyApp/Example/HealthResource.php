<?php
namespace MyApp\Example;

class HealthResource {

	public function getHealth() {
		return array(
			'status' => 'UP'
		);
	}
}