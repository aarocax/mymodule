<?php

namespace Drupal\mymodule\libs;


class MyModuleDao {

	var $status;
	var $mock = true;
	var $user_mock = array(
		'name' => 'user-1',
		'lastname' => 'lasname-1',
		'id' => 1,
	);

	public function __construct() {
		$this->status = 'Clase MyModuleDao Cargada...';
	}

	public function getUser() {
		if ($this->mock) {
			return $this->user_mock;
		}
	}

}