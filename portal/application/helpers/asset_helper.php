<?php

if (!function_exists('asset')) {
	function asset($path)
	{
		return base_url('assets/' . $path);
	}
}