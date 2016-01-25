<?php

namespace Model\Scopes;

trait Published
{
	public static function bootPublished()
	{
		static::addGlobalScope(new PublishedScope);
	}

    public function scopePublished($query)
    {
        $query = $query->where('status', 'publish');

        return $query;
    }
}