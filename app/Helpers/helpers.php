<?php

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


