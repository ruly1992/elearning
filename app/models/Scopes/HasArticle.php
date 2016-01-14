<?php

namespace Model\Scopes;

trait HasArticle
{
	public static function bootHasArticle()
	{
		static::addGlobalScope(new HasArticleScope);
	}
}