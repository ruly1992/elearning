<?php

if (!function_exists('config')) {
	function config($key, $default = '') {
		$config = new Library\Config\Config;

		if (is_array($key))
			$config->set($key);
		else
			return $config->get($key) ?: $default;
	}
}