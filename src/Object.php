<?php

namespace jugger\base;

class Object
{
	public function __construct(array $config = []) {
		Configurator::setValues($this, $config);
	}

	public function __get($name) {
		$method = "get".$name;
		if (method_exists($this, $method)) {
			return $this->$method();
		}
		else {
			$class = get_called_class();
			throw new \ErrorException("Property '{$name}' not found in '{$class}'");
		}
	}

	public function __set($name, $value) {
		$method = "set".$name;
		if (method_exists($this, $method)) {
			$this->$method($value);
		}
		else {
			$class = get_called_class();
			throw new \ErrorException("Property '{$name}' not found in '{$class}'");
		}
	}
}
