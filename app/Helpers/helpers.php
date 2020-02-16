<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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

function badge($text)
{
    return "<span class='badge badge-primary' style='font-size: 13px; font-weight: bold;'>$text</span>";
}

function autoBadge($text, $colorMap)
{
    $color = array_keys(array_filter($colorMap))[0] ?? 'badge-secondary';

    return "<span class='badge font-weight-light badge-$color'>$text</span>";
}

function center($text)
{
    return "<div class='text-center'>$text</div>";
}

function listingEditButton($link, $title = 'Edit')
{
    $html = <<< HTML
    <a data-placement="top" data-tooltip data-original-title="$title" style="text-decoration: none;" href="$link">
        <b class="btn btn-primary btn-sm fa fa-pencil"></b>
    </a>
HTML;

    return $html;
}

function listingDeleteButton($link, $title = 'this', $showTip = true, $icon = true)
{
    $tooltipClass = $showTip ? 'data-tooltip' : '';
    $csrf_field = csrf_field();
    $method_field = method_field('DELETE');
    $text = $icon ? '<b class="btn btn-sm btn-danger fa fa-trash"></b>' : 'Delete';

    $html = <<< HTML
    <form action="$link" method="POST" style="display: inline;">
        $csrf_field
        $method_field

        <a data-placement="top" $tooltipClass data-original-title="Delete" 
        class="confirm-delete"
        style="text-decoration: none;"
        data-label="$title"
        href="javascript:void(0);">
            $text
        </a>
    </form>
HTML;

    return $html;
}

function normalizTitle($title)
{
    $title = normalizeChars($title);
    $title = html_entity_decode($title);
    $title = preg_replace("/[^a-zA-Z0-9_ ]+/", '', $title);

    return Str::limit($title);
}

// Replaces special characters with non-special equivalents
function normalizeChars($str)
{
    # Quotes cleanup
    $str = preg_replace('#' . chr(ord("`")) . '#', "'", $str); # `
    $str = preg_replace('#' . chr(ord("�")) . '#', "'", $str); # �
    $str = preg_replace('#' . chr(ord("�")) . '#', ",", $str); # �
    $str = preg_replace('#' . chr(ord("`")) . '#', "'", $str); # `
    $str = preg_replace('#' . chr(ord("�")) . '#', "'", $str); # �
    $str = preg_replace('#' . chr(ord("�")) . '#', "\"", $str); # �
    $str = preg_replace('#' . chr(ord("�")) . '#', "\"", $str); # �
    $str = preg_replace('#' . chr(ord("�")) . '#', "'", $str); # �

    $unwanted_array = array(
        '�' => 'S',
        '�' => 's',
        '�' => 'Z',
        '�' => 'z',
        '�' => 'A',
        '�' => 'A',
        '�' => 'A',
        '�' => 'A',
        '�' => 'A',
        '�' => 'A',
        '�' => 'A',
        '�' => 'C',
        '�' => 'E',
        '�' => 'E',
        '�' => 'E',
        '�' => 'E',
        '�' => 'I',
        '�' => 'I',
        '�' => 'I',
        '�' => 'I',
        '�' => 'N',
        '�' => 'O',
        '�' => 'O',
        '�' => 'O',
        '�' => 'O',
        '�' => 'O',
        '�' => 'O',
        '�' => 'U',
        '�' => 'U',
        '�' => 'U',
        '�' => 'U',
        '�' => 'Y',
        '�' => 'B',
        '�' => 'Ss',
        '�' => 'a',
        '�' => 'a',
        '�' => 'a',
        '�' => 'a',
        '�' => 'a',
        '�' => 'a',
        '�' => 'a',
        '�' => 'c',
        '�' => 'e',
        '�' => 'e',
        '�' => 'e',
        '�' => 'e',
        '�' => 'i',
        '�' => 'i',
        '�' => 'i',
        '�' => 'i',
        '�' => 'o',
        '�' => 'n',
        '�' => 'o',
        '�' => 'o',
        '�' => 'o',
        '�' => 'o',
        '�' => 'o',
        '�' => 'o',
        '�' => 'u',
        '�' => 'u',
        '�' => 'u',
        '�' => 'y',
        '�' => 'y',
        '�' => 'b',
        '�' => 'y'
    );
    $str = strtr($str, $unwanted_array);

    # Bullets, dashes, and trademarks
    $str = preg_replace('#' . chr(149) . '#', "&#8226;", $str); # bullet �
    $str = preg_replace('#' . chr(150) . '#', "&ndash;", $str); # en dash
    $str = preg_replace('#' . chr(151) . '#', "&mdash;", $str); # em dash
    $str = preg_replace('#' . chr(153) . '#', "&#8482;", $str); # trademark
    $str = preg_replace('#' . chr(169) . '#', "&copy;", $str); # copyright mark
    $str = preg_replace('#' . chr(174) . '#', "&reg;", $str); # registration mark

    return $str;
}