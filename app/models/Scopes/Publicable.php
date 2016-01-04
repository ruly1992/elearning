<?php

namespace Model\Scopes;

trait Publicable
{
	public static function bootPublicable()
	{
		static::addGlobalScope(new PublicableScope);
	}
}