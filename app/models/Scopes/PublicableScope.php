<?php

namespace Model\Scopes;

use Sofa\GlobalScope\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PublicableScope extends GlobalScope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->public();

        $this->addWithPrivate($builder);
        $this->addOnlyRegistered($builder);
    }

    protected function addWithPrivate(Builder $builder)
    {
        $builder->macro('withPrivate', function (Builder $builder) {
            $this->remove($builder, $builder->getModel());

            return $builder;
        });
    }

    protected function addOnlyRegistered(Builder $builder)
    {
        $builder->macro('onlyRegistered', function (Builder $builder) {
            $this->remove($builder, $builder->getModel());

            $builder->registered();

            return $builder;
        });
    }
}