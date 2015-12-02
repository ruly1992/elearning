<?php

namespace Model\Scopes;

use Sofa\GlobalScope\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PublishedScope extends GlobalScope
{
	public function apply(Builder $builder, Model $model)
    {
        $builder->published();
        $this->addWithDrafts($builder);
        $this->addOnlyDrafts($builder);
        $this->addOnlyRegistered($builder);
    }

    protected function addWithDrafts(Builder $builder)
    {
        $builder->macro('withDrafts', function (Builder $builder) {
            $this->remove($builder, $builder->getModel());
            return $builder;
        });
    }

    protected function addOnlyDrafts(Builder $builder)
    {
        $builder->macro('onlyDrafts', function (Builder $builder) {
            $this->remove($builder, $builder->getModel());
            
            $builder->where('status', 'draft');

            return $builder;
        });
    }

    protected function addOnlyRegistered(Builder $builder)
    {
        $builder->macro('onlyRegistered', function (Builder $builder) {
            $this->remove($builder, $builder->getModel());
            
            $builder->where('type', 'private')->where('status', 'publish');

            return $builder;
        });
    }
}