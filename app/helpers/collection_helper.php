<?php

if (!function_exists('collect')) {
	function collect($collection = [])
	{
		return new Illuminate\Support\Collection($collection);
	}
}