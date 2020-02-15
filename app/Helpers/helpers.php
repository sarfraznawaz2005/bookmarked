<?php

use Illuminate\Database\Eloquent\Builder;

function flashBack($message, $type = 'success', array $with = [])
{
    noty($message, $type);

    return back()->with($with);
}

function flashBackErrors($errors, $withInput = true, array $with = [])
{
    $back = back()->withErrors($errors);

    if ($withInput) {
        $back = $back->withInput();
    }

    return $back->with($with);
}

function activeLink($path, $class = 'active')
{
    if (request()->is((array)$path) || request()->routeIs((array)$path)) {
        return $class;
    }

    return '';
}

function getSql(Builder $builder)
{
    $addSlashes = str_replace('?', "'?'", $builder->toSql());

    return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
}
