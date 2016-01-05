<?php

namespace Model\Scopes;

use Sofa\GlobalScope\GlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HasArticleScope extends GlobalScope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->has('article');

        $this->addWithDrafts($builder);
    }

    protected function addWithDrafts(Builder $builder)
    {
        $builder->macro('withDrafts', function (Builder $builder) {
            $this->remove($builder, $builder->getModel());

            $builder->with([
                'article' => function ($query) {
                    $query->withDrafts();
                }
            ]);

            return $builder;
        });
    }
}