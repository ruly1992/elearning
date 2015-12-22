<?php

namespace Model\Scopes;

use Sofa\GlobalScope\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PublicableScope extends GlobalScope
{
	public function apply(Builder $builder, Model $model)
	{
		if (!sentinel()->check()) {
			$builder->public();
		}

		$this->addWithPrivate($builder);
	}

	protected function addWithPrivate(Builder $builder)
	{
		$builder->macro('withPrivate', function (Builder $builder) {
			$this->remove($builder, $builder->getModel());

			return $builder;
		});
	}
}