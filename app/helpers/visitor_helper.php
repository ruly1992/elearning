<?php

if (!function_exists('visitor')) {
	function visitor()
	{
		return new Library\Visitor\Visitor;
	}
}

if (!function_exists('saveVisitor')) {
	function saveVisitor()
	{
		visitor()->saveVisitor();
	}
}