<?php

namespace App\Http\Actions\Bookmarks;

use DOMDocument;
use DOMXPath;
use Sarfraznawaz2005\Actions\Action;

class GetUrlTitle extends Action
{
    public function __invoke()
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->strictErrorChecking = false;
        $dom->loadHTML(@file_get_contents(\request()->url));

        $xpath = new DOMXpath($dom);
        $tag = $xpath->query('//title');
        @$title = $tag->item(0)->textContent;

        if ($title) {
            return normalizTitle($title);
        }
    }
}
