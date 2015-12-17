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

if (!function_exists('attachment')) {
	function attachment($path = '')
	{
		return home_url('app/files/'.trim($path, '\\/'));
	}
}

if (!function_exists('forum_attachment')) {
	function forum_attachment($path = '')
	{
		return home_url('app/files/forum-attachment/'.trim($path, '\\/'));
	}
}

if (!function_exists('konsultasi_attachment')) {
	function konsultasi_attachment($path = '')
	{
		return home_url('app/files/konsultasi-attachment/'.trim($path, '\\/'));
	}
}
