<?php

namespace IbrahimBougaoua\FilamentSubscription\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait SortOrder {

    public static function bootSortOrder() : void
    {
        static::creating(function ($model) {
            $model->sort_order = $model->count() + 1;
        });

        static::addGlobalScope('sort_order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function switchSortOrder($action = "next",Model $model,$sort_order,$value) : int
    {
        $model_id = $action === "next" ? 
                    $this->getNextModelId($model,$sort_order) :
                    $this->getPreviousModelId($model,$sort_order);

        return $this->changeSortOrder($model_id,$value);
    }

    public function changeSortOrder($sort_order,$value) : int
    {
        $model = Model::where('sort_order', $sort_order)->first();

        $old_sort_order = $model->sort_order;

        if( $model )
        {
            $model->sort_order = $value;
            $model->save();
        }

        return $old_sort_order;
    }

    public function getNextModelId(Model $model,$sort_order) : int
    {
        return $model->where('sort_order', '>', $sort_order)->min('sort_order');
    }

    public function getPreviousModelId(Model $model,$sort_order) : int
    {
        return $model->where('sort_order', '<', $sort_order)->max('sort_order');
    }
}