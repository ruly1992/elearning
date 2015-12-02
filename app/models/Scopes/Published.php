<?php

namespace Model\Scopes;

trait Published
{
	public static function bootPublished()
	{
		static::addGlobalScope(new PublishedScope);
	}
}