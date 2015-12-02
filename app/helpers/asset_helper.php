<?php

if (!function_exists('asset')) {
	function asset($path)
	{
		return getenv('BASE_URL') . '/public/' . trim($path, '/');
	}

	function asset_images($path)
	{
		return asset('images/' . trim($path, '/'));
	}

	function asset_node_modules($path)
	{
		return asset('node_modules/' . trim($path, '/'));
	}
}